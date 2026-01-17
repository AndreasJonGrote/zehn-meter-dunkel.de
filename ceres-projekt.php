<?php include 'library/config.php'; ?>

<!DOCTYPE html>
<html lang="de">
  <head>

    <?php include 'library/head.php'; ?>

    <title>ZEHN METER DUNKEL | Andreas Jon Grote</title>
  </head>
  <body class="bg-light">
      
    <?php include 'library/header.php'; ?>


    <section class="">
      <div class="container-fluid mt-40">
        <div class="grid grid-cols-12 relative">
          <div class="col-span-4 col-start-3 font-medium text-lg">
            <h2 class="text-2xl font-heading uppercase">CERES</h2>
          </div>
        </div>
      </div>
    </section>

		<section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 relative">
          <div class="col-span-6 col-start-7 font-medium text-md">
            <h3 class="text-md font-heading uppercase mb-3">Datensammlung</h3>
              <p>
                Ceres verbindet soziologische Medienanalyse und künstlerische Praxis: Das Projekt analysiert systematisch Schlagzeilen aus 24 deutschen Großstädten (rund vier Millionen Überschriften) und entwickelt die Ceres Content Markers (CCM) als Werkzeug zur automatisierten Erkennung gewaltbezogener Sprache. 
                Die Analyse zeigt, wie Gewalt im urbanen Raum medial in Szene gesetzt und in zugespitzter Form vermittelt wird – die Wortwahl ist drastisch, die Szenarien wirken alarmierend. Die fotografischen Motive liefern eine visuelle Grammatik; die Schlagzeilen laden diese Motive sprachlich und inhaltlich auf. 
              </p>
              <p class="indent-5">
                Die Cultivation Theory (Gerbner) beschreibt das Mean World Syndrome: Wer ständig Gewalt in den Medien sieht, hält die Welt für gefährlicher, als sie ist. 
                Die Analyse deutet in eine ähnliche Richtung: Lokale Nachrichten zeichnen ein Städtebild, in dem vermeintlich an jeder Ecke Gewalt lauern könnte. 
              </p>
          </div>
        </div>
        
      </div>
    </section>

    <section class="absolute top-[45%] left-12 w-[35%] max-w-[400px]">
      <div class="container-fluid sm:p-0">
        <?php include 'views/ceres-stats.php'; ?>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 relative">
          <div class="col-span-6 col-start-2 font-medium text-md">
            <h3 class="text-md font-heading uppercase mb-3">Ceres Content Markers</h3>
            <p>
              Für die Bewertung der sprachlichen Intensität gewaltbezogener Sprache wurde im Rahmen von Ceres der kontextsensitiver Gewaltbewertungs‑Algorithmus, die <em class="font-italic">Ceres Content Markers</em>, entwickelt. Dieser modulare Algorithmus bewertet Schlagzeilen auf einer Skala von 0.0 bis 1.0, wobei höhere Werte eine stärkere Gewaltintensität anzeigen. Kern der Methode ist eine bewusste Trennung von Gewalt‑Evidenz (Marker), Kontextdämpfung (CMR) und optionalen Policy‑Filtern (CCF). Diese Modularität macht Fehlerbilder sichtbar und ermöglicht lokale Korrekturen – beispielsweise wird das Wort „verletzt" in einem Unfallkontext anders gewichtet als in einem Gewaltkontext, um False Positives zu vermeiden. Der Algorithmus basiert auf explizit gepflegten Wörterbüchern (nicht auf trainierten Modellen) und kombiniert drei Perspektiven: die Sicherheit des Algorithmus, die Schwere der Marker und die lexikalische Dichte. Für das Gesamtprojekt Ceres ist nCCM ein zentrales Werkzeug, um die Intensität der Gewaltdarstellung über Zeit und über verschiedene Zeitungen hinweg zu vergleichen.
            </p>
          </div>
          <div class="col-span-3 col-start-9">
            <?php include 'views/ceres-content-marker-stats.php'; ?>
          </div>
        </div>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
          
          <div class="grid grid-cols-12 h-full relative items-center">
            <div class="col-span-6 col-start-6">
              <h3 class="text-md font-heading uppercase mb-3">Algorithmus testen</h3>
              <p class="text-md text-justify hyphens-auto mb-5">
                Probiere den Ceres Content Marker aus: Lade mit dem Shuffle-Button zufällige Beispiele aus der Datenbank oder gib einen eigenen Text ein. Die Analyse zeigt dir, wie der Algorithmus die Gewaltintensität bewertet und welche Marker erkannt werden.
              </p>
              <?php include 'views/ceres-example.php'; ?>
            </div>
          </div>
        </div>
      </div>
    </section>  

    <section class="bg-light">
      <div class="container-fluid">
        <div class="grid grid-cols-12 relative z-10 mix-blend-difference text-light">
          <div class="col-span-8 col-start-2 font-medium text-md">
            <h3 class="text-md font-heading uppercase mb-3">Künstlerische Interpretation</h3>
            <p>
              In der künstlerischen Umsetzung wird die Analyse in ein räumliches Verfahren übersetzt: Ein Thermodrucker druckt in kurzen Intervallen jene Schlagzeilen, die als Meldungen mit intentioneller, ziviler Gewalt markiert wurden. 
              Das Papier wickelt sich aus der Öffnung heraus und legt sich auf den Boden – ein wachsender Rest, der sich wie das Hintergrundrauschen lokaler Nachrichten langsam akkumuliert. 
              Der Drucker fungiert als Akteur im Netzwerk: Er übersetzt die digitale Frequenz der Nachrichten in eine physische Spur, die erst durch ihre Länge und Masse lesbar wird. 
              Die Installation macht den Rhythmus sichtbar – die Dauer, das Wiederkehren, die Gleichgültigkeit der Taktung, in der Gewaltnachrichten erscheinen. So entsteht ein Prozess, der nicht vom einzelnen Ausdruck erzählt, sondern vom Muster seiner Wiederholung. 
              </p>
            <p class="indent-5">
              Die Ceres-Analyse bleibt ein offener Prozess zwischen technischer Erprobung und künstlerischer Reflexion, der die Frage stellt, in welchen Geschichten wir leben – und wie sie unsere Vorstellung von Sicherheit, Gefahr und alltäglicher Bewegung im öffentlichen Raum prägen.
						</p>

          </div>
        </div>

        <div class="grid grid-cols-12 gap-5">
          <!-- Ceres -->
          <div class="relative group col-span-3 col-start-9 cursor-pointer work-item parallax-item-[-0.05] z-0">
            <div class="relative aspect-[3/4]">
              <picture class="absolute inset-0">
                <source srcset="assets/ceres.webp" type="image/webp">
                <img src="assets/ceres.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
            </div>
            <h2 class="text-sm font-heading uppercase mt-3">Ceres-Drucker</h2>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Ceres -->
        </div>
      </div>
    </section>


    <?php include 'library/footer.php'; ?>

	<script src="js/ccm.js"></script>

  </body>
</html>