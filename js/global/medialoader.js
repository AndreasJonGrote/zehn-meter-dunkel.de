/**
 * Laedt Medien priorisiert: erst Viewport, danach Rest.
 * Videos nur bei echter Sichtbarkeit (IntersectionObserver).
 */
const initMediaLoader = () => {
	const images = Array.from(document.querySelectorAll('img'));
	const videos = Array.from(document.querySelectorAll('video'));

	if (!images.length && !videos.length) {
		return;
	}

	const vh = window.innerHeight;

	const isInFirstScreen = (el) => {
		const rect = el.getBoundingClientRect();
		return rect.top < vh && rect.bottom > 0;
	};

	images.forEach((img) => {
		if (!isInFirstScreen(img)) {
			img.setAttribute('loading', 'lazy');
			img.setAttribute('fetchpriority', 'low');
			return;
		}
		img.setAttribute('loading', 'eager');
	});

	let firstVideoHandled = false;
	const videoObserver = new IntersectionObserver((entries) => {
		entries.forEach((entry) => {
			const video = entry.target;
			if (!entry.isIntersecting) {
				return;
			}
			if (video.readyState > 0) {
				return;
			}
			video.setAttribute('preload', 'auto');
			video.load();
			if (video.autoplay) {
				video.play().catch(() => {});
			}
			videoObserver.unobserve(video);
		});
	}, { rootMargin: '50px', threshold: 0.1 });

	videos.forEach((video) => {
		if (video.closest('.modal-overlay')) {
			return;
		}
		if (isInFirstScreen(video) && !firstVideoHandled) {
			firstVideoHandled = true;
			video.setAttribute('preload', 'auto');
			video.load();
			if (video.autoplay) {
				video.play().catch(() => {});
			}
			return;
		}
		videoObserver.observe(video);
	});

	const loadRemainingMedia = () => {
		images.forEach((img) => {
			if (img.complete) return;
			img.setAttribute('loading', 'eager');
			img.setAttribute('fetchpriority', 'low');
		});
		videos.forEach((video) => {
			if (video.closest('.modal-overlay')) return;
			if (video.readyState > 0) return;
			video.setAttribute('preload', 'auto');
			video.load();
		});
	};

	if (document.readyState === 'complete') {
		loadRemainingMedia();
		return;
	}
	window.addEventListener('load', loadRemainingMedia);
};

export default initMediaLoader;
