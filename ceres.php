
<!DOCTYPE html>
<html lang="de">
  <head>

    <?php include 'views/head.php'; ?>

    <title>ZEHN METER DUNKEL | Andreas Jon Grote</title>
  </head>
  <body class="bg-light">
      
    <?php include 'views/header.php'; ?>


    <section class="text-light mix-blend-difference">
      <div class="container-fluid mt-40">
        <div class="grid grid-cols-12 relative parallax-item-[0.2]">
          <div class="col-span-4 col-start-3 font-medium text-lg font-body">
            <h2 class="text-2xl font-heading uppercase">CERES CONTENT MARKERS</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="text-grey">
      <div class="container-fluid">
          <div class="grid grid-cols-12 h-full relative items-center">
            <div class="col-span-6 col-start-2">
            
							<p>
							Ceres verbindet soziologische Medienanalyse und künstlerische Praxis: Das Projekt analysiert systematisch Schlagzeilen aus 24 deutschen Großstädten (rund vier Millionen Überschriften) und entwickelt die Ceres Content Markers (CCM) als Werkzeug zur automatisierten Erkennung gewaltbezogener Sprache. Die Analyse zeigt, wie Gewalt im urbanen Raum medial in Szene gesetzt und in zugespitzter Form vermittelt wird – die Wortwahl ist drastisch, die Szenarien wirken alarmierend. Die fotografischen Motive liefern eine visuelle Grammatik; die Schlagzeilen laden diese Motive sprachlich und inhaltlich auf. Die Cultivation Theory (Gerbner) beschreibt das Mean World Syndrome: Wer ständig Gewalt in den Medien sieht, hält die Welt für gefährlicher, als sie ist. Die Analyse deutet in eine ähnliche Richtung: Lokale Nachrichten zeichnen ein Städtebild, in dem vermeintlich an jeder Ecke Gewalt lauern könnte. In der künstlerischen Umsetzung wird die Analyse in ein räumliches Verfahren übersetzt: Ein Thermodrucker druckt in kurzen Intervallen jene Schlagzeilen, die als Meldungen mit intentioneller, ziviler Gewalt markiert wurden. Das Papier wickelt sich aus der Öffnung heraus und legt sich auf den Boden – ein wachsender Rest, der sich wie das Hintergrundrauschen lokaler Nachrichten langsam akkumuliert. Der Drucker fungiert als Akteur im Netzwerk: Er übersetzt die digitale Frequenz der Nachrichten in eine physische Spur, die erst durch ihre Länge und Masse lesbar wird. Die Installation macht den Rhythmus sichtbar – die Dauer, das Wiederkehren, die Gleichgültigkeit der Taktung, in der Gewaltnachrichten erscheinen. So entsteht ein Prozess, der nicht vom einzelnen Ausdruck erzählt, sondern vom Muster seiner Wiederholung. Die Ceres-Analyse bleibt ein offener Prozess zwischen technischer Erprobung und künstlerischer Reflexion, der die Frage stellt, in welchen Geschichten wir leben – und wie sie unsere Vorstellung von Sicherheit, Gefahr und alltäglicher Bewegung im öffentlichen Raum prägen.
							</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script>
	window.addEventListener('load', () => {
		const input = document.getElementById('ccm-search');
		const tokenList = document.querySelector('.ccm-tokens');
		const form = document.querySelector('.ccm-search-form');
		const shuffleButton = form ? form.querySelector('button') : null;
		
		if (!input || !tokenList) return;
		
		let debounceTimer = null;
		
		const currentValue = input.value.trim();
		
		const exampleSentences = [
			currentValue,
			'Polizei ermittelt nach tödlichem Messerangriff in der Innenstadt',
			'Schwer verletzte Person nach Verkehrsunfall ins Krankenhaus gebracht',
			'Demonstration verlief friedlich, keine Zwischenfälle gemeldet',
			'Feuerwehr löscht Brand in Wohnhaus, alle Bewohner unverletzt',
			'Verdächtiger nach Einbruch festgenommen, keine Gewalt angewendet',
			'Körperverletzung im Park: Zeugen alarmierten sofort die Polizei',
			'Explosion in Fabrik: Mehrere Verletzte, Ursache noch unklar',
			'Friedlicher Protest gegen Umweltverschmutzung in der Stadt',
			'Schüsse in Wohngebiet: Polizei sucht nach Täter'
		];
		
		let sentenceIndex = 1;
		
		const getTemplate = () => {
			return tokenList.querySelector('.ccm-template');
		};
		
		const getNccmText = (score) => {
			if (score < 0.30) {
				return 'Eher keine oder sehr schwache Evidenz. Der Wert dient als Band‑Skala zur Orientierung, nicht als binärer Beweis.';
			} else if (score < 0.50) {
				return 'Möglich, oft kontext- oder wortarm. Als Band‑Skala verstanden, dient dieser Wert als robuste Orientierung.';
			} else if (score < 0.65) {
				return 'Deutlich, aber noch fehleranfällig. Kontextdämpfung kann den Score drücken, ohne die Marker‑Evidenz zu verschleiern.';
			} else if (score < 0.80) {
				return 'Starke Gewaltpräsenz. Die Marker‑Evidenz ist deutlich und tragfähig, die Kontextdämpfung wirkt als Relativierung.';
			} else {
				return 'Sehr stark, typisch für „harte" Fälle oder mehrere starke Marker. Die Intensität ist hoch, die Marker‑Evidenz klar und konsistent.';
			}
		};
		
		const getConfidenceText = (score) => {
			if (score < 0.40) {
				return 'Sehr geringe Tragfähigkeit, eher Zufallstreffer oder sehr dünne Evidenz. Das Signal wirkt im kurzen Text nicht stabil.';
			} else if (score < 0.60) {
				return 'Schwach bis mittel, typisch für einzelne Marker, die stark kontextabhängig sind. Die Stabilität im kurzen Text bleibt fragil.';
			} else if (score < 0.75) {
				return 'Solide, aber noch fehleranfällig. Kurztext‑Ambivalenzen sind möglich, die Kontextdämpfung kann noch eine wichtige Rolle spielen.';
			} else if (score < 0.90) {
				return 'Hoch, typisch für mehrere Marker oder eine starke Markerfamilie. Das Signal wirkt im kurzen Text stabil.';
			} else {
				return 'Sehr hoch, typisch für „harte" Fälle mit starker Evidenz und wenig Restzweifel. Das Signal ist klar und konsistent.';
			}
		};
		
		const updateStats = (data) => {
			const nccmScore = data.nccm || data.nCCM || 0;
			const ccmScore = data.ccm || data.CCM || 0;
			const confidenceScore = data.confidence || data.Confidence || 0;
			const ccfTriggered = (data.components && data.components.ccf_triggered === true) || data.ccf_triggered === true;
			
			const nccmElement = document.querySelector('.nccm-score');
			const ccmElement = document.querySelector('.ccm-score');
			const confidenceElement = document.querySelector('.confidence-score');
			const commentElement = document.querySelector('.ccm-comment-text');
			
			const allZero = nccmScore === 0 && ccmScore === 0 && confidenceScore === 0;
			
			if (nccmElement) {
				if (allZero) {
					nccmElement.textContent = '—';
				} else {
					nccmElement.textContent = nccmScore.toFixed(2);
				}
			}
			if (ccmElement) {
				if (allZero) {
					ccmElement.textContent = '—';
				} else {
					ccmElement.textContent = ccmScore.toFixed(2);
				}
			}
			if (confidenceElement) {
				if (allZero) {
					confidenceElement.textContent = '—';
				} else {
					confidenceElement.textContent = confidenceScore.toFixed(2);
				}
			}
			if (commentElement) {
				if (ccfTriggered) {
					commentElement.textContent = 'Ein Kontextfilter (Ausland, Krieg, etc.) hat gegriffen.';
				} else if (allZero) {
					commentElement.textContent = 'Keine Marker gefunden bzw. unauffällig.';
				} else {
					const nccmText = getNccmText(nccmScore);
					const confidenceText = getConfidenceText(confidenceScore);
					commentElement.textContent = `${nccmText} ${confidenceText}`;
				}
			}
		};
		
		const getBorderColor = (marker, score) => {
			if (marker === 'reg') {
				return '#22c55e';
			}
			if (marker === 'ccs') {
				return '#6b7280';
			}
			if (marker === 'ccf') {
				return '#3b82f6';
			}
			if (marker === 'cmm') {
				return '#a855f7';
			}
			if (marker === 'cmr') {
				return '#06b6d4';
			}
			
			const clampedScore = Math.max(0, Math.min(1, score));
			if (clampedScore <= 0.5) {
				const ratio = clampedScore * 2;
				const r = 255;
				const g = Math.round(255 - 90 * ratio);
				const b = 0;
				return `rgb(${r}, ${g}, ${b})`;
			} else {
				const ratio = (clampedScore - 0.5) * 2;
				const r = 255;
				const g = Math.round(165 - 165 * ratio);
				const b = 0;
				return `rgb(${r}, ${g}, ${b})`;
			}
		};
		
		const updateTokens = async () => {
			const api = 'library/ajax.php?analyze=';
			const value = input.value.trim();
			
			if (value.length === 0) {
				const existingItems = tokenList.querySelectorAll('li:not(.ccm-template)');
				existingItems.forEach(item => item.remove());
				tokenList.classList.remove('ccm-loaded');
				updateStats({ nccm: 0, ccm: 0, confidence: 0 });
				return;
			}
			
			try {
				const response = await fetch(`${api}${encodeURIComponent(value)}`);
				const data = await response.json();
				
				updateStats(data);
				
				if (data.sliced && Array.isArray(data.sliced)) {
					if (data.sliced.length > 0) {
						tokenList.classList.add('ccm-loaded');
					} else {
						tokenList.classList.remove('ccm-loaded');
					}
					
					const templateLi = getTemplate();
					if (!templateLi) {
						console.error('Template-Element nicht gefunden');
						return;
					}
					
					const existingItems = tokenList.querySelectorAll('li:not(.ccm-template)');
					existingItems.forEach(item => item.remove());
					
				data.sliced.forEach(item => {
					const li = templateLi.cloneNode(true);
					li.classList.remove('hidden', 'ccm-template');
					
					const marker = item.marker || 'reg';
					const score = item.score || 0;
					const borderColor = getBorderColor(marker, score);
					
					const termSpan = li.querySelector('span:first-child');
					termSpan.className = 'border-b-[4px] whitespace-nowrap text-center';
					termSpan.textContent = item.term || '';
					termSpan.style.borderBottomColor = borderColor;
					
					const metaSpan = li.querySelector('span:last-child');
					const markerSpan = metaSpan.querySelector('span:first-child');
					const scoreSpan = metaSpan.querySelector('span:last-child');
					
					markerSpan.textContent = marker;
					scoreSpan.textContent = score;
					
					tokenList.appendChild(li);
				});
				} else {
					console.error('Kein "sliced" Array in der Antwort gefunden:', data);
					tokenList.classList.remove('ccm-loaded');
				}
			} catch (error) {
				console.error('Fehler beim API-Request:', error);
				tokenList.classList.remove('ccm-loaded');
			}
		};
		
		input.addEventListener('keyup', (e) => {
			if (debounceTimer) {
				clearTimeout(debounceTimer);
			}
			
			const value = input.value.trim();
			if (value.length === 0) {
				const existingItems = tokenList.querySelectorAll('li:not(.ccm-template)');
				existingItems.forEach(item => item.remove());
				tokenList.classList.remove('ccm-loaded');
				updateStats({ nccm: 0, ccm: 0, confidence: 0 });
				return;
			}
			
			if (e.key === ' ' || e.key === 'Spacebar') {
				updateTokens();
			} else {
				debounceTimer = setTimeout(() => {
					updateTokens();
				}, 1000);
			}
		});
		
		if (shuffleButton) {
			shuffleButton.addEventListener('click', () => {
				if (exampleSentences.length > 0) {
					input.value = exampleSentences[sentenceIndex];
					sentenceIndex = (sentenceIndex + 1) % exampleSentences.length;
					updateTokens();
				}
			});
		}
		
		if (input.value.trim().length > 0) {
			updateTokens();
		}
	});
    </script>

    

    <?php include 'views/footer.php'; ?>

  </body>
</html>