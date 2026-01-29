/* Breakpoint-Map (Tailwind-Standard) */
const breakpoints = {
	xs: 0,
	sm: 640,
	md: 768,
	lg: 1024,
	xl: 1280,
	'2xl': 1536
};

/* Aktuellen Breakpoint ermitteln */
const getCurrentBreakpoint = () => {
	const width = window.innerWidth;
	if (width >= breakpoints['2xl']) return '2xl';
	if (width >= breakpoints.xl) return 'xl';
	if (width >= breakpoints.lg) return 'lg';
	if (width >= breakpoints.md) return 'md';
	if (width >= breakpoints.sm) return 'sm';
	return 'xs';
};

/* Modifier aus Klassen extrahieren (mit Breakpoint-Unterstützung) */
const getModifierFromClass = (item) => {
	const classList = Array.from(item.classList);
	const currentBreakpoint = getCurrentBreakpoint();
	const breakpointOrder = ['xs', 'sm', 'md', 'lg', 'xl', '2xl'];
	const currentBreakpointIndex = breakpointOrder.indexOf(currentBreakpoint);
	
	let fallbackModifier = null;
	let bestMatchModifier = null;
	let bestMatchIndex = -1;
	
	for (const className of classList) {
		/* Ohne Breakpoint-Präfix (Fallback für alle) */
		const baseMatch = className.match(/^parallax-item-\[(-?\d+\.?\d*)\]$/);
		if (baseMatch) {
			fallbackModifier = parseFloat(baseMatch[1]);
			continue;
		}
		
		/* Mit Breakpoint-Präfix */
		const breakpointMatch = className.match(/^(xs|sm|md|lg|xl|2xl):parallax-item-\[(-?\d+\.?\d*)\]$/);
		if (breakpointMatch) {
			const breakpointName = breakpointMatch[1];
			const modifier = parseFloat(breakpointMatch[2]);
			const breakpointIndex = breakpointOrder.indexOf(breakpointName);
			
			/* Nur Breakpoints <= aktueller Breakpoint berücksichtigen */
			if (breakpointIndex <= currentBreakpointIndex && breakpointIndex > bestMatchIndex) {
				bestMatchModifier = modifier;
				bestMatchIndex = breakpointIndex;
			}
		}
	}
	
	/* Beste Übereinstimmung oder Fallback */
	return bestMatchModifier !== null ? bestMatchModifier : fallbackModifier;
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

let resizeTimeout;
const handleResize = () => {
	clearTimeout(resizeTimeout);
	resizeTimeout = setTimeout(() => {
		parallax();
	}, 150);
};

window.addEventListener('scroll', () => {
	parallax();
}, { passive: true });

window.addEventListener('resize', handleResize, { passive: true });

parallax();

export default parallax;