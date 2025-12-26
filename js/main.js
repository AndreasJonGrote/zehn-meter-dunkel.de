import devHelpers from './global/devhelper';
import initWorkItemScramble from './global/textscrambler';
import startAutoplayVideos from './global/videoautoplay';
import imageRotator from './global/imagerotator';
import parallax from './global/parallax';

const debug = true;

(() => {
	devHelpers(true, { enable: true, onload: false, opacity: 10 });
	initWorkItemScramble({animationDuration: 1000, interval: 60000, onload: false});
	startAutoplayVideos();
	imageRotator();
	parallax();
})();

/**
 * Initialisiert Bildfading für Container mit mehreren Bildern
 */
const initImageFade = () => {
	const DISPLAY_DURATION = 5000;
	
	const containers = Array.from(document.querySelectorAll('.image-fade-container'));
	const containerData = [];
	let lastFadedContainerIndex = -1;
	let debugTimer = null;
	let nextTargetContainer = null;
	
	// Container vorbereiten
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
		
		containerData.push({
			container,
			pictures: Array.from(allPictures)
		});
	});
	
	if (containerData.length === 0) return;
	
	// Debug-Timer erstellen/aktualisieren
	const updateDebugTimer = (targetContainer, remainingMs) => {
		if (!debug) return;
		
		// Alten Timer entfernen
		if (debugTimer) {
			debugTimer.remove();
		}
		
		// Neuen Timer erstellen
		debugTimer = document.createElement('div');
		debugTimer.style.cssText = 'position: absolute; top: 10px; right: 10px; background: rgba(0,0,0,0.8); color: white; padding: 5px 10px; border-radius: 4px; font-family: monospace; font-size: 12px; z-index: 1000;';
		debugTimer.textContent = `${Math.round(remainingMs)}ms`;
		targetContainer.container.style.position = 'relative';
		targetContainer.container.appendChild(debugTimer);
	};
	
	// Debug-Timer runterzählen
	const countdownTimer = (targetContainer, remainingMs) => {
		if (!debug) return;
		
		if (remainingMs <= 0) {
			if (debugTimer) {
				debugTimer.remove();
				debugTimer = null;
			}
			return;
		}
		
		updateDebugTimer(targetContainer, remainingMs);
		
		setTimeout(() => {
			countdownTimer(targetContainer, remainingMs - 100);
		}, 100);
	};
	
	// Globale Fade-Funktion, die immer einen anderen Container wählt
	const fadeNext = () => {
		// Verfügbare Container (alle außer dem zuletzt gefadeten)
		const availableContainers = containerData.filter((_, index) => index !== lastFadedContainerIndex);
		
		// Wenn nur ein Container vorhanden, diesen verwenden
		const targetContainer = availableContainers.length > 0 
			? availableContainers[Math.floor(Math.random() * availableContainers.length)]
			: containerData[0];
		
		// Index des gewählten Containers finden
		const targetIndex = containerData.findIndex(data => data === targetContainer);
		lastFadedContainerIndex = targetIndex;
		
		// Zufälliges Bild im Container auswählen
		const { pictures } = targetContainer;
		
		// Aktuell sichtbares Bild finden
		let currentVisibleIndex = -1;
		pictures.forEach((picture, index) => {
			const opacity = parseFloat(picture.style.opacity) || (index === 0 ? 1 : 0);
			if (opacity > 0.5) {
				currentVisibleIndex = index;
			}
		});
		
		// Verfügbare Bilder (alle außer dem aktuell sichtbaren)
		const availableIndices = pictures.map((_, index) => index).filter(index => index !== currentVisibleIndex);
		
		// Zufälliges Bild aus den verfügbaren wählen
		const randomIndex = availableIndices.length > 0 
			? availableIndices[Math.floor(Math.random() * availableIndices.length)]
			: (currentVisibleIndex + 1) % pictures.length;
		
		const randomPicture = pictures[randomIndex];
		const currentPicture = currentVisibleIndex >= 0 ? pictures[currentVisibleIndex] : null;
		
		// Fade-Effekt (CSS-Transition wird automatisch verwendet)
		if (currentPicture) {
			currentPicture.style.opacity = '0';
		}
		randomPicture.style.opacity = '1';
		
		// Nächstes Timing berechnen
		const nextDelay = DISPLAY_DURATION;
		
		// Nächstes Element bestimmen
		const nextAvailableContainers = containerData.filter((_, index) => index !== targetIndex);
		nextTargetContainer = nextAvailableContainers.length > 0 
			? nextAvailableContainers[Math.floor(Math.random() * nextAvailableContainers.length)]
			: containerData[0];
		
		// Debug-Timer starten
		if (debug) {
			countdownTimer(nextTargetContainer, nextDelay);
		}
		
		setTimeout(fadeNext, nextDelay);
	};
	
	// Start mit Delay
	const startDelay = DISPLAY_DURATION;
	
	// Erstes Element bestimmen und direkt faden
	const firstAvailableContainers = containerData;
	const firstTargetContainer = firstAvailableContainers[Math.floor(Math.random() * firstAvailableContainers.length)];
	const firstTargetIndex = containerData.findIndex(data => data === firstTargetContainer);
	lastFadedContainerIndex = firstTargetIndex;
	
	// Erstes Fade direkt ausführen
	const { pictures: firstPictures } = firstTargetContainer;
	
	let firstCurrentVisibleIndex = -1;
	firstPictures.forEach((picture, index) => {
		const opacity = parseFloat(picture.style.opacity) || (index === 0 ? 1 : 0);
		if (opacity > 0.5) {
			firstCurrentVisibleIndex = index;
		}
	});
	
	// Verfügbare Bilder (alle außer dem aktuell sichtbaren)
	const firstAvailableIndices = firstPictures.map((_, index) => index).filter(index => index !== firstCurrentVisibleIndex);
	
	// Zufälliges Bild aus den verfügbaren wählen
	const firstRandomIndex = firstAvailableIndices.length > 0 
		? firstAvailableIndices[Math.floor(Math.random() * firstAvailableIndices.length)]
		: (firstCurrentVisibleIndex + 1) % firstPictures.length;
	
	const firstRandomPicture = firstPictures[firstRandomIndex];
	const firstCurrentPicture = firstCurrentVisibleIndex >= 0 ? firstPictures[firstCurrentVisibleIndex] : null;
	
	if (firstCurrentPicture) {
		firstCurrentPicture.style.opacity = '0';
	}
	firstRandomPicture.style.opacity = '1';
	
	// Nächstes Element für den Timer bestimmen
	const nextAvailableContainers = containerData.filter((_, index) => index !== firstTargetIndex);
	nextTargetContainer = nextAvailableContainers.length > 0 
		? nextAvailableContainers[Math.floor(Math.random() * nextAvailableContainers.length)]
		: containerData[0];
	
	if (debug) {
		countdownTimer(nextTargetContainer, startDelay);
	}
	
	setTimeout(fadeNext, startDelay);
};

if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initImageFade);
} else {
	initImageFade();
}

