/* Modal öffnen/schließen und Events binden */
const modalHandler = () => {
	const triggers = document.querySelectorAll('a[data-modal]');
	const overlays = document.querySelectorAll('.modal-overlay[data-modal]');
	const logoLink = document.querySelector('header a[href*="#top"]');
	const closeButton = document.querySelector('header button.bg-svg-menu-close-white');
	const defaultTitle = document.title;
	let activeOverlay = null;

	if (!triggers.length || !overlays.length) {
		return;
	}

	/* Modal-Overlay anhand Key finden */
	const getOverlayByKey = (key) => document.querySelector(`.modal-overlay[data-modal="${key}"]`);

	/* Modaltitel aus H2 ziehen */
	const getModalTitle = (overlay) => {
		const title = overlay.querySelector('h2');
		return title ? title.textContent.trim() : '';
	};

	/* Modal einblenden */
	const openModal = (overlay, updateHash = true) => {
		if (activeOverlay && activeOverlay !== overlay) {
			activeOverlay.classList.add('opacity-0', 'pointer-events-none');
			activeOverlay.classList.remove('opacity-100', 'pointer-events-auto');
		}
		activeOverlay = overlay;
		document.body.classList.add('modal-open');
		overlay.classList.remove('opacity-0', 'pointer-events-none');
		overlay.classList.add('opacity-100', 'pointer-events-auto');

		const modalTitle = getModalTitle(overlay);
		if (modalTitle) {
			document.title = `${modalTitle} | ${defaultTitle}`;
		}

		if (updateHash) {
			const key = overlay.getAttribute('data-modal');
			if (key) {
				window.location.hash = key;
			}
		}
	};

	/* Modal ausblenden */
	const closeModal = () => {
		if (!activeOverlay) {
			return;
		}
		activeOverlay.classList.add('opacity-0', 'pointer-events-none');
		activeOverlay.classList.remove('opacity-100', 'pointer-events-auto');
		document.body.classList.remove('modal-open');
		document.title = defaultTitle;
		history.replaceState(null, '', `${window.location.pathname}${window.location.search}`);
		activeOverlay = null;
	};

	triggers.forEach((trigger) => {
		trigger.addEventListener('click', (event) => {
			const target = trigger.getAttribute('data-modal');
			const overlay = getOverlayByKey(target);
			if (!overlay) {
				return;
			}
			event.preventDefault();
			openModal(overlay, true);
		});
	});

	document.addEventListener('keydown', (event) => {
		if (event.key === 'Escape') {
			closeModal();
		}
	});

	if (logoLink) {
		logoLink.addEventListener('click', () => {
			closeModal();
		});
	}

	if (closeButton) {
		closeButton.addEventListener('click', (event) => {
			event.preventDefault();
			closeModal();
		});
	}

	/* Onload: Hash-Modal öffnen */
	if (window.location.hash) {
		const hashKey = window.location.hash.replace('#', '');
		const overlay = getOverlayByKey(hashKey);
		if (overlay) {
			openModal(overlay, false);
		}
	}
};

export default modalHandler;