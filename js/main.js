import devHelpers from './global/devhelper';
import initWorkItemScramble from './global/textscrambler';
import startAutoplayVideos from './global/videoautoplay';
import imageRotator from './global/imagerotator';
import parallax from './global/parallax';
import smoothScroll from './global/smoothscroll';
import initScrollbar from './global/scrollbar';
import initMediaLoader from './global/medialoader';
import initImageFade from './global/imagefade';
import modalHandler from './global/modals';
import Swiper from 'swiper';
import { Autoplay, Navigation, Pagination } from 'swiper/modules';

const debug = true;

(() => {
	devHelpers(true, { enable: true, onload: false, opacity: 10 });
	initWorkItemScramble({animationDuration: 1000, interval: 60000, onload: false});
	startAutoplayVideos();
	imageRotator();
	parallax();
	smoothScroll();
	initScrollbar();
	initMediaLoader();
	initImageFade();
	modalHandler();

	const swiperInstances = new WeakMap();

	/* Modal-Swiper initialisieren */
	const initModalSwipers = (overlay) => {
		if (!overlay) {
			return;
		}
		const modalSwipers = overlay.querySelectorAll('.modal-swiper');
		if (modalSwipers.length === 0) {
			return;
		}
		modalSwipers.forEach((swiperElement) => {
			if (swiperInstances.has(swiperElement)) {
				return;
			}
			const slideCount = swiperElement.querySelectorAll('.swiper-slide').length;
			const enableLoop = slideCount > 1;

			const instance = new Swiper(swiperElement, {
				modules: [Autoplay, Navigation, Pagination],
				loop: enableLoop,
				autoplay: enableLoop ? {
					delay: 5000,
					disableOnInteraction: false
				} : false,
				navigation: {
					nextEl: '.swiper-button-next',
					prevEl: '.swiper-button-prev'
				},
				pagination: {
					el: '.swiper-pagination',
					clickable: true
				}
			});

			swiperInstances.set(swiperElement, instance);
		});
	};

	/* Modal-Swiper entfernen */
	const destroyModalSwipers = (overlay) => {
		if (!overlay) {
			return;
		}
		const modalSwipers = overlay.querySelectorAll('.modal-swiper');
		if (modalSwipers.length === 0) {
			return;
		}
		modalSwipers.forEach((swiperElement) => {
			const instance = swiperInstances.get(swiperElement);
			if (!instance) {
				return;
			}
			instance.destroy(true, true);
			swiperInstances.delete(swiperElement);
		});
	};

	document.addEventListener('modal:open', (event) => {
		initModalSwipers(event.detail?.overlay);
	});

	document.addEventListener('modal:close', (event) => {
		destroyModalSwipers(event.detail?.overlay);
	});
})();