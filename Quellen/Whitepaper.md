# Whitepaper: Ceres – ein transparenter Algorithmus zur kontextsensitiven Bewertung gewaltbezogener Sprache (nCCM)

**Autor:** Andreas Jon Grote  
**Projekt:** Ceres – Analyse urbaner Sicherheitsdiskurse in deutschsprachigen Lokalzeitungen  
**Institution:** Hochschule Bielefeld (HSBI) – University of Applied Sciences and Arts  
**Datum:** 02. Januar 2026  
**Paper‑Version:** 6.4  
**Algorithmus-/Implementierungsstand (Daten/Code):** 3.0.1

---



---

## 1. Ausgangspunkt und Begriffsrahmen

Schlagzeilen sind kurz, komprimiert und häufig mehrdeutig. Ein einzelnes Wort kann den Eindruck hoher Intensität erzeugen, obwohl der Kontext eine andere Lesart nahelegt. Für eine Korpusanalyse ist deshalb nicht nur wichtig, ob Gewalt vorkommt, sondern wie sprachliche Intensität, Kontext und Berichtsmodus zusammenfallen.

Im Paper bedeutet „zivile/interpersonelle Gewalt“ pragmatisch: Sprache, die Handlungen zwischen Personen oder Gruppen beschreibt (z. B. Angriff, Überfall, Schusswaffe als Tatmittel), in der Regel intentional. „Nicht‑zivile“ bzw. kontextrelativierende Bereiche sind hier nicht „harmlos“, aber methodisch anders gelagert: Unfall, Natur, Technik, Krieg/Terror, Tierangriff oder Nachbericht/Behörden‑Kontext. Diese Unterscheidung ist kein moralisches Urteil, sondern eine methodische Entscheidung, damit eine Korpusanalyse nicht von kontextfremden Gewaltformen dominiert wird.

---

## 2. Leitidee: Modularität als Methode

Viele NLP‑Ansätze versuchen, Ambivalenz in einem Modell zu absorbieren. Für diese Aufgabe ist die Gegenstrategie produktiver: Annahmen werden explizit gemacht, damit sie überprüfbar bleiben. Ceres ist deshalb bewusst modular – nicht um Komplexität zu erhöhen, sondern um sie sichtbar zu halten.

Zwei Konsequenzen sind zentral: Ein Algorithmus darf unvollkommen sein, solange er Grenzfälle sichtbar macht und dadurch korrigierbar bleibt. Korrektur muss lokal möglich sein: Ein Fehlerbild soll in Wörterbuchpflege, Kontextdämpfung oder Policy verortbar sein, statt als undurchsichtiges „Modellverhalten" zu verschwinden. Diese Sichtbarkeit ist keine Schwäche, sondern eine methodische Stärke – sie macht Entscheidungen nachvollziehbar und damit wissenschaftlich haltbar.

---

## 3. Pipeline in Worten

Ein Text wird zunächst in eine robuste Tokenbasis überführt: Bindestrich‑Wörter werden aufgeteilt, Satzzeichen entfernt, Whitespace normalisiert. Dann werden Evidenz und Kontext getrennt erfasst, anschließend werden die Signale in einer konservativen Formel zusammengeführt. Die Reihenfolge ist nicht willkürlich: Erst wird geklärt, ob ein Text überhaupt als Bewertungsobjekt gelten soll, dann wird die Basis stabilisiert, erst danach werden Kontext und Gewalt‑Evidenz gegeneinander gewichtet.

**Pipeline‑Reihenfolge (typografische Darstellung):**

```
Text → CCF (optional) → CCS → CMR → CCM → CMM → Formel (nCCM)
```

