/**
 * Startet Videos mit autoplay-Attribut nur wenn sie im Viewport sind
 * Behandelt Browser-spezifische Anforderungen (Safari/iOS)
 */
const startAutoplayVideos = () => {
	const videos = document.querySelectorAll('video[autoplay]');
	if (videos.length === 0) return;
	
	// Intersection Observer für Viewport-Erkennung
	const observerOptions = {
		root: null,
		rootMargin: '0px',
		threshold: 0.5 // Video muss zu 50% sichtbar sein
	};
	
	/**
	 * Versucht Video abzuspielen mit Retry-Logik
	 */
	const attemptPlay = (video, retries = 3, delay = 200) => {
		// Prüfen ob Video geladen ist
		if (video.readyState < 2) {
			video.addEventListener('loadeddata', () => {
				attemptPlay(video, retries, delay);
			}, { once: true });
			return;
		}
		
		const playPromise = video.play();
		
		// Moderne Browser geben Promise zurück
		if (playPromise !== undefined) {
			playPromise
				.then(() => {
					// Erfolgreich gestartet
				})
				.catch((error) => {
					// Retry mit exponentieller Verzögerung
					if (retries > 0) {
						setTimeout(() => {
							attemptPlay(video, retries - 1, delay * 1.5);
						}, delay);
					}
				});
		} else {
			// Fallback für ältere Browser
			try {
				video.play();
			} catch (error) {
				if (retries > 0) {
					setTimeout(() => {
						attemptPlay(video, retries - 1, delay * 1.5);
					}, delay);
				}
			}
		}
	};
	
	/**
	 * Behandelt Viewport-Änderungen
	 */
	const handleIntersection = (entries) => {
		entries.forEach(entry => {
			const video = entry.target;
			
			if (entry.isIntersecting) {
				// Video ist im Viewport - starten
				if (video.paused) {
					attemptPlay(video);
				}
			} else {
				// Video verlässt Viewport - pausieren (optional)
				// Kann entfernt werden wenn Videos weiterlaufen sollen
				// video.pause();
			}
		});
	};
	
	const observer = new IntersectionObserver(handleIntersection, observerOptions);
	
	// Jedes Video vorbereiten und beobachten
	videos.forEach(video => {
		// Safari/iOS: playsinline ist erforderlich für Autoplay
		video.setAttribute('playsinline', '');
		video.setAttribute('webkit-playsinline', '');
		
		// Preload setzen wenn nicht vorhanden
		if (!video.hasAttribute('preload')) {
			video.setAttribute('preload', 'auto');
		}
		
		// Video beobachten
		observer.observe(video);
	});
};

// Initialisierung beim Laden der Seite
if (document.readyState === 'loading') {
	document.addEventListener('DOMContentLoaded', startAutoplayVideos);
} else {
	startAutoplayVideos();
}

export default startAutoplayVideos;
