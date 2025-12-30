const getModifierFromClass = (item) => {
	const classList = Array.from(item.classList);
	
	for (const className of classList) {
		if (className.startsWith('parallax-item-[')) {
			const match = className.match(/parallax-item-\[(-?\d+\.?\d*)\]/);
			if (match) {
				return parseFloat(match[1]);
			}
		}
	}
	
	return null;
};

const isInViewport = (element) => {
	const rect = element.getBoundingClientRect();
	const viewportHeight = window.innerHeight || document.documentElement.clientHeight;
	const viewportWidth = window.innerWidth || document.documentElement.clientWidth;
	
	return (
		rect.top < viewportHeight &&
		rect.bottom > 0 &&
		rect.left < viewportWidth &&
		rect.right > 0
	);
};

const initParallax = (item) => {
	if (!item.dataset.init) {
		// item.style.position = 'absolute';
		// item.style.top = '0';
		// item.style.left = '0';
		// item.style.width = '100%';
		// item.dataset.init = 'true';
	}
};

const parallax = () => {
	const allElements = document.querySelectorAll('[class*="parallax-item-["]');
	if (allElements.length === 0) return;

	allElements.forEach(item => {
		if (!isInViewport(item)) {
			return;
		}

		const modifier = getModifierFromClass(item);
		if (modifier === null) return;

		if (!item.dataset.init) {
			initParallax(item);
		}

		const scrollOffset = window.scrollY * modifier;
		item.style.transform = `translateY(${scrollOffset}px)`;
	});
};

window.addEventListener('scroll', () => {
	parallax();
}, { passive: true });
parallax();

export default parallax;