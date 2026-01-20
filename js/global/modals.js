/* Modal öffnen/schließen und Events binden */
const modalHandler = () => {
	const triggers = document.querySelectorAll('a[data-modal]');
	const overlays = document.querySelectorAll('.modal-overlay[data-modal]');
	const logoLink = document.querySelector('header a[href*="#top"]');
	const closeButton = document.querySelector('header button.bg-svg-menu-close-white');
	const defaultTitle = document.title;
	let activeOverlay = null;
	const modalKeys = Array.from(overlays)
		.map((overlay) => overlay.getAttribute('data-modal'))
		.filter((key) => key);
	const sectionKeys = Array.from(document.querySelectorAll('section[id]'))
		.map((section) => section.getAttribute('id'))
		.filter((key) => key);

	if (!triggers.length || !overlays.length) {
		return;
	}

	/* Modal-Overlay anhand Key finden */
	const getOverlayByKey = (key) => document.querySelector(`.modal-overlay[data-modal="${key}"]`);

	/* Modalschluessel aus Pfad lesen */
	const getModalKeyFromPath = (pathname) => {
		const normalizedPath = pathname.replace(/\/+$/, '');
		const segments = normalizedPath.split('/').filter(Boolean);
		const lastSegment = segments[segments.length - 1] || '';

		if (modalKeys.includes(lastSegment)) {
			return lastSegment;
		}

		return '';
	};

	/* Basis-Pfad für URL-Updates bestimmen */
	const getBasePath = () => {
		const normalizedPath = window.location.pathname.replace(/\/+$/, '');
		const segments = normalizedPath.split('/').filter(Boolean);
		const lastSegment = segments[segments.length - 1] || '';

		if (modalKeys.includes(lastSegment) || sectionKeys.includes(lastSegment) || lastSegment === 'index.php') {
			segments.pop();
		}

		return `/${segments.join('/')}${segments.length ? '/' : ''}`;
	};

	/* URL auf Modal setzen */
	const setModalUrl = (key, method = 'push') => {
		const nextUrl = `${basePath}${key}/${baseSearch}`;
		const state = { modal: key };
		if (method === 'replace') {
			history.replaceState(state, '', nextUrl);
			return;
		}
		history.pushState(state, '', nextUrl);
	};

	/* URL auf Basis zurücksetzen */
	const resetModalUrl = (method = 'replace') => {
		if (method === 'replace') {
			history.replaceState(null, '', `${basePath}${baseSearch}`);
			return;
		}
		history.pushState(null, '', `${basePath}${baseSearch}`);
	};

	const basePath = getBasePath();
	const baseSearch = window.location.search;

	/* Modaltitel aus H2 ziehen */
	const getModalTitle = (overlay) => {
		const title = overlay.querySelector('h2');
		return title ? title.textContent.trim() : '';
	};

	/* Modal-Event auslösen */
	const emitModalEvent = (name, overlay) => {
		document.dispatchEvent(new CustomEvent(name, { detail: { overlay } }));
	};

	/* Modal einblenden */
	const openModal = (overlay, updateUrl = true, method = 'push') => {
		if (activeOverlay && activeOverlay !== overlay) {
			emitModalEvent('modal:close', activeOverlay);
			activeOverlay.classList.add('opacity-0', 'pointer-events-none');
			activeOverlay.classList.remove('opacity-100', 'pointer-events-auto');
		}
		activeOverlay = overlay;
		document.body.classList.add('modal-open');
		document.documentElement.classList.add('modal-open');
		overlay.classList.remove('opacity-0', 'pointer-events-none');
		overlay.classList.add('opacity-100', 'pointer-events-auto');
		emitModalEvent('modal:open', overlay);

		const modalTitle = getModalTitle(overlay);
		if (modalTitle) {
			document.title = `${modalTitle} | ${defaultTitle}`;
		}

		if (updateUrl) {
			const key = overlay.getAttribute('data-modal');
			if (key) {
				setModalUrl(key, method);
			}
		}
	};

	/* Modal ausblenden */
	const closeModal = (updateUrl = true, method = 'replace') => {
		if (!activeOverlay) {
			return;
		}
		activeOverlay.classList.add('opacity-0', 'pointer-events-none');
		activeOverlay.classList.remove('opacity-100', 'pointer-events-auto');
		document.body.classList.remove('modal-open');
		document.documentElement.classList.remove('modal-open');
		document.title = defaultTitle;
		emitModalEvent('modal:close', activeOverlay);
		if (updateUrl) {
			resetModalUrl(method);
		}
		activeOverlay = null;
	};

	/* Modal anhand Key öffnen */
	const openModalByKey = (key, updateUrl = true, method = 'push') => {
		const overlay = getOverlayByKey(key);
		if (!overlay) {
			return;
		}
		openModal(overlay, updateUrl, method);
	};

	triggers.forEach((trigger) => {
		trigger.addEventListener('click', (event) => {
			const target = trigger.getAttribute('data-modal');
			if (!target) {
				return;
			}
			event.preventDefault();
			openModalByKey(target, true, 'push');
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

	/* Onload: Pfad/Hash prüfen und Modal öffnen */
	const pathKey = getModalKeyFromPath(window.location.pathname);
	const hashKey = window.location.hash ? window.location.hash.replace('#', '') : '';
	const initialKey = pathKey || (modalKeys.includes(hashKey) ? hashKey : '');

	if (initialKey) {
		openModalByKey(initialKey, true, 'replace');
	}

	/* Browser-History: Modal an URL anpassen */
	window.addEventListener('popstate', () => {
		const currentKey = getModalKeyFromPath(window.location.pathname);
		if (currentKey) {
			openModalByKey(currentKey, false);
			return;
		}
		closeModal(false);
	});
};

export default modalHandler;