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
	const modalScrollbars = new WeakMap();

	scrollbar.className = 'custom-scrollbar custom-scrollbar--main';
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

	let scrollRaf = null;
	const onScroll = () => {
		if (document.body.classList.contains('modal-open') || isDragging) return;
		if (scrollRaf) return;
		scrollRaf = requestAnimationFrame(() => {
			scrollRaf = null;
			updateTarget();
			if (!isRunning) requestAnimationFrame(render);
		});
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

	/**
	 * Modal-Status pruefen und Sichtbarkeit steuern.
	 */
	const updateVisibility = () => {
		if (document.body.classList.contains('modal-open')) {
			scrollbar.style.display = 'none';
			return;
		}
		scrollbar.style.display = '';
		updateMetrics();
		updateTarget();
		if (!isRunning) {
			requestAnimationFrame(render);
		}
	};

	/**
	 * Modal-Scrollbar aufsetzen.
	 */
	const initModalScrollbar = (overlay) => {
		if (!overlay || modalScrollbars.has(overlay)) {
			return;
		}

		const modalScrollbar = document.createElement('div');
		const modalThumb = document.createElement('div');
		modalScrollbar.className = 'custom-scrollbar custom-scrollbar--modal';
		modalScrollbar.setAttribute('aria-hidden', 'true');
		modalThumb.className = 'custom-scrollbar-thumb';
		modalScrollbar.appendChild(modalThumb);
		document.body.appendChild(modalScrollbar);
		modalScrollbar.style.height = `${window.innerHeight}px`;

		let modalMaxScroll = 0;
		let modalTrackHeight = 0;
		let modalThumbHeight = 0;
		let modalTargetY = 0;
		let modalCurrentY = 0;
		let modalIsRunning = false;
		let modalIsDragging = false;
		let modalDragOffset = 0;

		/**
		 * Modal-Metriken berechnen.
		 */
		const updateModalMetrics = () => {
			modalMaxScroll = Math.max(0, overlay.scrollHeight - overlay.clientHeight);
			modalTrackHeight = window.innerHeight;
			modalScrollbar.style.height = `${modalTrackHeight}px`;
			const ratio = overlay.scrollHeight ? overlay.clientHeight / overlay.scrollHeight : 1;
			modalThumbHeight = Math.max(24, modalTrackHeight * ratio);
			modalThumb.style.height = `${modalThumbHeight}px`;
			modalScrollbar.style.display = modalMaxScroll > 0 ? '' : 'none';
		};

		/**
		 * Modal-Zielposition setzen.
		 */
		const updateModalTarget = () => {
			const progress = modalMaxScroll ? overlay.scrollTop / modalMaxScroll : 0;
			const maxThumbY = Math.max(0, modalTrackHeight - modalThumbHeight);
			modalTargetY = clamp(progress * maxThumbY, 0, maxThumbY);
		};

		/**
		 * Modal-Scroll aus Thumb-Position setzen.
		 */
		const setModalScrollFromThumb = (nextThumbY) => {
			const maxThumbY = Math.max(0, modalTrackHeight - modalThumbHeight);
			const safeThumbY = clamp(nextThumbY, 0, maxThumbY);
			const progress = maxThumbY ? safeThumbY / maxThumbY : 0;
			overlay.scrollTop = progress * modalMaxScroll;
			modalTargetY = safeThumbY;
			modalCurrentY = safeThumbY;
		};

		/**
		 * Modal-Thumb rendern.
		 */
		const renderModal = () => {
			if (prefersReducedMotion) {
				modalThumb.style.transform = `translate3d(0, ${modalTargetY}px, 0)`;
				modalIsRunning = false;
				return;
			}

			modalIsRunning = true;
			modalCurrentY += (modalTargetY - modalCurrentY) * 0.18;

			if (Math.abs(modalTargetY - modalCurrentY) < 0.5) {
				modalCurrentY = modalTargetY;
			}

			modalThumb.style.transform = `translate3d(0, ${modalCurrentY}px, 0)`;

			if (modalCurrentY !== modalTargetY) {
				requestAnimationFrame(renderModal);
				return;
			}

			modalIsRunning = false;
		};

		/**
		 * Modal-Scroll verfolgen.
		 */
		const onModalScroll = () => {
			if (modalIsDragging) {
				return;
			}
			updateModalTarget();
			if (!modalIsRunning) {
				requestAnimationFrame(renderModal);
			}
		};

		/**
		 * Modal-Drag starten.
		 */
		const onModalThumbPointerDown = (event) => {
			if (event.button !== 0) {
				return;
			}
			event.preventDefault();
			modalIsDragging = true;
			const trackRect = modalScrollbar.getBoundingClientRect();
			modalDragOffset = event.clientY - (trackRect.top + modalCurrentY);
			modalThumb.setPointerCapture(event.pointerId);
		};

		/**
		 * Modal-Drag bewegen.
		 */
		const onModalPointerMove = (event) => {
			if (!modalIsDragging) {
				return;
			}
			const trackRect = modalScrollbar.getBoundingClientRect();
			const nextThumbY = event.clientY - trackRect.top - modalDragOffset;
			setModalScrollFromThumb(nextThumbY);
			modalThumb.style.transform = `translate3d(0, ${modalCurrentY}px, 0)`;
		};

		/**
		 * Modal-Drag beenden.
		 */
		const onModalPointerUp = (event) => {
			if (!modalIsDragging) {
				return;
			}
			modalIsDragging = false;
			modalThumb.releasePointerCapture(event.pointerId);
			updateModalTarget();
			if (!modalIsRunning) {
				requestAnimationFrame(renderModal);
			}
		};

		/**
		 * Modal-Track-Klick behandeln.
		 */
		const onModalTrackPointerDown = (event) => {
			if (event.target === modalThumb || event.button !== 0) {
				return;
			}
			const trackRect = modalScrollbar.getBoundingClientRect();
			const nextThumbY = event.clientY - trackRect.top - modalThumbHeight / 2;
			setModalScrollFromThumb(nextThumbY);
			if (!modalIsRunning) {
				requestAnimationFrame(renderModal);
			}
		};

		/**
		 * Modal-Scrollbar aufraeumen.
		 */
		const cleanup = () => {
			overlay.removeEventListener('scroll', onModalScroll);
			modalScrollbar.removeEventListener('pointerdown', onModalTrackPointerDown);
			modalThumb.removeEventListener('pointerdown', onModalThumbPointerDown);
			window.removeEventListener('pointermove', onModalPointerMove);
			window.removeEventListener('pointerup', onModalPointerUp);
			window.removeEventListener('resize', updateModalMetrics);
			if (modalScrollbar.parentNode) {
				modalScrollbar.parentNode.removeChild(modalScrollbar);
			}
			if (modalScrollbars.has(overlay)) {
				modalScrollbars.delete(overlay);
			}
		};

		updateModalMetrics();
		updateModalTarget();
		renderModal();

		requestAnimationFrame(() => {
			updateModalMetrics();
			updateModalTarget();
			renderModal();
		});

		overlay.addEventListener('scroll', onModalScroll, { passive: true });
		modalScrollbar.addEventListener('pointerdown', onModalTrackPointerDown);
		modalThumb.addEventListener('pointerdown', onModalThumbPointerDown);
		window.addEventListener('pointermove', onModalPointerMove);
		window.addEventListener('pointerup', onModalPointerUp);
		window.addEventListener('resize', updateModalMetrics);

		modalScrollbars.set(overlay, { cleanup, updateModalMetrics });
	};

	/**
	 * Modal-Scrollbar entfernen.
	 */
	const destroyModalScrollbar = (overlay) => {
		const entry = modalScrollbars.get(overlay);
		if (!entry) {
			return;
		}
		entry.cleanup();
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
	document.addEventListener('modal:open', (event) => {
		updateVisibility();
		initModalScrollbar(event.detail?.overlay);
	});
	document.addEventListener('modal:close', (event) => {
		destroyModalScrollbar(event.detail?.overlay);
		updateVisibility();
	});
};

export default initScrollbar;
