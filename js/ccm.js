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
  
  const generateCommentText = (nccmScore, ccmScore, confidenceScore, slicedData) => {
    // Marker prüfen
    let hasCmr = false;
    let hasCcf = false;
    let hasCmm = false;
    let hasCcs = false;
    
    if (slicedData && Array.isArray(slicedData) && slicedData.length > 0) {
      hasCmr = slicedData.some(item => (item.marker || 'reg') === 'cmr');
      hasCcf = slicedData.some(item => (item.marker || 'reg') === 'ccf');
      hasCmm = slicedData.some(item => (item.marker || 'reg') === 'cmm');
      hasCcs = slicedData.some(item => (item.marker || 'reg') === 'ccs');
    }
    
    const hasMultipleMarkers = ccmScore > 1;
    const isSecuredViolence = nccmScore > 1.75 && !hasCmr;
    
    let mainSentence = '';
    let additionalInfo = '';
    let confidenceNote = '';
    
    // Hauptsatz: Gewaltbewertung
    if (isSecuredViolence) {
      if (hasMultipleMarkers) {
        mainSentence = 'Mehrere Marker deuten auf vermutlich gesicherte Gewalt hin';
      } else {
        mainSentence = 'Die Gewaltpräsenz ist vermutlich gesichert';
      }
    } else if (nccmScore > 1.0) {
      if (hasMultipleMarkers) {
        mainSentence = 'Mehrere Marker deuten auf eine deutliche Gewaltpräsenz hin';
      } else {
        mainSentence = 'Die Gewaltpräsenz ist deutlich';
      }
    } else if (nccmScore > 0.8) {
      if (hasMultipleMarkers) {
        mainSentence = 'Mehrere Marker weisen auf eine starke Gewaltpräsenz hin';
      } else {
        mainSentence = 'Eine starke Gewaltpräsenz ist erkennbar';
      }
    } else if (nccmScore > 0.5) {
      if (hasMultipleMarkers) {
        mainSentence = 'Mehrere Marker deuten auf eine mögliche Gewaltpräsenz hin';
      } else {
        mainSentence = 'Eine mögliche Gewaltpräsenz ist erkennbar';
      }
    } else if (nccmScore > 0.3) {
      mainSentence = 'Schwache Anzeichen für Gewaltpräsenz';
    } else if (nccmScore > 0) {
      mainSentence = 'Sehr schwache Anzeichen für Gewaltpräsenz';
    } else if (hasCmr && ccmScore === 0) {
      mainSentence = 'Der Text ist unauffällig, verfügt aber über einen dämpfenden Marker';
    } else {
      mainSentence = 'Keine Gewaltpräsenz erkennbar';
    }
    
    // Zusatzinformationen in den Hauptsatz integrieren
    if (hasCmr && nccmScore > 0) {
      if (nccmScore > 1.75) {
        mainSentence += ', jedoch ist ein dämpfender Marker vorhanden, sodass die Bewertung im Einzelfall geklärt werden muss';
      } else {
        mainSentence += ', wobei ein dämpfender Marker vorhanden ist, der eine Einzelfallprüfung erfordert';
      }
    } else if (hasCmr && nccmScore === 0) {
      // Bereits oben behandelt
    }
    
    // Confidence nur erwähnen, wenn sie niedrig ist (als Warnung)
    // Bei niedrigem CCM (< 0.7) ist auch hohe Confidence nicht "zuverlässig"
    const isLowCcm = ccmScore < 0.7;
    if (confidenceScore < 0.5 && mainSentence.length > 0) {
      mainSentence += ', wobei die Bewertung mit Vorsicht zu interpretieren ist';
    } else if (confidenceScore < 0.5) {
      mainSentence = 'Die Bewertung ist mit Vorsicht zu interpretieren';
    } else if (isLowCcm && confidenceScore < 0.7 && mainSentence.length > 0) {
      mainSentence += ', wobei die Bewertung mit Vorsicht zu interpretieren ist';
    }
    
    // CCF als separater Satz oder integriert
    if (hasCcf) {
      if (mainSentence.length > 0) {
        additionalInfo = 'Ein Kontextfilter weist darauf hin, dass der Text von zivilen Kontexten oder Deutschland abweicht.';
    } else {
        mainSentence = 'Ein Kontextfilter weist darauf hin, dass der Text von zivilen Kontexten oder Deutschland abweicht';
      }
    }
    
    // Sätze kombinieren
    const sentences = [];
    if (mainSentence) {
      sentences.push(mainSentence + '.');
    }
    if (additionalInfo) {
      sentences.push(additionalInfo);
    }
    
    return sentences.slice(0, 3).join(' ');
  };
  
  const updateStats = (data, slicedData = null) => {
    const nccmScore = data.nccm || data.nCCM || 0;
    const ccmScore = data.ccm || data.CCM || 0;
    const confidenceScore = data.confidence || data.Confidence || 0;
    const ccfTriggered = (data.components && data.components.ccf_triggered === true) || data.ccf_triggered === true;
    
    let hasMarkerFamily = false;
    let hasCmrWithoutCcm = false;
    if (slicedData && Array.isArray(slicedData) && slicedData.length > 0) {
      const uniqueMarkers = new Set(slicedData.map(item => item.marker || 'reg').filter(m => m !== 'reg'));
      hasMarkerFamily = uniqueMarkers.size > 0;
      
      const hasCmr = slicedData.some(item => (item.marker || 'reg') === 'cmr');
      hasCmrWithoutCcm = hasCmr && ccmScore === 0;
    }
    
    const nccmElement = document.querySelector('.nccm-score');
    const ccmElement = document.querySelector('.ccm-score');
    const confidenceElement = document.querySelector('.confidence-score');
    const commentElement = document.querySelector('.ccm-comment-text');
    
    const allZero = nccmScore === 0 && ccmScore === 0 && confidenceScore === 0;
    
    const statsWrapper = document.querySelector('.ccm-stats-wrapper');
    const statsContainer = statsWrapper ? statsWrapper.parentElement : null;
    const commentContainer = document.querySelector('.ccm-commment');
    
    if (statsContainer) {
      const isCurrentlyClosed = statsContainer.classList.contains('h-0');
      
      if (isCurrentlyClosed) {
        // Container ist geschlossen, also aufklappen
        statsContainer.classList.remove('h-0');
        statsContainer.style.height = 'auto';
        // Mit requestAnimationFrame die tatsächliche Höhe des gesamten Containers messen
        requestAnimationFrame(() => {
          const height = statsContainer.scrollHeight;
          // Höhe auf 0 setzen, damit wir von 0 animieren können
          statsContainer.style.height = '0px';
          // Dann auf die gemessene Höhe animieren
          requestAnimationFrame(() => {
            statsContainer.style.height = `${height}px`;
          });
        });
      } else {
        // Container ist bereits offen, nur Höhe aktualisieren ohne Animation
        statsContainer.style.height = 'auto';
        requestAnimationFrame(() => {
          const height = statsContainer.scrollHeight;
          statsContainer.style.height = `${height}px`;
        });
      }
    }
    if (commentContainer) {
      commentContainer.classList.remove('hidden');
    }
    
    if (nccmElement) {
      if (allZero) {
        nccmElement.textContent = '0';
      } else {
        nccmElement.textContent = nccmScore.toFixed(2);
      }
    }
    if (ccmElement) {
      if (allZero) {
        ccmElement.textContent = '0';
      } else {
        ccmElement.textContent = ccmScore.toFixed(2);
      }
    }
    if (confidenceElement) {
      if (allZero) {
        confidenceElement.textContent = '0';
      } else {
        confidenceElement.textContent = confidenceScore.toFixed(2);
      }
    }
    if (commentElement) {
      if (ccfTriggered) {
        commentElement.textContent = 'Ein Kontextfilter (Ausland, Krieg, etc.) hat gegriffen.';
      } else if (allZero) {
        // Prüfen ob CMR vorhanden ist, auch wenn alle Scores 0 sind
        const hasCmr = slicedData && Array.isArray(slicedData) && slicedData.some(item => (item.marker || 'reg') === 'cmr');
        if (hasCmr) {
          commentElement.textContent = 'Der Text ist unauffällig, verfügt aber über einen dämpfenden Marker.';
        } else {
        commentElement.textContent = 'Keine Marker gefunden bzw. unauffällig.';
        }
      } else {
        commentElement.textContent = generateCommentText(nccmScore, ccmScore, confidenceScore, slicedData);
      }
    }
  };
  
  const getMarkerTooltip = (marker) => {
    const tooltips = {
      'reg': 'Kein Marker erkannt',
      'ccm': 'Gewaltmarker',
      'ccs': 'Stopwort',
      'ccf': 'Kontextfilter',
      'cmm': 'Verstärkungsfaktor',
      'cmr': 'Dämpfungsfaktor'
    };
    return tooltips[marker] || 'Unbekannter Marker';
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
      
      const statsWrapper = document.querySelector('.ccm-stats-wrapper');
      const statsContainer = statsWrapper ? statsWrapper.parentElement : null;
      const commentContainer = document.querySelector('.ccm-commment');
      if (statsContainer) {
        // Aktuelle Höhe des gesamten Containers messen
        const currentHeight = statsContainer.scrollHeight;
        statsContainer.style.height = `${currentHeight}px`;
        // Mit requestAnimationFrame sicherstellen, dass die Höhe gesetzt ist, bevor wir animieren
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            statsContainer.style.height = '0px';
            // Nach der Animation h-0 hinzufügen
            setTimeout(() => {
              statsContainer.classList.add('h-0');
            }, 1000); // Dauer der Transition
          });
        });
      }
      if (commentContainer) {
        commentContainer.classList.add('hidden');
      }
      
      return;
    }
    
    try {
      const response = await fetch(`${api}${encodeURIComponent(value)}`);
      const data = await response.json();
      
      if (data.sliced && Array.isArray(data.sliced)) {
        updateStats(data, data.sliced);
      } else {
        updateStats(data);
      }
      
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
        li.classList.add('inline-flex');
        
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
        markerSpan.setAttribute('data-tooltip', getMarkerTooltip(marker));
        markerSpan.classList.add('cursor-help', 'relative', 'group');
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
      
      const statsWrapper = document.querySelector('.ccm-stats-wrapper');
      const statsContainer = statsWrapper ? statsWrapper.parentElement : null;
      const commentContainer = document.querySelector('.ccm-commment');
      if (statsContainer) {
        // Aktuelle Höhe des gesamten Containers messen
        const currentHeight = statsContainer.scrollHeight;
        statsContainer.style.height = `${currentHeight}px`;
        // Mit requestAnimationFrame sicherstellen, dass die Höhe gesetzt ist, bevor wir animieren
        requestAnimationFrame(() => {
          requestAnimationFrame(() => {
            statsContainer.style.height = '0px';
            // Nach der Animation h-0 hinzufügen
            setTimeout(() => {
              statsContainer.classList.add('h-0');
            }, 1000); // Dauer der Transition
          });
        });
      }
      if (commentContainer) {
        commentContainer.classList.add('hidden');
      }
      
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
        sentenceIndex = sentenceIndex + 1;
        if (sentenceIndex >= exampleSentences.length) {
          sentenceIndex = 1; // Von vorne beginnen, aber Index 0 überspringen (leerer Wert)
        }
        updateTokens();
      }
    });
  }
  
  input.value = '';
});