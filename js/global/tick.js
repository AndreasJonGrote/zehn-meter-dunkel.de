/* Basis-URL fuer Ajax (APP_BASE oder aus Script-Src ableiten) */
const getBase = () => {
	if (typeof window.APP_BASE === 'string' && window.APP_BASE) {
		return window.APP_BASE.replace(/\/$/, '');
	}
	const script = document.querySelector('script[src*="main.js"]');
	if (script?.src) {
		try {
			const u = new URL(script.src);
			const basePath = u.pathname.replace(/\/dist\/.*$/, '') || '/';
			return u.origin + basePath.replace(/\/$/, '');
		} catch {}
	}
	return '';
};

/* Tick: schlankes Analytics via ajax, load/scroll/time/modal/extern */
const tick = (event, extra) => {
	const base = getBase();
	if (!base) return;
	let url = `${base}/library/ajax.php?tick=${encodeURIComponent(event)}`;
	if (extra) url += `&page=${encodeURIComponent(extra)}`;
	fetch(url, { credentials: 'same-origin' }).catch(() => {});
};

/* Extern-Link: sendBeacon + sofort weiterleiten */
const tickExtern = (key, href, newTab) => {
	const base = getBase();
	if (!base) {
		if (newTab) window.open(href, '_blank');
		else location.href = href;
		return;
	}
	const params = new URLSearchParams({ tick: `extern-${key}`, url: href });
	navigator.sendBeacon(`${base}/library/ajax.php?${params}`);
	if (newTab) window.open(href, '_blank');
	else location.href = href;
};

const initTick = () => {
	if (!getBase()) return;

	let scrollDone = false;
	let loadDone = false;
	let timeDone = false;

	const doLoad = () => {
		if (loadDone) return;
		loadDone = true;
		const segments = location.pathname.replace(/\/$/, '').split('/').filter(Boolean);
		const page = segments.length > 1 ? segments[segments.length - 1] : 'index';
		tick('load', page);
	};

	let scrollRaf = null;
	const doScroll = () => {
		if (scrollDone || scrollRaf) return;
		scrollRaf = requestAnimationFrame(() => {
			scrollRaf = null;
			if (scrollDone) return;
			if (window.scrollY >= 500) {
				scrollDone = true;
				tick('scroll');
			}
		});
	};

	const doTime = () => {
		if (timeDone) return;
		timeDone = true;
		tick('time');
	};

	doLoad();
	setTimeout(doTime, 10000);
	window.addEventListener('scroll', doScroll, { passive: true });

	document.addEventListener('modal:open', (e) => {
		const key = e.detail?.overlay?.getAttribute('data-modal');
		if (key) tick(`modal-${key}`);
	});

	const externLinks = document.querySelectorAll('a[href^="http"]');
	const host = window.location.hostname;
	for (let i = 0; i < externLinks.length; i++) {
		const link = externLinks[i];
		try {
			const href = link.getAttribute('href');
			if (!href) continue;
			if (new URL(href).hostname === host) continue;
		} catch {
			continue;
		}
		link.addEventListener('click', (e) => {
			const href = link.getAttribute('href');
			const key = link.dataset.extern || (href ? new URL(href).hostname.replace(/^www\./, '') : 'extern');
			const newTab = link.target === '_blank';
			e.preventDefault();
			tickExtern(key, href, newTab);
		});
	}
};

export default initTick;
