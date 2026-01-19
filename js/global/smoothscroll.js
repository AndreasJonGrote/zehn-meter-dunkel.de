/* Section-Links ohne Reload scrollen */
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

	/* Basis-Pfad für Section-URLs bestimmen */
	const getBasePath = () => {
		const normalizedPath = window.location.pathname.replace(/\/+$/, '');
		const segments = normalizedPath.split('/').filter(Boolean);
		const lastSegment = segments[segments.length - 1] || '';

		if (sectionKeys.includes(lastSegment) || modalKeys.includes(lastSegment) || lastSegment === 'index.php') {
			segments.pop();
		}

		return `/${segments.join('/')}${segments.length ? '/' : ''}`;
	};

	/* Section-Key aus Pfad lesen */
	const getSectionKeyFromPath = (pathname) => {
		const normalizedPath = pathname.replace(/\/+$/, '');
		const segments = normalizedPath.split('/').filter(Boolean);
		const lastSegment = segments[segments.length - 1] || '';

		if (sectionKeys.includes(lastSegment)) {
			return lastSegment;
		}

		return '';
	};

	/* Section anscrollen */
	const scrollToSection = (key, behavior = 'smooth') => {
		const target = document.getElementById(key);
		if (!target) {
			return false;
		}
		target.scrollIntoView({ behavior, block: 'start' });
		return true;
	};

	/* URL auf Section setzen */
	const setSectionUrl = (key, method = 'push') => {
		const nextUrl = `${basePath}${key}/${baseSearch}`;
		const state = { section: key };
		if (method === 'replace') {
			history.replaceState(state, '', nextUrl);
			return;
		}
		history.pushState(state, '', nextUrl);
	};

	const basePath = getBasePath();
	const baseSearch = window.location.search;

	anchors.forEach((anchor) => {
		anchor.addEventListener('click', (event) => {
			const href = anchor.getAttribute('href');
			if (!href) {
				return;
			}

			if (href.startsWith('#')) {
				const key = href.replace('#', '');
				if (!sectionKeys.includes(key)) {
					return;
				}
				event.preventDefault();
				setSectionUrl(key);
				scrollToSection(key);
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

	/* Onload: Section aus URL ansteuern */
	if (getSectionKeyFromPath(window.location.pathname)) {
		scrollToSection(getSectionKeyFromPath(window.location.pathname), 'auto');
	}

	/* Browser-History: Section anpassen */
	window.addEventListener('popstate', () => {
		const key = getSectionKeyFromPath(window.location.pathname);
		if (!key) {
			return;
		}
		scrollToSection(key, 'auto');
	});
};

export default smoothScroll;