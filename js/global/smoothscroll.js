/**
 * Aktiviert weiches Scrollen fuer Section-Links und Maus-Scroll.
 */
const smoothScroll = () => {
	const sections = Array.from(document.querySelectorAll('section[id]'));
	const sectionKeys = sections
		.map((section) => section.getAttribute('id'))
		.filter((key) => key);
	const modalKeys = Array.from(document.querySelectorAll('.modal-overlay[data-modal]'))
		.map((overlay) => overlay.getAttribute('data-modal'))
		.filter((key) => key);
	const anchors = document.querySelectorAll('a[href]');

	if (!sectionKeys.length || !anchors.length) {
		return;
	}

	/**
	 * Basis-Pfad fuer Section-URLs bestimmen.
	 */
	const getBasePath = () => {
		const normalizedPath = window.location.pathname.replace(/\/+$/, '');
		const segments = normalizedPath.split('/').filter(Boolean);
		const lastSegment = segments[segments.length - 1] || '';

		if (sectionKeys.includes(lastSegment) || modalKeys.includes(lastSegment) || lastSegment === 'index.php') {
			segments.pop();
		}

		return `/${segments.join('/')}${segments.length ? '/' : ''}`;
	};

	/**
	 * Section-Key aus Pfad lesen.
	 */
	const getSectionKeyFromPath = (pathname) => {
		const normalizedPath = pathname.replace(/\/+$/, '');
		const segments = normalizedPath.split('/').filter(Boolean);
		const lastSegment = segments[segments.length - 1] || '';

		if (sectionKeys.includes(lastSegment)) {
			return lastSegment;
		}

		return '';
	};

	/**
	 * Section anscrollen.
	 */
	const scrollToSection = (key, behavior = 'smooth') => {
		const target = document.getElementById(key);
		if (!target) {
			return false;
		}
		target.scrollIntoView({ behavior, block: 'start' });
		return true;
	};

	/**
	 * URL auf Section setzen.
	 */
	const setSectionUrl = (key, method = 'push') => {
		const nextUrl = `${basePath}${key}/${baseSearch}`;
		const state = { section: key };
		if (method === 'replace') {
			history.replaceState(state, '', nextUrl);
			return;
		}
		history.pushState(state, '', nextUrl);
	};

	/**
	 * Weiches Scrollen fuer normale Maus-Scrolls aktivieren.
	 */
	const enableSmoothWheelScroll = () => {
		if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
			return;
		}

		let currentY = window.scrollY;
		let targetY = window.scrollY;
		let isAnimating = false;

		/**
		 * Maximale Scroll-Position ermitteln.
		 */
		const getMaxScroll = () => Math.max(0, document.documentElement.scrollHeight - window.innerHeight);

		/**
		 * Wheel-Delta vereinheitlichen.
		 */
		const normalizeDelta = (event) => {
			if (event.deltaMode === 1) {
				return event.deltaY * 16;
			}
			if (event.deltaMode === 2) {
				return event.deltaY * window.innerHeight;
			}
			return event.deltaY;
		};

		/**
		 * Scroll-Animation mit sanfter Annäherung.
		 */
		const animate = () => {
			isAnimating = true;
			const distance = targetY - currentY;
			currentY += distance * 0.12;

			if (Math.abs(distance) < 0.5) {
				window.scrollTo(0, targetY);
				isAnimating = false;
				return;
			}

			window.scrollTo(0, currentY);
			requestAnimationFrame(animate);
		};

		/**
		 * Wheel-Events abfangen und Ziel-Scroll setzen.
		 */
		const onWheel = (event) => {
			if (document.body.classList.contains('modal-open')) {
				return;
			}

			if (event.ctrlKey) {
				return;
			}

			event.preventDefault();
			if (!isAnimating) {
				currentY = window.scrollY;
				targetY = window.scrollY;
			}
			targetY = Math.min(getMaxScroll(), Math.max(0, targetY + normalizeDelta(event)));

			if (!isAnimating) {
				requestAnimationFrame(animate);
			}
		};

		window.addEventListener('wheel', onWheel, { passive: false });
	};

	const basePath = getBasePath();
	const baseSearch = window.location.search;

	enableSmoothWheelScroll();

	anchors.forEach((anchor) => {
		anchor.addEventListener('click', (event) => {
			const href = anchor.getAttribute('href');
			if (!href) {
				return;
			}

			if (href.startsWith('#')) {
				const key = href.replace('#', '');
				if (modalKeys.includes(key)) {
					return;
				}
				const target = document.getElementById(key);
				if (!target) {
					return;
				}
				event.preventDefault();
				if (sectionKeys.includes(key)) {
					setSectionUrl(key);
					scrollToSection(key);
					return;
				}
				history.pushState({ anchor: key }, '', `#${key}`);
				target.scrollIntoView({ behavior: 'smooth', block: 'start' });
				return;
			}

			try {
				const targetUrl = new URL(href, window.location.origin);
				if (targetUrl.origin !== window.location.origin) {
					return;
				}
				const key = getSectionKeyFromPath(targetUrl.pathname);
				if (!key) {
					return;
				}
				event.preventDefault();
				setSectionUrl(key);
				scrollToSection(key);
			} catch (error) {
				return;
			}
		});
	});

	/**
	 * Onload: Section aus URL ansteuern.
	 */
	if (getSectionKeyFromPath(window.location.pathname)) {
		scrollToSection(getSectionKeyFromPath(window.location.pathname), 'auto');
	}

	/**
	 * Browser-History: Section anpassen.
	 */
	window.addEventListener('popstate', () => {
		const key = getSectionKeyFromPath(window.location.pathname);
		if (!key) {
			return;
		}
		scrollToSection(key, 'auto');
	});
};

export default smoothScroll;