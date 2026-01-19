import devHelpers from './global/devhelper';
import initWorkItemScramble from './global/textscrambler';
import startAutoplayVideos from './global/videoautoplay';
import imageRotator from './global/imagerotator';
import parallax from './global/parallax';
import smoothScroll from './global/smoothscroll';
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
	initImageFade();
	modalHandler();
	new Swiper('.modal-swiper', {
		modules: [Autoplay, Navigation, Pagination],
		loop: true,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev'
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true
		}
	});
})();