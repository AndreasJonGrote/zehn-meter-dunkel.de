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
import initTick from './global/tick';

const debug = true;

(() => {
	// devHelpers(true, { enable: true, onload: false, opacity: 10 });
	initWorkItemScramble({animationDuration: 1000, interval: 60000, onload: false});
	startAutoplayVideos();
	imageRotator();
	parallax();
	smoothScroll();
	initScrollbar();
	initMediaLoader();
	initImageFade();
	modalHandler();
	initTick();

	const swiperInstances = new WeakMap();
	let swiperPromise = null;

	const getSwiper = () => {
		if (!swiperPromise) {
			swiperPromise = Promise.all([
				import('swiper'),
				import('swiper/modules')
			]).then(([swiperMod, modulesMod]) => ({
				Swiper: swiperMod.default,
				Autoplay: modulesMod.Autoplay,
				Navigation: modulesMod.Navigation,
				Pagination: modulesMod.Pagination
			}));
		}
		return swiperPromise;
	};

	const initModalSwipers = async (overlay) => {
		if (!overlay) return;
		const modalSwipers = overlay.querySelectorAll('.modal-swiper');
		if (modalSwipers.length === 0) return;
		const { Swiper, Autoplay, Navigation, Pagination } = await getSwiper();
		modalSwipers.forEach((swiperElement) => {
			if (swiperInstances.has(swiperElement)) return;
			const slideCount = swiperElement.querySelectorAll('.swiper-slide').length;
			const enableLoop = slideCount > 1;
			const instance = new Swiper(swiperElement, {
				modules: [Autoplay, Navigation, Pagination],
				loop: enableLoop,
				autoplay: enableLoop ? { delay: 5000, disableOnInteraction: false } : false,
				navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
				pagination: { el: '.swiper-pagination', clickable: true }
			});
			swiperInstances.set(swiperElement, instance);
		});
	};

	const destroyModalSwipers = (overlay) => {
		if (!overlay) return;
		overlay.querySelectorAll('.modal-swiper').forEach((swiperElement) => {
			const instance = swiperInstances.get(swiperElement);
			if (instance) {
				instance.destroy(true, true);
				swiperInstances.delete(swiperElement);
			}
		});
	};

	document.addEventListener('modal:open', (event) => {
		initModalSwipers(event.detail?.overlay);
	});
	document.addEventListener('modal:close', (event) => {
		destroyModalSwipers(event.detail?.overlay);
	});
})();