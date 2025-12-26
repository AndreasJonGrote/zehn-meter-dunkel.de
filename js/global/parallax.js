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

const initParallax = () => {
	const allElements = document.querySelectorAll('[class*="parallax-item-["]');
	if (allElements.length === 0) return;
};

const parallax = () => {
	const allElements = document.querySelectorAll('[class*="parallax-item-["]');
	if (allElements.length === 0) return;

	allElements.forEach(item => {
		const modifier = getModifierFromClass(item);
		if (modifier === null) return;

		if (!item.dataset.init) {
			initParallax();
		}

		const scrollOffset = window.scrollY * modifier;
		item.style.transform = `translateY(${scrollOffset}px)`;
	});
};

initParallax();
window.addEventListener('scroll', () => {
	parallax();
}, { passive: true });
parallax();

export default parallax;