Die Pipeline folgt einer klaren Logik. Der Content Filter markiert Texte mit thematischen Tags – beispielsweise „USA", „Ausland" oder „Format" – ohne die Gewaltbewertung zu ändern. Dieses Policy‑Tagging ermöglicht es, Texte später nach Themen zu segmentieren, ohne die eigentliche Gewaltlogik zu beeinflussen. Alternativ kann ein optionales Gate aktiviert werden, das die Bewertung komplett aussetzt – manche Texte werden bewusst segmentiert, statt korrigiert zu werden. Der Filter prüft sowohl Einzelwörter als auch Phrasen aus zwei aufeinanderfolgenden Wörtern. Stopwords stabilisieren die Tokenbasis für Dichtemaße und werden aus der weiteren Analyse ausgeschlossen.

Die Kontextdämpfung relativiert die Gewaltbewertung im Kontext des jeweiligen Textes und wirkt als Dämpfungsfaktor, ohne die Evidenz zu verschleiern. Sie erkennt ebenfalls Einzelwörter und Phrasen; gefundene Kontextdämpfungs‑Tokens werden aus der weiteren Verarbeitung entfernt, damit sie nicht als Marker interpretiert werden. Marker erfassen die Gewalt‑Evidenz als Wörter und Phrasen mit Intensitätswerten – auch hier werden Phrasen bevorzugt, damit Mehrwortausdrücke wie „schwer verletzt" als Einheit erkannt werden. Multipliers verstärken nur bei vorhandener Marker‑Evidenz; fehlt diese Evidenz, reduzieren sie stattdessen die Sicherheit des Algorithmus, um False Positives zu vermeiden. Die Formel führt alles zu einem Score zwischen 0.0 und 1.0 zusammen. Diese Reihenfolge ist methodisch begründet: Sie trennt bewusst zwischen Evidenz und Kontext, damit Fehlerbilder sichtbar bleiben.

---

## 4. Datenbasis: Wörterbücher als Kern der Methode

Wer über Gewaltintensität in Texten spricht, spricht am Ende über Wörter – und über die Ordnung, in die diese Wörter einsortiert werden. In Ceres sind Wörterbücher kein Nebenprodukt, sondern der Kern der Methode: Hier wird festgelegt, welche Oberflächenformen zählen, welche Varianten dazugehören und wie eine Skala in der Praxis von Schlagzeilen tragfähig bleibt.

Die Skala von 0.0 bis 1.0 ist so gedacht, dass Werte monotone Intensität ausdrücken. Entscheidend ist weniger „die perfekte Zahl" als die relative Ordnung und interne Konsistenz. Begriffe treten häufig als Familien auf – „verletzt" und „schwer verletzt" gehören zusammen, müssen aber unterschiedlich gewichtet werden. Wenn solche Familien nicht zusammenpassen, entsteht ein Score, der sich nicht erklären lässt.

Viele entscheidende Signale sind Phrasen: „schwer verletzt", „tödlicher Schuss", „sexueller Übergriff". Deshalb ist Phrasenpflege zentral. Morphologie ist nicht Beiwerk: Ohne Varianten und Flexionsformen entstehen systematische blinde Flecken. Gleichzeitig ist Zurückhaltung wichtig: Nicht alles wird automatisch generiert, sondern nur, was regelhaft sicher ist; Unsicherheit gehört dokumentiert.

Wörterbücher liegen als strukturierte Artefakte mit Metadaten vor. Das ist Forschungsinformation: Eine spätere Analyse ist nur interpretierbar, wenn klar ist, welcher Stand verwendet wurde. Ohne diese Disziplin wird spätere Interpretation unnötig schwer.
---

## 5. Algorithmus: Wie der normierte Score entsteht
## Abstract

