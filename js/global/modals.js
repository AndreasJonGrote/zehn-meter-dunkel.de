/* Modal öffnen/schließen und Events binden */
const modalHandler = () => {
	const triggers = document.querySelectorAll('a[data-modal]');
	const overlays = document.querySelectorAll('.modal-overlay[data-modal]');
	const logoLink = document.querySelector('header a[href*="#top"]');
	const closeButton = document.querySelector('header button.bg-svg-menu-close-white');
	let activeOverlay = null;

	if (!triggers.length || !overlays.length) {
		return;
	}

	const openModal = (overlay) => {
		activeOverlay = overlay;
		document.body.classList.add('modal-open');
		overlay.classList.remove('opacity-0', 'pointer-events-none');
		overlay.classList.add('opacity-100', 'pointer-events-auto');
	};

	const closeModal = () => {
		if (!activeOverlay) {
			return;
		}
		activeOverlay.classList.add('opacity-0', 'pointer-events-none');
		activeOverlay.classList.remove('opacity-100', 'pointer-events-auto');
		document.body.classList.remove('modal-open');
		activeOverlay = null;
	};

	triggers.forEach((trigger) => {
		trigger.addEventListener('click', (event) => {
			const target = trigger.getAttribute('data-modal');
			const overlay = document.querySelector(`.modal-overlay[data-modal="${target}"]`);
			if (!overlay) {
				return;
			}
			event.preventDefault();
			openModal(overlay);
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
};

export default modalHandler;