/**
 * Rotiert Bilder beim Scrollen
 * Unterstützt mehrere .image-rotator Elemente
 */
const imageRotator = () => {
	const rotators = document.querySelectorAll('.image-rotator');
	if (rotators.length === 0) return;
	
	rotators.forEach(rotator => {
		initRotator(rotator);
	});
};

/**
 * Initialisiert einen einzelnen Rotator
 */
const initRotator = (rotator) => {
	if (rotator.dataset.initialized === 'true') return;
	rotator.dataset.initialized = 'true';
	
	// Bilder finden (picture-Elemente oder spezifischer Selector)
	const imageItems = Array.from(rotator.querySelectorAll('picture'));
	if (imageItems.length <= 1) return;
	
	// Konfiguration aus data-Attributen oder Defaults
	const config = {
		rotationInterval: Number(rotator.dataset.rotationInterval) || 150,
		scrollTimeout: Number(rotator.dataset.scrollTimeout) || 1000,
		minScrollDistance: Number(rotator.dataset.minScrollDistance) || 1,
		marginRight: rotator.dataset.marginRight || '0.5rem',
		height: rotator.dataset.height ? Number(rotator.dataset.height) : null
	};
	
	// State
	let aspectRatio = null;
	let targetWidth = 0;
	let height = config.height;
	let isVisible = false;
	let currentIndex = 0;
	let scrollTimeout = null;
	let rotationInterval = null;
	let lastScrollY = 0;
	
	/**
	 * Berechnet Aspect Ratio aus den Bildern
	 */
	const calculateAspectRatio = () => {
		return new Promise((resolve) => {
			const firstImg = imageItems[0].querySelector('img');
			if (!firstImg) {
				resolve(733 / 1000); // Fallback
				return;
			}
			
			const checkImage = () => {
				if (firstImg.naturalWidth > 0 && firstImg.naturalHeight > 0) {
					aspectRatio = firstImg.naturalWidth / firstImg.naturalHeight;
					resolve(aspectRatio);
				} else if (firstImg.complete) {
					// Bild geladen aber keine Dimensionen - Fallback
					resolve(733 / 1000);
				} else {
					// Warten bis Bild geladen ist
					firstImg.addEventListener('load', checkImage, { once: true });
					firstImg.addEventListener('error', () => resolve(733 / 1000), { once: true });
				}
			};
			
			checkImage();
		});
	};
	
	/**
	 * Initialisiert Höhe und Breite
	 */
	const initializeDimensions = async () => {
		// Aspect Ratio berechnen
		await calculateAspectRatio();
		
		// Höhe bestimmen
		if (!height) {
			const computedHeight = getComputedStyle(rotator).height;
			height = parseInt(computedHeight) || 45;
		}
		
		// Zielbreite berechnen
		targetWidth = height * aspectRatio;
		
		// Container konfigurieren
		rotator.style.overflow = 'hidden';
		rotator.style.height = `${height}px`;
		rotator.style.aspectRatio = 'auto';
		
		// Bilder konfigurieren
		imageItems.forEach(picture => {
			const img = picture.querySelector('img');
			if (img) {
				img.style.objectFit = 'cover';
				img.style.width = '100%';
				img.style.height = '100%';
			}
		});
		
		// Initialisierung abschließen
		showImage(0);
		rotator.style.width = '0';
		rotator.style.marginRight = '0';
		lastScrollY = window.scrollY || window.pageYOffset || document.documentElement.scrollTop || 0;
		
		// Event-Listener registrieren
		setupEventListeners();
	};
	
	/**
	 * Zeigt ein bestimmtes Bild an
	 */
	const showImage = (index) => {
		imageItems.forEach((item, i) => {
			if (i === index) {
				item.classList.remove('hidden');
			} else {
				item.classList.add('hidden');
			}
		});
		currentIndex = index;
	};
	
	/**
	 * Startet Bildrotation
	 */
	const startRotation = () => {
		if (rotationInterval) return;
		
		rotationInterval = setInterval(() => {
			if (!isVisible) return;
			currentIndex = (currentIndex + 1) % imageItems.length;
			showImage(currentIndex);
		}, config.rotationInterval);
	};
	
	/**
	 * Stoppt Bildrotation
	 */
	const stopRotation = () => {
		if (rotationInterval) {
			clearInterval(rotationInterval);
			rotationInterval = null;
		}
	};
	
	/**
	 * Blendet Rotator ein
	 */
	const show = () => {
		if (isVisible || targetWidth === 0) return;
		
		isVisible = true;
		showImage(0);
		rotator.style.width = `${targetWidth}px`;
		rotator.style.marginRight = config.marginRight;
		startRotation();
	};
	
	/**
	 * Blendet Rotator aus
	 */
	const hide = () => {
		if (!isVisible) return;
		
		isVisible = false;
		stopRotation();
		rotator.style.width = '0';
		rotator.style.marginRight = '0';
		showImage(0);
	};
	
	let scrollRaf = null;
	const handleScroll = () => {
		if (scrollRaf) return;
		scrollRaf = requestAnimationFrame(() => {
			scrollRaf = null;
			const scrollY = window.scrollY || window.pageYOffset || document.documentElement.scrollTop;
			const scrollDelta = Math.abs(scrollY - lastScrollY);

			if (scrollDelta >= config.minScrollDistance) {
				if (scrollTimeout) clearTimeout(scrollTimeout);
				show();
				scrollTimeout = setTimeout(hide, config.scrollTimeout);
			}

			lastScrollY = scrollY;
		});
	};
	
	/**
	 * Event-Listener registrieren
	 */
	const setupEventListeners = () => {
		window.addEventListener('scroll', handleScroll, { passive: true });
		window.addEventListener('touchmove', handleScroll, { passive: true });
	};
	
	// Initialisierung starten
	initializeDimensions();
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', imageRotator);
} else {
	imageRotator();
}

export default imageRotator;
