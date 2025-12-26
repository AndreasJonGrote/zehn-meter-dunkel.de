/**
 * Scramble-Animation Konfiguration
 */
const SCRAMBLE_CONFIG = {
	animationDuration: 1000,
	interval: 60000,
	onload: false
};

/**
 * Liefert ein zufälliges Scramble-Zeichen
 */
const getRandomChar = () => {
	const chars = '!<>-_\\/[]{}—=+*^?#________';
	return chars[Math.floor(Math.random() * chars.length)];
};

/**
 * Führt Scramble-Animation für ein Element durch
 * @param {HTMLElement} element - Ziel-Element
 * @param {string} newText - Neuer Text
 * @param {number} duration - Animationsdauer in ms
 * @returns {Promise<void>}
 */
const scrambleText = (element, newText, duration) => {
	return new Promise(resolve => {
		const currentText = element.textContent || '';
		const targetText = newText.padEnd(currentText.length).substring(0, currentText.length);
		const frameRate = 1000 / 60;
		const framesTotal = Math.floor(duration / frameRate);
		
		// Queue für jeden Buchstaben erstellen
		const queue = [];
		for (let i = 0; i < currentText.length; i++) {
			const from = currentText[i] || '';
			const to = targetText[i] || '';
			const start = Math.floor(Math.random() * (framesTotal * 0.3));
			const end = start + Math.floor(Math.random() * (framesTotal * 0.7));
			queue.push({ from, to, start, end, char: null });
		}
		
		let frame = 0;
		let frameRequest = null;
		
		const update = () => {
			let output = '';
			let complete = 0;
			
			for (let i = 0; i < queue.length; i++) {
				const item = queue[i];
				
				if (frame >= item.end) {
					complete++;
					output += item.to;
				} else if (frame >= item.start) {
					if (!item.char || Math.random() < 0.28) {
						item.char = getRandomChar();
					}
					output += `<span class="dud">${item.char}</span>`;
				} else {
					output += item.from;
				}
			}
			
			element.innerHTML = output;
			
			if (complete === queue.length) {
				resolve();
			} else {
				frame++;
				frameRequest = requestAnimationFrame(update);
			}
		};
		
		cancelAnimationFrame(frameRequest);
		frame = 0;
		update();
	});
};

/**
 * Initialisiert Scramble für [data-scramble] Elemente
 */
const initDataScramble = () => {
	document.querySelectorAll('[data-scramble]').forEach(el => {
		const datasetValue = (el.dataset.scramble || '').trim();
		const phrases = datasetValue.length
			? datasetValue.split(',').map(phrase => phrase.trim()).filter(Boolean)
			: [el.textContent || ''];
		
		el.textContent = phrases[0] || '';
		
		const delay = parseInt(el.dataset.scrambleDelay || '0', 10) || 0;
		const onloadAttr = el.dataset.scrambleOnload;
		const startOnLoad = typeof onloadAttr === 'string'
			? onloadAttr.toLowerCase() === 'true'
			: SCRAMBLE_CONFIG.onload;
		
		let counter = 0;
		
		const loop = () => {
			counter = (counter + 1) % phrases.length;
			scrambleText(el, phrases[counter], SCRAMBLE_CONFIG.animationDuration).then(() => {
				setTimeout(loop, SCRAMBLE_CONFIG.interval);
			});
		};
		
		const initialTimeout = delay + (startOnLoad ? 0 : SCRAMBLE_CONFIG.interval);
		setTimeout(loop, initialTimeout);
	});
};

/**
 * Initialisiert Scramble für .work-item h2 beim Hover
 * @param {Object} [userConfig] - Optionale Konfiguration
 */
const initWorkItemScramble = (userConfig = {}) => {
	const config = {
		animationDuration: userConfig.animationDuration ?? SCRAMBLE_CONFIG.animationDuration,
		interval: userConfig.interval ?? SCRAMBLE_CONFIG.interval,
		onload: userConfig.onload ?? SCRAMBLE_CONFIG.onload
	};
	
	const workItems = document.querySelectorAll('.work-item');
	
	workItems.forEach(workItem => {
		const h2 = workItem.querySelector('h2');
		if (!h2) return;
		
		const originalText = h2.textContent;
		let isScrambling = false;
		
		workItem.addEventListener('mouseenter', () => {
			if (!isScrambling) {
				isScrambling = true;
				scrambleText(h2, originalText, config.animationDuration).then(() => {
					isScrambling = false;
				});
			}
		});
	});
};

// Automatische Initialisierung für [data-scramble]
if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initDataScramble);
} else {
	initDataScramble();
}

// Automatische Initialisierung für work-items
if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', initWorkItemScramble);
} else {
	initWorkItemScramble();
}

export default initWorkItemScramble;
