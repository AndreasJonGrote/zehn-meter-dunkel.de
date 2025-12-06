<?php

  $works = [
    'complete' => [
      [
        'title' => 'ZEHN METER DUNKEL',
        'description' => 'Annäherung an Schwellen, Routinen und Unsicherheiten, die den Alltag im urbanen Raum prägen.',
        'media' => 'assets/ZMD-I.jpg',
        'link' => 'zmd.php',
      ],
      [
        'title' => 'Das Rauschen des Moments',
        'description' => 'Über Wahrnehmung und Verhaltensweisen, die sich zu einem dynamischen Netzwerk urbaner Sicherheit verdichten.',
        'media' => 'assets/LSW-1.jpg',
        'link' => 'das-rauschen-des-moments.php',
      ],
      [
        'title' => 'Lesung urbaner Unsicherheiten',
        'description' => 'Umfrageergebnisse zu Angsträumen, Wegen, Erfahrungen und dem subjektiven Sicherheitsempfinden.',
        'media' => 'assets/LSU.jpg',
        'link' => 'lesung-urbaner-unsicherheiten.php',
      ],
      [
        'title' => 'Atlas der (UN-)sicherheit',
        'description' => 'Fotografische Untersuchungen von Übergängen, Sichtbarkeit, räumlichen Spannungen und Lesbarkeit.',
        'media' => 'assets/ATLAS.jpg',
        'link' => 'atlas-der-unsicherheit.php',
      ],
      [
        'title' => 'Ceres',
        'description' => 'Analyse der medialen Dramaturgien, in denen Gewalt zwischen Information und Inszenierung verhandelt wird.',
        'media' => 'assets/CERES.jpg',
        'link' => 'ceres.php',
      ],
      [
        'title' => 'Ich habe kein Gesicht',
        'description' => 'Videografische Erkundung von Beobachtung, Anonymität und den Mechanismen visueller Kontrolle.',
        'media' => 'assets/KESSLBRINK.jpg',
        'link' => 'ich-habe-kein-gesicht.php',
      ],
    ],
    'exhibition' => [
      [
        'title' => 'Parkbank',
        'description' => 'Sinnbild für den kleinsten gemeinsamen Nenner in der Stadt.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Ich habe kein Gesicht'
      ],
      [
        'title' => 'Ceres',
        'description' => 'Rauminstalltion von Information zur Inzienierung in Schlagzeilen.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Ceres'
      ],
      [
        'title' => 'Folie',
        'description' => 'Video mit der Frage zur Sichtbarkeit in der Stadt.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Ich habe kein Gesicht'
      ],
      [
        'title' => 'Datenstrom',
        'description' => 'Experimentelles Videoinstallation mit Menschen als Daten.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Ich habe kein Gesicht'
      ],
      [
        'title' => 'Lärmschutzwall II',
        'description' => 'Videografische Untersuchung von Übergängen, Sichtbarkeit, räumlichen Spannungen und Lesbarkeit.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Ich habe kein Gesicht'
      ],
      [
        'title' => 'Lärmschutzwall I',
        'description' => 'Fotografische Abwicklung die 200m auf 7m verdichtet.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Atlas der (UN-)sicherheit'
      ],
      [
        'title' => 'Kesselbrink I',
        'description' => 'Fotografische Untersuchung von Kesselbrink und seiner Umgebung.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Atlas der (UN-)sicherheit'
      ],
      [
        'title' => 'Kesselbrink II',
        'description' => 'Videografische Untersuchung von Übergängen, Sichtbarkeit, räumlichen Spannungen und Lesbarkeit.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Ich habe kein Gesicht'
      ],
      [
        'title' => 'Unterführung',
        'description' => 'Videografische Untersuchung von Übergängen, Sichtbarkeit, räumlichen Spannungen und Lesbarkeit.',
        'media' => 'assets/EXHIBITION-1.jpg',
        'link' => '#',
        'chapter' => 'Ich habe kein Gesicht'
      ],

    ],
  ];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./dist/css/main.css" rel="stylesheet">
  </head>
  <body class="bg-light">
    
    <header class="fixed mix-blend-difference [.navigation-open_&]:mix-blend-normal [.navigation-open_&]:bg-transparent top-0 left-0 w-full z-20">
      <div class="container-fluid relative py-5">
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
      <div class="container-fluid relative py-5 mt-32">
        <ul>
          <li class="block mb-10"><a class="text-light text-xl font-heading" href="index.html">Übersicht</a></li>
          
          <?php foreach ($works as $work) : ?>
            <li class="block mb-5">
              <a class="text-light group flex flex-col" href="<?php echo $work['link']; ?>">
                <h3 class="text-xl font-heading uppercase"><?php echo $work['title']; ?></h3>
              </a>
            </li>
          <?php endforeach; ?>
          
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

    <section class="bg-dark" id="about">
      <div class="container-fluid">
        <p class="text-light text-xl font-heading text-justify hyphens-auto">lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos. Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
      </div>
    </section>

    <section class="" id="works">
      <div class="container-fluid ">
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

    <footer class="bg-dark">
      <div class="container-fluid py-5">
        <p class="text-light text-md font-heading text-right">© 2025 ZMD. All rights reserved.</p>
      </div>
    </footer>

    <script type="module" src="./dist/js/main.js?v=1"></script>
  </body>
</html>