<?php

  $works = [

    'exhibition' => [
      [
        'title' => 'Das Rauschen des Moments',
        'description' => 'Über Wahrnehmung und Verhaltensweisen, die sich zu einem dynamischen Netzwerk urbaner Sicherheit verdichten.',
        'media' => 'assets/EXHIBITION-1.jpg',
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
        'media' => 'assets/EXHIBITION-1.jpg',
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
        'media' => 'assets/EXHIBITION-1.jpg',
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
        <p class="text-light/50 text-md font-heading mb-5">Künstlerische Positionen</p>
        <ul class="pl-5">         
          <?php foreach ($works['exhibition'] as $work) : ?>
            <li class="block mb-5">
              <a class="text-light group flex flex-col" href="<?php echo $work['link']; ?>">
                <h3 class="text-lg font-heading uppercase"><?php echo $work['title']; ?></h3>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <p class="text-light/50 text-md font-heading mb-5">Forschungsprojekte</p>
        <ul class="pl-5">         
          <?php foreach ($works['art-science'] as $work) : ?>
            <li class="block mb-5">
              <a class="text-light group flex flex-col" href="<?php echo $work['link']; ?>">
                <h3 class="text-lg font-heading uppercase"><?php echo $work['title']; ?></h3>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
        <ul class="mt-10">
          <li class="block mb-1"><a class="text-light text-md font-heading" href="kontakt.php">Kontakt</a></li>
          <li class="block mb-1"><a class="text-light text-md font-heading" href="impressum.php">Impressum</a></li>
          <li class="block mb-1"><a class="text-light text-md font-heading" href="datenschutz.php">Datenschutz</a></li>
        </ul>
      </div>
    </nav>

    <section class="relative min-h-screen overflow-hidden">
      <div class="absolute inset-0 pointer-events-none">
        <div class="w-full h-full">
          <video src="./assets/Folie.mp4" autoplay muted loop playsinline class="w-full h-full object-cover"></video>
        </div>
      </div>
			<a href="#about" class="absolute inset-x-0 bottom-10 cursor-pointer flex justify-center mix-blend-difference bg-transparent">
				<span class="bg-svg-caret-double-down-light w-[24px] h-[24px] block bg-no-repeat bg-contain animate-caret-float" aria-hidden="true"></span>
      </a>
    </section>

    <section class="bg-light" id="about">
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
          <h2 class="text-dark text-lg font-heading uppercase mb-1">Künstlerische Positionen</h2>
          <p class="text-lg font-body text-justify hyphens-auto">
            Als Master-Abschlussarbeit wird <span class="italic">ZEHN METER DUNKEL</span> im Rahmen der Werkschau an der HSBI vom 29.01. bis 31.01.2026 mit den folgenden Positionen als multimediale Installation gezeigt.
          </p>
        </div>
        <div class="flex flex-col sm:grid grid-cols-12 gap-10">
          <?php foreach ($works['exhibition'] as $work) : ?>
            <div class="col-span-12 sm:col-span-6 lg:col-span-4">
            <div class="aspect-square overflow-hidden">
              <picture>
                <source srcset="assets/ZMD-I.jpg" type="image/webp">
                <img src="assets/ZMD-I.jpg" alt="Work 1">
              </picture>
            </div>
            <h2 class="text-dark text-lg font-heading mt-3 uppercase"><?php echo $work['title']; ?></h2>
            <p class="text-md font-body">
              <?php echo $work['description']; ?>
            </p>  
          </div>
          <?php endforeach; ?>
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

    <footer class="bg-light">
      <div class="container-fluid py-5">
        <div class="flex flex-col sm:grid grid-cols-12 gap-10">
          <p class="text-dark text-sm font-heading col-span-6">© 2025 Andreas Jon Grote</p>
          <p class="text-dark text-sm font-heading text-right col-span-6">
          <a href="https://www.xjonx.com" class="underline" target="_blank">www.xjonx.com</a>
            <a href="impressum.php" class="underline">Impressum</a>
            <a href="datenschutz.php" class="underline">Datenschutz</a>
          </p>  
        </div>
      </div>
    </footer>

    <script type="module" src="./dist/js/main.js?v=2"></script>
  </body>
</html>