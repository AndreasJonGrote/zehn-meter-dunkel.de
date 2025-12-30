/**
 * Initialisiert Bildfading für Container mit mehreren Bildern
 */
const initImageFade = () => {
	const DISPLAY_DURATION = 5000;
	
	const containers = Array.from(document.querySelectorAll('.image-fade-container'));
	const containerData = [];
	let lastFadedContainerIndex = -1;
	
	containers.forEach(container => {
		const allPictures = container.querySelectorAll('.image-fade-item');
		if (allPictures.length <= 1) return;
		
		container.style.position = 'relative';
		
		const firstPicture = allPictures[0];
		const firstImg = firstPicture.querySelector('img');
		if (firstImg) {
			firstImg.classList.add('w-full');
		}
		firstPicture.style.opacity = '1';
		
		for (let i = 1; i < allPictures.length; i++) {
			const picture = allPictures[i];
			picture.classList.add('absolute', 'inset-0');
			picture.style.opacity = '0';
			const img = picture.querySelector('img');
			if (img) {
				img.classList.add('w-full', 'h-full', 'object-cover');
			}
		}
		
		containerData.push({
			container,
			pictures: Array.from(allPictures)
		});
	});
	
	if (containerData.length === 0) return;
	
	const getVisibleIndex = (pictures) => {
		for (let i = 0; i < pictures.length; i++) {
			const opacity = parseFloat(pictures[i].style.opacity) || (i === 0 ? 1 : 0);
			if (opacity > 0.5) return i;
		}
		return -1;
	};
	
	const getRandomIndex = (pictures, excludeIndex) => {
		const available = pictures.map((_, i) => i).filter(i => i !== excludeIndex);
		return available.length > 0 
			? available[Math.floor(Math.random() * available.length)]
			: (excludeIndex + 1) % pictures.length;
	};
	
	const fadeContainer = (targetContainer) => {
		const { pictures } = targetContainer;
		const currentIndex = getVisibleIndex(pictures);
		const randomIndex = getRandomIndex(pictures, currentIndex);
		
		if (currentIndex >= 0) {
			pictures[currentIndex].style.opacity = '0';
		}
		pictures[randomIndex].style.opacity = '1';
	};
	
	const fadeNext = () => {
		const available = containerData.filter((_, i) => i !== lastFadedContainerIndex);
		const targetContainer = available.length > 0 
			? available[Math.floor(Math.random() * available.length)]
			: containerData[0];
		
		lastFadedContainerIndex = containerData.findIndex(d => d === targetContainer);
		fadeContainer(targetContainer);
		setTimeout(fadeNext, DISPLAY_DURATION);
	};
	
	const firstTarget = containerData[Math.floor(Math.random() * containerData.length)];
	lastFadedContainerIndex = containerData.findIndex(d => d === firstTarget);
	fadeContainer(firstTarget);
	setTimeout(fadeNext, DISPLAY_DURATION);
};

export default initImageFade;