Die Erkennung und graduelle Bewertung gewaltbezogener Sprache in kurzen Nachrichtentexten steht vor einem grundlegenden methodischen Konflikt: Kontextambivalenz. Dieselbe Wortform kann Tatbeschreibung, Unfallnachricht, Metapher oder Nachbericht sein. Ceres adressiert dieses Problem durch einen transparenten, modularen Algorithmus, der keine binäre Klassifikation („Gewalt ja/nein") anstrebt, sondern eine normalisierte Intensität (nCCM, 0.0–1.0) aus wenigen, interpretierbaren Teilkomponenten bildet.

Kern der Methode ist eine bewusste Trennung von Gewalt‑Evidenz (CCM), Kontextdämpfung (CMR), optionalen Policy‑Filtern (CCF) und stabilisierenden Vorverarbeitungsschritten (CCS). Diese Modularität macht Fehlerbilder sichtbar und ermöglicht lokale Korrekturen, statt Fehler als undurchsichtiges „Modellverhalten" zu verschleiern. Die Kontextdämpfung wirkt dabei als Relativierung: Sie relativiert die Gewaltbewertung im Kontext des jeweiligen Textes, ohne die Evidenz zu verschleiern.

Erfahrungen aus LLM‑gestützten Anlern‑ und Extraktionsläufen zeigen, dass reine Modelloutputs im konkreten Task häufig an Kontextsensitivität scheitern: Plausible Vorschläge entstehen, aber Unfall‑, Institutions‑ und Kriegskontexte werden verwechselt und False Positives begünstigt. Der modulare Ansatz dient deshalb auch als Prüfrahmen für solche Vorschläge. Verbreitete Transformer‑Klassifikatoren wie BERT oder RoBERTa, die primär für Polarisierung oder Sentiment optimiert sind, greifen hier zu kurz: Entscheidend ist nicht Valenz, sondern zivile/interpersonelle Gewalt‑Evidenz und deren Gewichtung unter Kontextdämpfung.

Die Methode basiert auf Wörterbüchern als Kernkomponente, nicht auf trainierten Modellen. Phrasen, Varianten und Morphologie werden explizit gepflegt, Skalen bleiben intern konsistent. Die Formel kombiniert drei Perspektiven: die Sicherheit des Algorithmus in seiner Bewertung, die Schwere der vorliegenden Marker in ihrer Gewaltaussage und die lexikalische Dichte an Gewaltmarkern im Text. Die Kontextdämpfung wirkt als konservativer Faktor, der typische False Positives reduziert, ohne Marker zu verschleiern.

Ceres nähert sich dem Problem durch explizite Annahmen und Modularität – nicht nur als technische Qualitäten, sondern als methodische Notwendigkeiten für kontextsensitive Aufgaben. Das Whitepaper diskutiert Grenzfälle, Verzerrungen und praktische Schwellen – nicht als Defizite, sondern als sichtbare Entscheidungspunkte, die eine Korpusanalyse interpretierbar machen.
Die Formel ist kein „magischer Endpunkt“, sondern der Ort, an dem Annahmen explizit werden: Welche Signale zählen, wie werden sie gewichtet, und wie stark darf Kontext dämpfen. Eine gute Formel ist hier eine, die Grenzfälle nicht versteckt, sondern sichtbar macht.

Die Formel kombiniert drei Perspektiven: die Sicherheit des Algorithmus in seiner Bewertung, die Schwere der vorliegenden Marker in ihrer Gewaltaussage und die lexikalische Dichte an Gewaltmarkern im Text. Die Gewichtung ist konservativ: Die Sicherheit des Algorithmus ist Leitgröße, weil sie in kurzen Texten am besten abbildet, ob überhaupt ausreichend Evidenz vorliegt. Dichtemaße bleiben wichtig, sollen aber nicht allein dominieren.

Die Sicherheit des Algorithmus folgt einer Stufenlogik: Bei keinem gefundenen Marker ist sie null, bei einem Marker liegt sie zwischen 0.5 und 1.0 abhängig von der Marker‑Schwere, bei zwei oder mehr Markern steigt sie deutlich an. Zusätzlich wird sie durch die lexikalische Dichte verstärkt – je mehr Marker im Verhältnis zur Textlänge, desto höher die Sicherheit. Die Kontextdämpfung wirkt dann als Dämpfungsfaktor auf diese Sicherheit, wobei starke Kontexte eine Obergrenze erzwingen können, damit fatale Ereignisse nicht zu stark relativiert werden.

Die beiden Dichtemaße werden separat berechnet: Die durchschnittliche Marker‑Schwere ergibt sich aus der Summe aller Marker‑Werte geteilt durch die Anzahl der Marker, die lexikalische Dichte aus der Anzahl der Marker geteilt durch die Anzahl der relevanten Textwörter. Beide Werte werden auf maximal 1.0 begrenzt, damit einzelne extreme Fälle die Gesamtbewertung nicht dominieren.

Der finale normierte Score entsteht als gewichtete Summe: Die Sicherheit des Algorithmus wird mit 0.60 gewichtet, die durchschnittliche Marker‑Schwere mit 0.25 und die lexikalische Dichte mit 0.15. Diese Gewichtung bevorzugt bewusst die Sicherheit, weil sie am besten abbildet, ob überhaupt ausreichend Evidenz vorliegt, während die Dichtemaße wichtige Nuancen liefern, aber nicht allein dominieren sollen.

Die Kontextdämpfung wirkt als Relativierung der Gewaltbewertung im Kontext des jeweiligen Textes. Sie reduziert typische False Positives – Unfälle, technische Störungen, Naturereignisse – indem sie als Dämpfungsfaktor auf die Interpretation wirkt. Entscheidend ist die Grundidee: Marker werden nicht „weggezaubert", aber die Interpretation wird relativiert und gedämpft, wenn der Kontext stark gegen zivile/interpersonelle Gewalt spricht.

Policy‑Kanten sind der zweite Weg: Manche Texte werden nicht „korrigiert", sondern bewusst segmentiert oder ausgeschlossen. Das ist methodisch oft sauberer, als heterogene Themen über denselben Score zu erzwingen. Ein Endscore allein ist für Pflege und Tuning zu grob. Deshalb existiert eine erweiterte Ausgabe, die nachvollziehbar macht, welche Wörter erfasst wurden und welche Zwischenwerte in die Berechnung eingingen.

Ein Score ist nur dann hilfreich, wenn er auch lesbar ist. Statt den normierten Wert wie eine binäre Entscheidung zu behandeln, ist es für die Praxis sinnvoll, ihn als Band‑Skala zu interpretieren: nicht als „Beweis", sondern als robuste Orientierung. Das gilt unter der Bedingung, dass kein Policy‑Gate greift und Marker‑Evidenz vorliegt.

**Praktische Bänder für den normierten Wert (Orientierung):**

- < 0.30: eher keine / sehr schwache Evidenz
- 0.30–0.50: möglich, oft kontext- oder wortarm
- 0.50–0.65: deutlich, aber noch fehleranfällig (Kontextdämpfung kann drücken)
- 0.65–0.80: stark
- ≥ 0.80: sehr stark (typisch „harte" Fälle oder mehrere starke Marker)

Während der normierte Wert die Intensität in einer Gesamtsicht bündelt, beschreibt die Sicherheit des Algorithmus vor allem die Tragfähigkeit der Evidenz: Wie „stabil" wirkt das Signal im kurzen Text, und wie stark drückt die Kontextdämpfung auf diese Einschätzung. Auch hier ist eine Band‑Lesung hilfreicher als eine einzelne „magische Zahl".

**Lesung der Sicherheit des Algorithmus (praktische Bänder, Heuristik):**

- < 0.40: sehr geringe Tragfähigkeit / eher Zufallstreffer oder sehr dünne Evidenz
- 0.40–0.60: schwach bis mittel (einzelne Marker, stark kontextabhängig)
- 0.60–0.75: solide, aber noch fehleranfällig (Kurztext‑Ambivalenzen möglich)
- 0.75–0.90: hoch (typisch mehrere Marker oder starke Markerfamilie)
- ≥ 0.90: sehr hoch (typisch „harte" Fälle; starke Evidenz, wenig Restzweifel im System)

**Lesung des CCM‑Summenscore (rohe Evidenz vs. normierter Score):**

Weil der normierte Wert mehrere Teilperspektiven zusammenführt und konservative Korrekturen enthält, kann er Einzelfälle bewusst „glätten". Für Diagnose und Pflege ist deshalb die rohe Evidenzsumme wichtig: Der **CCM‑Summenscore (`ccm`)** macht sichtbar, wie viel Marker‑Evidenz im Text steckt, bevor Kontext und Normierung den Endwert formen. Als pragmatische Arbeitslesung gilt: **`ccm > 1.5`** ist häufig deutlich aussagekräftiger (typisch mehrere Marker oder starke Häufung). Methodisch sinnvoll ist es, das immer gegen **CMR** zu lesen (z. B. Marker‑Evidenz vs. Kontextdämpfung), statt nur eine Zahl isoliert zu interpretieren.
---

## 6. „Anlernen“ in der Praxis: warum Modelle allein nicht reichen

„Anlernen“ bedeutet hier nicht klassisches Modelltraining, sondern ein iteratives Zusammenspiel aus Kandidatengewinnung, Nachfilter, Abgleich, QA und skalenlogischer Einordnung. LLM‑gestützte Extraktionsläufe (z. B. über LM Studio) sind nützlich, weil sie plausible Kandidaten vorschlagen. Gleichzeitig zeigt sich im konkreten Task eine typische Schwäche: Reine Modelloutputs verwechseln häufig Zielkategorie und Kontext (Unfall/Institution/Krieg) und begünstigen dadurch False Positives.

Ein extremes Beispiel illustriert das Problem: Ein wissenschaftlicher Methodentext, der nicht um Verbrechen ging, aber das Wort „Vergewaltigung" im Kontext eines Rechtstextes enthielt, konnte von ChatGPT nicht analysiert werden – das Modell verweigerte die Bearbeitung trotz eindeutigem wissenschaftlichen Kontext. Dies zeigt, wie stark kontextsensitive Aufgaben an binären Filtermechanismen scheitern können, wenn keine explizite Trennung zwischen Evidenz und Kontext existiert.

Der Punkt ist nicht „Modell schlecht", sondern: Der Task ist kontextsensitiv und policy‑geladen. Ohne explizite Trennung (Marker vs. Kontextdämpfung vs. Policy) werden Vorschläge schwer wartbar. Deshalb bleibt der Prozess bewusst zweistufig: Modelle dürfen vorschlagen, die Übernahme in operative Wörterbücher erfolgt erst nach Prüfung.

---

## 7. Beispiele

Die folgenden Beispiele zeigen, welche Module typischerweise greifen und welche Interpretation daraus folgt. Für eine wissenschaftliche Lesart ist hier wichtiger, dass die Zusammenhänge klar werden, als dass technische Details im Vordergrund stehen.

Ein typischer Unfallkontext: „Mehr als zehn Kinder verletzt bei Busunfall". Das Wort „verletzt" wird als Marker erkannt, aber der Kontext „Busunfall" dämpft die Bewertung. Die Marker‑Evidenz bleibt sichtbar, der normierte Score wird konservativ gedämpft – die Methode verschleiert nicht, dass Verletzungen vorliegen, relativiert aber ihre Interpretation im Unfallkontext.

Ein Gewaltkontext trotz Nachbericht‑Sprache: „Prozess nach tödlichen Schüssen: Polizei ermittelt". Die Marker „tödlich" und „Schüsse" sind stark, der Kontext „Prozess" und „Polizei" signalisiert Nachbericht. Die starke Marker‑Evidenz bleibt tragfähig; der Nachbericht wird sichtbar, aber kippt die Bewertung nicht automatisch – die Methode trennt bewusst zwischen Evidenz und Kontext.

Ein Policy‑Beispiel: „USA: Tödliche Schüsse in New York – Polizei ermittelt". Die Marker „tödlich" und „Schüsse" sind vorhanden, aber das Policy‑Signal „USA" kann je nach Analyseziel entweder als Tagging verwendet werden oder ein Gate auslösen, das die Bewertung komplett aussetzt. Die Trennung wird explizit – bewerten versus segmentieren – die Entscheidung ist nicht im Score versteckt.

---

## 8. Kritische Punkte: Grenzen, Verzerrungen, heikle Bereiche

Dieses Kapitel bündelt Bereiche, in denen Verzerrungen besonders leicht entstehen. Es geht weniger um Einzelfälle als um wiederkehrende Zusammenhänge.

Viele Probleme wirken wie „falsche Bedeutung". Häufig sind es strukturelle Kleinigkeiten mit großen Folgen: fehlende Varianten, nicht normalisierte Phrasen, überlappende Kategorien. Deshalb ist Pflege nicht nur Ergänzen, sondern auch Aufräumen. Ein Fehler, der strukturell bedingt ist, kann systematisch durch viele Texte laufen, bevor er auffällt.

Sexualdelikte sind besonders heikel: starke Tabuwörter, rechtlich sehr unterschiedliche Delikte, journalistische Verdachtsformeln und die Tendenz zu sensationalistischen Kurzformen wie „Sex‑Attacke". Ein Wörterbuchsystem ist hier schnell „zu laut". Drei typische Risiken treten auf: Verdachtssprache versus Tatbeschreibung – Wörter wie „mutmaßlich", „Verdacht", „Vorwurf" oder „soll" signalisieren Berichtsmodus, nicht Tatbeschreibung. Kontextmarker wie „sexuell" versus Deliktmarker wie „Vergewaltigung" – Themenbezug ist nicht automatisch Intensität. Die Heterogenität der Delikte reicht von Belästigung über Nötigung, Übergriff, Missbrauch, Vergewaltigung bis zu kinderpornografischem Material – sie alle gleich zu behandeln wäre methodisch falsch.

Ein journalistisch typischer Mini‑Fall ist die Verdachtsformel „Mutmaßlicher sexueller Übergriff – Polizei ermittelt“. Wenn Verdachtssprache und Tatbeschreibung gleich behandelt werden, steigt Intensität systematisch bei Texten, die primär Berichtsmodus sind. Die konservative Einordnung einzelner Wörter – „sexuell" als Kontextmarker versus „Vergewaltigung" als Deliktmarker – ist deshalb Qualitätssicherung, nicht moralisches Urteil.

Auch scheinbar administrative Themen wie Versionsstände sind Forschungsinformation: Ohne klaren Stand wird spätere Interpretation unnötig schwer. Diese Disziplin mag banal erscheinen, aber sie ist Voraussetzung für wissenschaftliche Nachvollziehbarkeit.
---

## 9. Anwendungsrahmen

Der Algorithmus ist für Korpusanalysen gedacht, in denen Nachvollziehbarkeit, Segmentierbarkeit und Wartbarkeit wichtiger sind als eine einmalige „Bestleistung" auf einem Benchmark. Typische Nutzungen sind der Vergleich von Themen und Zeiträumen über stabile Wörterbuchstände, die Segmentierung über Policy‑Filter statt impliziter Score‑Manipulation und die Kontextkorrektur, um Unfall- und Technik‑Sprache nicht als zivile Gewalt zu überbewerten. Der Wert liegt nicht in einer perfekten Einzelfallbewertung, sondern in der konsistenten, interpretierbaren Analyse großer Textkorpora.

---

## 10. Optionale Materialien (Randnotiz)

Die folgenden Materialien sind nicht erforderlich, um dieses Paper zu verstehen. Sie dienen als Vertiefung und Arbeitsstand:

- `Logbuch.md` (Historie/Entscheidungen/Tuning‑Notizen)
- `formular_output.md` (zusätzliche Test-/Debug‑Snapshots)
- `Modul Report *.md` (Detaildokumentation pro Modul)
- `logs/`, `learning-datasets/`, `Validierungsplan.md`, `Probleme und Lösungen.md` (Arbeits- und Validierungsartefakte)
