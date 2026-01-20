/**
 * Erstellt eine einfache Custom-Scrollbar.
 */
const initScrollbar = () => {
	if (document.querySelector('.custom-scrollbar')) {
		return;
	}

	const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
	const scrollbar = document.createElement('div');
	const thumb = document.createElement('div');

	scrollbar.className = 'custom-scrollbar';
	scrollbar.setAttribute('aria-hidden', 'true');
	thumb.className = 'custom-scrollbar-thumb';
	scrollbar.appendChild(thumb);
	document.body.appendChild(scrollbar);

	let maxScroll = 0;
	let trackHeight = 0;
	let thumbHeight = 0;
	let targetY = 0;
	let currentY = 0;
	let isRunning = false;
	let isDragging = false;
	let dragOffset = 0;

	/**
	 * Wert innerhalb eines Bereichs halten.
	 */
	const clamp = (value, min, max) => Math.min(max, Math.max(min, value));

	/**
	 * Metriken fuer Track und Thumb berechnen.
	 */
	const updateMetrics = () => {
		const doc = document.documentElement;
		maxScroll = Math.max(0, doc.scrollHeight - window.innerHeight);
		trackHeight = scrollbar.offsetHeight;
		const ratio = doc.scrollHeight ? window.innerHeight / doc.scrollHeight : 1;
		thumbHeight = Math.max(24, trackHeight * ratio);
		thumb.style.height = `${thumbHeight}px`;
	};

	/**
	 * Zielposition fuer den Thumb aktualisieren.
	 */
	const updateTarget = () => {
		const progress = maxScroll ? window.scrollY / maxScroll : 0;
		const maxThumbY = Math.max(0, trackHeight - thumbHeight);
		targetY = clamp(progress * maxThumbY, 0, maxThumbY);
	};

	/**
	 * Scroll-Position aus Thumb-Position setzen.
	 */
	const setScrollFromThumb = (nextThumbY) => {
		const maxThumbY = Math.max(0, trackHeight - thumbHeight);
		const safeThumbY = clamp(nextThumbY, 0, maxThumbY);
		const progress = maxThumbY ? safeThumbY / maxThumbY : 0;
		window.scrollTo(0, progress * maxScroll);
		targetY = safeThumbY;
		currentY = safeThumbY;
	};

	/**
	 * Thumb-Position rendern.
	 */
	const render = () => {
		if (prefersReducedMotion) {
			thumb.style.transform = `translate3d(0, ${targetY}px, 0)`;
			isRunning = false;
			return;
		}

		isRunning = true;
		currentY += (targetY - currentY) * 0.18;

		if (Math.abs(targetY - currentY) < 0.5) {
			currentY = targetY;
		}

		thumb.style.transform = `translate3d(0, ${currentY}px, 0)`;

		if (currentY !== targetY) {
			requestAnimationFrame(render);
			return;
		}

		isRunning = false;
	};

	/**
	 * Drag starten.
	 */
	const onThumbPointerDown = (event) => {
		if (event.button !== 0) {
			return;
		}
		event.preventDefault();
		isDragging = true;
		const trackRect = scrollbar.getBoundingClientRect();
		dragOffset = event.clientY - (trackRect.top + currentY);
		thumb.setPointerCapture(event.pointerId);
	};

	/**
	 * Drag bewegen.
	 */
	const onPointerMove = (event) => {
		if (!isDragging) {
			return;
		}
		const trackRect = scrollbar.getBoundingClientRect();
		const nextThumbY = event.clientY - trackRect.top - dragOffset;
		setScrollFromThumb(nextThumbY);
		thumb.style.transform = `translate3d(0, ${currentY}px, 0)`;
	};

	/**
	 * Drag beenden.
	 */
	const onPointerUp = (event) => {
		if (!isDragging) {
			return;
		}
		isDragging = false;
		thumb.releasePointerCapture(event.pointerId);
		updateTarget();
		if (!isRunning) {
			requestAnimationFrame(render);
		}
	};

	/**
	 * Track-Klick fuer Sprung zum Bereich.
	 */
	const onTrackPointerDown = (event) => {
		if (event.target === thumb || event.button !== 0) {
			return;
		}
		const trackRect = scrollbar.getBoundingClientRect();
		const nextThumbY = event.clientY - trackRect.top - thumbHeight / 2;
		setScrollFromThumb(nextThumbY);
		if (!isRunning) {
			requestAnimationFrame(render);
		}
	};

	/**
	 * Scroll-Event abfangen.
	 */
	const onScroll = () => {
		if (isDragging) {
			return;
		}
		updateTarget();
		if (!isRunning) {
			requestAnimationFrame(render);
		}
	};

	/**
	 * Resize-Event abfangen.
	 */
	const onResize = () => {
		updateMetrics();
		updateTarget();
		if (!isRunning) {
			requestAnimationFrame(render);
		}
	};

	updateMetrics();
	updateTarget();
	render();

	window.addEventListener('scroll', onScroll, { passive: true });
	window.addEventListener('resize', onResize);
	scrollbar.addEventListener('pointerdown', onTrackPointerDown);
	thumb.addEventListener('pointerdown', onThumbPointerDown);
	window.addEventListener('pointermove', onPointerMove);
	window.addEventListener('pointerup', onPointerUp);
};

export default initScrollbar;
