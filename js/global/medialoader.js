/**
 * Laedt Medien zuerst im Viewport, danach den Rest.
 */
const initMediaLoader = () => {
	const images = Array.from(document.querySelectorAll('img'));
	const videos = Array.from(document.querySelectorAll('video'));

	if (!images.length && !videos.length) {
		return;
	}

	/**
	 * Sichtbarkeit im Viewport pruefen.
	 */
	const isInViewport = (element) => {
		const rect = element.getBoundingClientRect();
		return rect.bottom > 0 && rect.top < window.innerHeight;
	};

	/**
	 * Erste Sichtbarkeitsrunde setzen.
	 */
	const primeViewportMedia = () => {
		images.forEach((image) => {
			image.setAttribute('loading', 'lazy');
			image.setAttribute('decoding', 'async');

			if (isInViewport(image)) {
				image.setAttribute('loading', 'eager');
				image.setAttribute('fetchpriority', 'high');
				return;
			}

			image.setAttribute('fetchpriority', 'low');
		});

		videos.forEach((video) => {
			if (isInViewport(video)) {
				video.setAttribute('preload', 'auto');
				if (video.autoplay) {
					video.play().catch(() => {});
				}
				return;
			}

			video.setAttribute('preload', 'none');
		});
	};

	/**
	 * Restliche Medien nachladen.
	 */
	const loadRemainingMedia = () => {
		images.forEach((image) => {
			if (image.complete) {
				return;
			}
			image.setAttribute('loading', 'eager');
			image.setAttribute('fetchpriority', 'low');
		});

		videos.forEach((video) => {
			if (video.readyState > 0) {
				return;
			}
			video.setAttribute('preload', 'auto');
			video.load();
		});
	};

	primeViewportMedia();

	if (document.readyState === 'complete') {
		loadRemainingMedia();
		return;
	}

	window.addEventListener('load', loadRemainingMedia);
};

export default initMediaLoader;
