import devHelpers from './global/devhelper';

(() => {
	devHelpers(true, { enable: true, onload: false, opacity: 10 });
})();

/**
 * Navigation Konfiguration
 * @type {Object}
 * @property {boolean} open Startet die Navigation (Default: false)
 */
const navigation = document.querySelector('.navigation');
const navigation_button = document.querySelector('.navigation-button');

const closeNavigation = () => {
	navigation.classList.remove('navigation-open');
	document.body.classList.remove('navigation-open');
};

const openNavigation = () => {
	navigation.classList.add('navigation-open');
	document.body.classList.add('navigation-open');
};

navigation_button.addEventListener('click', () => {
	if (navigation.classList.contains('navigation-open')) {
		closeNavigation();
	} else {
		openNavigation();
	}
});

// Navigation-Links schließen die Navigation
const navLinks = navigation.querySelectorAll('a');
navLinks.forEach(link => {
	link.addEventListener('click', () => {
		closeNavigation();
	});
});

// ESC-Taste schließt die Navigation
document.addEventListener('keydown', (e) => {
	if (e.key === 'Escape' && navigation.classList.contains('navigation-open')) {
		closeNavigation();
	}
}); 

/**
 * Scramble-Animation Konfiguration
 * @type {Object}
 * @property {number} animationDuration Dauer der Scramble-Animation in ms
 * @property {number} interval Zeit zwischen Begriffen in ms (Default: 4000) (1 Minute = 60000ms)
 * @property {boolean} onload Startet die Animation beim Laden der Seite (Default: false)
 */
const SCRAMBLE_CONFIG = {
	animationDuration: 600, // Dauer der Scramble-Animation in ms
	interval: 60000, // Zeit zwischen Begriffen in ms (Default: 4000) (1 Minute = 60000ms)
	onload: false // Startet die Animation beim Laden der Seite (Default: false)
};

/**
 * Animiert den übergebenen Textinhalt mit einem Scramble-Effekt.
 */
class TextScrambler {
	/**
	 * @param {HTMLElement} el Ziel-Element für die Animation.
	 */
	constructor(el) {
		this.el = el;
		this.chars = '!<>-_\\/[]{}—=+*^?#________';
		this.update = this.update.bind(this);
		this.frameRate = 1000 / 60;
		this.framesTotal = Math.floor(SCRAMBLE_CONFIG.animationDuration / this.frameRate);
	}

	/**
	 * Startet die Animation hin zu einem neuen Text.
	 * @param {string} newText Zieltext für die Scramble-Animation.
	 * @returns {Promise<void>} Wird nach Abschluss der Animation aufgelöst.
	 */
	setText(newText) {
		const current = this.el.textContent || '';
		const paddedNew = newText.padEnd(current.length).substring(0, current.length);
		const promise = new Promise(resolve => {
			this.resolve = resolve;
		});
		this.queue = [];

		for (let i = 0; i < current.length; i++) {
			const from = current[i] || '';
			const to = paddedNew[i] || '';
			const start = Math.floor(Math.random() * (this.framesTotal * 0.3));
			const end = start + Math.floor(Math.random() * (this.framesTotal * 0.7));
			this.queue.push({ from, to, start, end });
		}

		cancelAnimationFrame(this.frameRequest);
		this.frame = 0;
		this.update();
		return promise;
	}

	/**
	 * Führt den Frame-Loop der Animation aus.
	 * @returns {void}
	 */
	update() {
		let output = '';
		let complete = 0;

		for (let i = 0; i < this.queue.length; i++) {
			const { from, to, start, end } = this.queue[i];
			let char = this.queue[i].char;

			if (this.frame >= end) {
				complete++;
				output += to;
			} else if (this.frame >= start) {
				if (!char || Math.random() < 0.28) {
					char = this.randomChar();
					this.queue[i].char = char;
				}
				output += `<span class="dud">${char}</span>`;
			} else {
				output += from;
			}
		}

		this.el.innerHTML = output;

		if (complete === this.queue.length) {
			this.resolve();
		} else {
			this.frameRequest = requestAnimationFrame(this.update);
			this.frame++;
		}
	}

