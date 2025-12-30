const smoothScroll = () => {
	const anchors = document.querySelectorAll('a[href^="#"]');
	if (anchors.length === 0) return;

	anchors.forEach(anchor => {
		anchor.addEventListener('click', (e) => {
			e.preventDefault();
		});
	});
};

export default smoothScroll;