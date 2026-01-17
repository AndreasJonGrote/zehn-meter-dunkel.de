<?php include '../library/config.php'; ?>

<!DOCTYPE html>
<html lang="de">
  <head>

    <?php include '../library/head.php'; ?>

    <title>ZEHN METER DUNKEL | Andreas Jon Grote</title>
  </head>
  <body class="bg-light">
      
    <?php include '../library/header.php'; ?>

    <section class="">
      <div class="container-fluid mt-40">
        <div class="grid grid-cols-12 relative">
          <div class="col-span-4 col-start-3 font-medium text-lg font-body">
            <h2 class="text-2xl font-heading uppercase">Kesselbrink I</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center">
          <div class="col-span-10 col-start-4 font-medium text-md font-body">
            <div class="relative aspect-[7/5]">
              <picture class="absolute inset-0">
                <source srcset="<?php the_url() ; ?>/assets/kesselbrink_i-links.webp" type="image/webp">
                <img src="<?php the_url() ; ?>/assets/kesselbrink_i-links.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center">
          <div class="col-span-6 col-start-5 font-medium text-md font-body">
            <p class="text-justify hyphens-auto">
              Eine erhöhte Gesamtansicht ordnet den Platz wie eine horizontale Schnittfläche: 
              vordergründig Strauchwerk und Sitzelemente, mittig Wegeachsen und Spiellandschaft, 
              dahinter Fahrspuren und Parkreihen, ganz hinten ein Häuserband. Die Schwarz‑Weiß‑Setzung 
              entzieht dem Ort seine alltägliche Farbigkeit und reduziert ihn auf Geometrie, Licht 
              und Blickachsen; Personen erscheinen klein und verteilt, nicht als Hauptfiguren, 
              sondern als soziale Markierungen von Aufenthalt, Passage und Nebeneinander. 
              In <span class="italic">Kesselbrink I</span> wird so eine abstrahierte Platzfigur lesbar, 
              in der sich Sichtfelder überlagern und Sicherheit als Verhandlung im öffentlichen Raum 
              sichtbar wird – als Resultat von Sichtbarkeit, Nutzung und gemeinsamen Regeln, 
              nicht allein von Überwachung oder Licht.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center">
          <div class="col-span-10 col-start-1 font-medium text-md font-body">
            <div class="relative aspect-[7/5]">
              <picture class="absolute inset-0">
                <source srcset="<?php the_url() ; ?>/assets/kesselbrink_i-rechts.webp" type="image/webp">
                <img src="<?php the_url() ; ?>/assets/kesselbrink_i-rechts.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center] mt-10">
          <div class="col-span-6 col-start-9 font-medium text-md font-body">
          <p><a href="<?php the_url() ; ?>/ausstellung/ceres-drucker.php" class="text-sm font-heading uppercase text-dark">Ceres-Drucker</a></p>
          <p><a href="<?php the_url() ; ?>/ausstellung/kesselbrink-ii.php" class="text-sm font-heading uppercase text-dark">Kesselbrink II</a></p>
          </div>
        </div>
      </div>
    </section>

    <?php include '../library/footer.php'; ?>

  </body>
</html>