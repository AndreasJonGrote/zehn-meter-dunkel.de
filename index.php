<?php

  $works = [

    'exhibition' => [
      [
        'title' => 'Das Rauschen des Moments',
        'description' => 'Über Wahrnehmung und Verhaltensweisen, die sich zu einem dynamischen Netzwerk urbaner Sicherheit verdichten.',
        'media' => [
          'type' => 'video',
          'src' => 'assets/das-rauschen-des-moments-10s-small.mp4',
          'poster' => 'assets/das-rauschen-des-moments-10s-small.jpg'
        ],
        'link' => '#'
      ],
      [
        'title' => 'Lesung urbaner Unsicherheiten',
        'description' => 'Umfrageergebnisse zu Angsträumen, Wegen, Erfahrungen und dem subjektiven Sicherheitsempfinden.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#'
      ],
      [
        'title' => 'Atlas der (UN-)sicherheit',
        'description' => 'Fotografische Untersuchungen von Übergängen, Sichtbarkeit, räumlichen Spannungen und Lesbarkeit.',
        'media' => [
          'type' => 'image',
          'srcset' => [
            'assets/heimweg-07-600x0-c-default.webp',
            'assets/heimweg-04-600x0-c-default.webp',
            'assets/heimweg-02-600x0-c-default.webp',
            'assets/heimweg-01-600x0-c-default.webp'
          ]
        ],
        'link' => '#'
      ],
      [
        'title' => 'Ceres',
        'description' => 'Analyse der medialen Dramaturgien, in denen Gewalt zwischen Information und Inszenierung verhandelt wird.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#'
      ],
      [
        'title' => 'Ich habe kein Gesicht',
        'description' => 'Videografische Erkundung von Beobachtung, Anonymität und den Mechanismen visueller Kontrolle.',
        'media' => [
          'type' => 'video',
          'src' => 'assets/Folie.mp4'
        ],
        'link' => '#'
      ],
      

    ],
    'art-science' => [
      [
        'title' => 'CERES CONTENT MARKER',
        'description' => 'Forschungsprojekt, das Schlagzeilen sammelt und mit Marker‑Analyse nach gewaltbezogenen Mustern auswertet',
        'media' => 'assets/ZMD-I.jpg',
        'link' => 'zmd.php',
      ],
      [
        'title' => 'Heimweg-Umfrage',
        'description' => 'Über Wahrnehmung und Verhaltensweisen, die sich zu einem dynamischen Netzwerk urbaner Sicherheit verdichten',
        'media' => 'assets/LSW-1.jpg',
        'link' => 'das-rauschen-des-moments.php',
      ]
    ],
  ];

?>

