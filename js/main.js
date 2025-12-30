import devHelpers from './global/devhelper';
import initWorkItemScramble from './global/textscrambler';
import startAutoplayVideos from './global/videoautoplay';
import imageRotator from './global/imagerotator';
import parallax from './global/parallax';
import smoothScroll from './global/smoothscroll';
import initImageFade from './global/imagefade';

const debug = true;

(() => {
	devHelpers(true, { enable: true, onload: false, opacity: 10 });
	initWorkItemScramble({animationDuration: 1000, interval: 60000, onload: false});
	startAutoplayVideos();
	imageRotator();
	parallax();
	smoothScroll();
	initImageFade();
})();