	/**
	 * Liefert ein zufälliges Zeichen aus dem Zeichenvorrat.
	 * @returns {string} Ein zufällig ausgewähltes Zeichen.
	 */
	randomChar() {
		return this.chars[Math.floor(Math.random() * this.chars.length)];
	}
}

// Initialisierung
document.querySelectorAll('[data-scramble]').forEach(el => {
	const datasetValue = (el.dataset.scramble || '').trim();
	const parsedPhrases = datasetValue.length
		? datasetValue.split(',').map(phrase => phrase.trim()).filter(Boolean)
		: [];
	const fallbackText = el.textContent || '';
	const phrases = parsedPhrases.length ? parsedPhrases : [fallbackText];
	const fx = new TextScrambler(el);
	let counter = 0;

	el.textContent = phrases[0] || '';

	const delay = parseInt(el.dataset.scrambleDelay || '0', 10) || 0;
	const onloadAttr = el.dataset.scrambleOnload;
	const startOnLoad = typeof onloadAttr === 'string'
		? onloadAttr.toLowerCase() === 'true'
		: SCRAMBLE_CONFIG.onload;

	const loop = () => {
		counter = (counter + 1) % phrases.length;
		fx.setText(phrases[counter]).then(() => {
			setTimeout(loop, SCRAMBLE_CONFIG.interval);
		});
	};

	const initialTimeout = delay + (startOnLoad ? 0 : SCRAMBLE_CONFIG.interval);
	setTimeout(loop, initialTimeout);
});

/**
 * Startet alle Videos mit autoplay-Attribut programmatisch
 */
const startAutoplayVideos = () => {
	const videos = document.querySelectorAll('video[autoplay]');
	videos.forEach(video => {
		const playPromise = video.play();
		if (playPromise !== undefined) {
			playPromise.catch(() => {
				// Fallback: Versuche erneut nach kurzer Verzögerung
				setTimeout(() => {
					video.play().catch(() => {});
				}, 100);
			});
		}
	});
};

// Videos beim Laden der Seite starten
if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', startAutoplayVideos);
} else {
	startAutoplayVideos();
}

/**
 * Initialisiert Bildfading für Container mit mehreren Bildern
 */
const initImageFade = () => {
	const containers = document.querySelectorAll('.image-fade-container');
	
	containers.forEach(container => {
		const allPictures = container.querySelectorAll('.image-fade-item');
		if (allPictures.length <= 1) return;
		
		// Container-Höhe vom ersten Bild übernehmen und erstes Bild auf absolute setzen
		const firstPicture = allPictures[0];
		const firstImg = firstPicture.querySelector('img');
		
		const setupContainer = () => {
			if (firstImg && firstImg.offsetHeight > 0) {
				container.style.minHeight = `${firstImg.offsetHeight}px`;
				firstPicture.classList.add('absolute', 'inset-0');
				firstImg.classList.add('h-full', 'object-cover');
			}
		};
		
		if (firstImg) {
			if (firstImg.complete) {
				setupContainer();
			} else {
				firstImg.onload = setupContainer;
			}
		}
		
		let currentIndex = 0;
		const fadeDuration = 2000;
		const displayDuration = 3000;
		
		const fadeNext = () => {
			const currentPicture = allPictures[currentIndex];
			const nextIndex = (currentIndex + 1) % allPictures.length;
			const nextPicture = allPictures[nextIndex];
			
			nextPicture.style.opacity = '1';
			currentPicture.style.opacity = '0';
			
			setTimeout(() => {
				currentIndex = nextIndex;
				setTimeout(fadeNext, displayDuration);
			}, fadeDuration);
		};
		
		setTimeout(fadeNext, displayDuration);
	});
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initImageFade);
} else {
	initImageFade();
}