<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./dist/css/main.css?v=1" rel="stylesheet">
  </head>
  <body class="bg-light">
    
    <header class="fixed mix-blend-difference [.navigation-open_&]:mix-blend-normal [.navigation-open_&]:bg-transparent top-0 left-0 w-full z-20">
      <div class="container-fluid relative py-5 px-10 sm:px-20 max-w-screen-lg">
        <div class="grid grid-cols-12">
          <div class="col-span-6">
            <h1>
              <span class="block bg-svg-zmd-logo-light w-[70px] h-[45px] bg-no-repeat bg-contain"></span>
            </h1>
          </div>
          <div class="col-span-6 flex justify-end">
            <button class="navigation-button bg-svg-menu-light [.navigation-open_&]:bg-svg-menu-close-light w-[28px] h-[28px] block bg-no-repeat bg-contain relative top-[-4px] transition-all duration-300"></button>
          </div>
        </div>
      </div>
    </header>

    <nav class="navigation fixed top-0 right-0 w-full h-full z-10 bg-dark/50 backdrop-blur-md hidden [.navigation-open_&]:block">
      <div class="container-fluid relative py-5 mt-32 px-10 sm:px-20 max-w-screen-lg">
        <ul>
          <li class="mb-2">
            <a class="text-light group text-md font-heading uppercase" href="#einleitung">Einleitung</a>
          </li>
          <li class="mb-2">
            <a class="text-light group text-md font-heading uppercase" href="#ausstellung">Ausstellung</a>
          </li>
          <li class="mb-2">
            <a class="text-light group text-md font-heading uppercase" href="#zehnmeterdunkel">Gesamtwerk</a>
          </li>
          <li class="mb-2">
            <a class="text-light group text-md font-heading uppercase" href="#forschungsprojekte">Forschungsprojekte</a>
        </ul>
        <ul class="list-none mt-10">
            <li class="mb-1"><a class="text-light text-sm font-heading uppercase" href="kontakt.php">Kontakt</a></li>
            <li class="mb-1"><a class="text-light text-sm font-heading uppercase" href="impressum.php">Impressum</a></li>
            <li class="mb-1"><a class="text-light text-sm font-heading uppercase" href="datenschutz.php">Datenschutz</a></li>
          </ul>
      </div>
    </nav>
    

    <section class="relative min-h-screen overflow-hidden hidden">
      <div class="absolute inset-0 pointer-events-none">
        <div class="w-full h-full">
          <video src="./assets/Folie.mp4" autoplay muted loop playsinline class="w-full h-full object-cover"></video>
        </div>
      </div>
			<a href="#about" class="absolute inset-x-0 bottom-10 cursor-pointer flex justify-center mix-blend-difference bg-transparent">
				<span class="bg-svg-caret-double-down-light w-[24px] h-[24px] block bg-no-repeat bg-contain animate-caret-float" aria-hidden="true"></span>
      </a>
    </section>

    <section class="bg-light mt-[100px]" id="about">
      <div class="container-fluid px-10 sm:px-20 max-w-screen-lg">
        <div class="">
          <p class="text-dark text-lg font-body text-justify hyphens-auto indent-[120px] md:indent-[140px]">
            <span class="italic">ZEHN METER DUNKEL</span> 
            ist eine multimediale, künst&shy;ler&shy;isch‑for&shy;sch&shy;ende Auseinandersetzung mit Dunkelheit, Distanz und (Un-)Sicherheit im urbanen Raum. Ausgangspunkt ist eine Schwelle: jene wenigen Meter, in denen Orientierung noch möglich scheint – und zugleich kippen kann. Zehn Meter werden zur Wahrnehmungsspanne: nah genug, um Strukturen zu erkennen, weit genug, damit Gesichter und Absichten unscharf bleiben.
          </p> 
          <p class="text-dark text-lg font-body text-justify hyphens-auto indent-5">
          Die Arbeit sucht keine abschließende Antwort – auch, weil sich das Themenfeld nicht abnutzt: Es ordnet sich fortlaufend neu und bleibt gegenwärtig, selbst wenn seine Intensität schwankt. Sie setzt bei Situationen an, in denen Alltag kippt: Engstellen, tote Winkel, Warteschleifen. Aus fotografischer Bildlektüre, Erfahrungswissen und Schlagzeilensprache entwickelt sie Verfahren, die Lesbarkeit als Voraussetzung von Orientierung greifbar machen.
          </p> 
          <p class="text-dark text-lg font-body text-justify hyphens-auto indent-5">
          Im Zentrum steht nicht die Zuspitzung, sondern der zweite Blick – und die Verfahren, die ihn ermöglichen. Was bleibt, ist ein Maßstab, kein Manifest. Zivilität zeigt sich zwischen uns im Platzmachen, im Blickkontakt, im Ton, der beruhigt statt hetzt.
          </p> 
          <p class="text-dark text-lg font-body text-justify hyphens-auto indent-5">
          Eine Einladung, die Stadt anders zu lesen: Aufmerksamkeit statt Alarm, Resonanz statt Rhetorik – und um auf ihre Herausforderungen zu antworten, mit Vielstimmigkeit und Paroli.
          </p>
        </div>
      </div>
    </section>

    <section class="border-t border-dark" id="works">
      <div class="container-fluid px-10 sm:px-20 max-w-screen-lg">

        <div class="mb-10 ">
          <h2 class="text-dark text-lg font-heading uppercase mb-1 indent-[120px] md:indent-[140px]">Ausstellung</h2>
          <p class="text-md font-body text-justify hyphens-auto indent-[120px] md:indent-[140px]">
            Die Arbeit <span class="italic">ZEHN METER DUNKEL</span> wird mit ausgewählten Positionen in Form einer Rauminstallation vom 29.01. bis 31.01.2026 im Rahmen der Werkschau an der Hochschule Bielefeld (HSBI) als Abschlussarbeit des Masterstudiengangs öffentlich ausgestellt.
          </p>
        </div>
        <div class="flex flex-col sm:grid grid-cols-12 gap-20">
          <?php foreach ($works['exhibition'] as $index => $work) : ?>
            <div class="col-span-12 sm:col-span-6 <?php echo ($index % 2 === 1) ? ' mt-[70px]' : ''; ?>">
            <div class="">
              <?php
              $rendered = false;
              
              if ($work['media'] && is_array($work['media']) && isset($work['media']['type'])) {
                if ($work['media']['type'] === 'video' && isset($work['media']['src']) && file_exists($work['media']['src'])) {
                  $rendered = true; ?>
                  <video autoplay muted loop playsinline class="w-full h-full object-cover"<?php echo (isset($work['media']['poster']) && file_exists($work['media']['poster'])) ? ' poster="' . htmlspecialchars($work['media']['poster']) . '"' : ''; ?>>
                    <source src="<?php echo htmlspecialchars($work['media']['src']); ?>" type="video/mp4">
                  </video>
                <?php } elseif ($work['media']['type'] === 'image' && isset($work['media']['srcset']) && is_array($work['media']['srcset']) && count($work['media']['srcset']) > 0) {
                  $filteredImages = array_filter($work['media']['srcset'], 'file_exists');
                  if (count($filteredImages) > 0) {
                    $rendered = true; ?>
                    <div class="image-fade-container relative w-full overflow-hidden" data-images='<?php echo json_encode(array_values($filteredImages)); ?>'>
                      <img src="<?php echo htmlspecialchars($filteredImages[0]); ?>" alt="<?php echo htmlspecialchars($work['title']); ?>" class="image-fade-item w-full h-auto object-cover opacity-100 transition-opacity duration-[2000ms]">
                    </div>
                  <?php }
                }
              }
              
              if (!$rendered) { ?>
                <picture>
                  <source srcset="assets/ZMD-I.jpg" type="image/webp">
                  <img src="assets/ZMD-I.jpg" alt="<?php echo htmlspecialchars($work['title']); ?>">
                </picture>
              <?php } ?>
            </div>
            <h2 class="text-dark text-md font-heading mt-3 uppercase"><?php echo $work['title']; ?></h2>
            <p class="text-md font-body">
              <?php echo $work['description']; ?>
            </p>  
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <section class="border-t border-dark" id="works">
      <div class="container-fluid px-10 sm:px-20 max-w-screen-lg">

        <div class="mb-10 ">
          <h2 class="text-dark text-lg font-heading uppercase mb-1 indent-[120px] md:indent-[140px]">Gesamtwerk</h2>
          <p class="text-md font-body text-justify hyphens-auto indent-[120px] md:indent-[140px]">
            Vom 29.01. bis 31.01.2026 wird die Arbeit <span class="italic">ZEHN METER DUNKEL</span> im Rahmen der Werkschau an der Hochschule Bielefeld (HSBI) als Abschlussarbeit des Masterstudiengangs in Form einer Rauminstallation öffentlich ausgestellt.
          </p>
        </div>
      </div>
    </section>

    <section class="bg-dark" id="other-positions">
      <div class="container-fluid px-10 sm:px-20 max-w-screen-lg">
        <div class="mb-10 ">
        <h2 class="text-light text-lg font-heading uppercase mb-1">Forschungsprojekte</h2>
        <p class="text-light text-lg font-body text-justify hyphens-auto">
          Das Gesamtwerk umfasst weitere Positionen, die über die Installation hinausgehen.
        </p>
        </div>
        <div class="flex flex-col sm:grid grid-cols-12 gap-10">
          <?php foreach ($works['art-science'] as $work) : ?>
            <div class="col-span-12 sm:col-span-6 lg:col-span-4">
            <div class="aspect-square overflow-hidden">
              <picture>
                <source srcset="assets/ZMD-I.jpg" type="image/webp">
                <img src="assets/ZMD-I.jpg" alt="Work 1">
              </picture>
            </div>
            <h2 class="text-light text-lg font-heading mt-3 uppercase"><?php echo $work['title']; ?></h2>
            <p class="text-md font-body text-light text-justify hyphens-auto">
              <?php echo $work['description']; ?>
            </p>  
          </div>
          <?php endforeach; ?>
        </div>
      </div>
    </section>

    <footer class="bg-grey">
      <div class="container-fluid py-25 px-10 sm:px-20 max-w-screen-lg">
        <section>
          <h2 class="text-light text-lg font-heading uppercase mb-10">Impressum</h2>
          <div class="flex flex-col sm:grid grid-cols-12 gap-10">
            <div class="col-span-6">
              

              <h3 class="text-light/50 text-md font-heading uppercase mb-1">
                Layout, Fotografie & Medien,<br>
                Texte, Recherche & Forschung
              </h3>
              <p class="text-light text-md font-body font-medium mb-6">
                Andreas Jon Grote
              </p>

              <h3 class="text-light/50 text-md font-heading uppercase mb-1">Betreuung</h3>
              <p class="text-light text-md font-body font-medium mb-6">
                Prof. Dr. Kirsten Wagner<br>
                Prof. Adrian Sauer
              </p>

              <h3 class="text-light/50 text-md font-heading uppercase mb-1">Dank</h3>
              <p class="text-light text-md font-body font-medium mb-6">
                Vanessa Biondi,<br>
                Carsten Gips,<br>
                Kim Groche,<br>
                Oliver Hunke,<br>
                Nadine & Kevin Schima,<br>
                Jana Sehnert
              </p>

              <h3 class="text-light/50 text-md font-heading uppercase mb-1">
                Hochschule Bielefeld<br>
                Fachbereich Gestaltung
              </h3>
              <p class="text-light text-md font-body font-medium">
                Bielefeld, Dezember 2025
              </p>
            </div>
            <div class="col-span-6">
              <h3 class="text-light/50 text-md font-heading uppercase mb-1">
                <br class="hidden sm:block">
                Kontakt
              </h3>
              <p class="text-light text-md font-body font-medium">
                Andreas Jon Grote<br>
                Meindersstr. 3<br>
                33615 Bielefeld<br>
                <br>
                <a href="https://www.xjonx.com" target="_blank">www.xjonx.com</a><br>
                <a href="mailto:mail@xjonx.com" target="_blank">mail@xjonx.com</a><br>
                <a href="https://www.instagram.com/andreasjongrote" target="_blank">@andreasjongrote</a>
              </p>
            </div>
          </div>
        </section>
      </div>
    </footer>

    <script type="module" src="./dist/js/main.js?v=2"></script>
  </body>
</html>