
<!DOCTYPE html>
<html lang="de">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZEHN METER DUNKEL | Andreas Jon Grote</title>
      <link rel="icon" type="image/png" sizes="48x48" href="assets/favicon.png">
    </head>
    <link href="./dist/css/main.css?v=<?php echo time(); ?>" rel="stylesheet">
  </head>
  <body class="bg-light">
      
    <header class="fixed top-0 left-0 w-full z-20 mix-blend-difference">
      <div class="container-fluid py-5">
        <div class="flex items-center">
          <div class="image-rotator relative h-[45px] w-0 overflow-hidden transition-all duration-500">
            <?php
            $atlasImages = glob('assets/atlas-der-unsicherheit_*.jpg');
            $first = true;
            foreach ($atlasImages as $jpgPath) :
              $webpPath = str_replace('.jpg', '.webp', $jpgPath);
              $alt = str_replace(['assets/atlas-der-unsicherheit_', '.jpg'], '', $jpgPath);
              $hiddenClass = $first ? '' : 'hidden';
              $first = false;
            ?>
            <picture class="atlas-rotator-item absolute inset-0 <?php echo $hiddenClass; ?>">
              <source srcset="<?php echo $webpPath; ?>" type="image/webp">
              <img src="<?php echo $jpgPath; ?>" alt="<?php echo $alt; ?>" class="w-full h-full object-contain">
            </picture>
            <?php endforeach; ?>
          </div>
          <h1>
            <span class="block bg-svg-zmd-logo-white w-[70px] h-[45px] bg-no-repeat bg-contain"></span>
        </h1>
        </div>
      </div>
    </header>

    <section class="bg-grey text-light h-[100vh]">
      <div class="container-fluid h-full">
        <div class="grid grid-cols-12 h-full relative items-center">
          <div class="col-span-4 self-end relative z-0">
            <div class="parallax-wrapper relative">
              <picture class="parallax-item-[-0.5] w-full absolute bottom-16 -right-32">
                <source srcset="assets/atlas-der-unsicherheit_rechteck.webp" type="image/webp">
                <img src="assets/atlas-der-unsicherheit_rechteck.jpg" alt="Ausstellung" class="w-full">
              </picture>
            </div>
          </div>
          <p class="text-2xl font-heading uppercase col-span-8 relative z-1 mix-blend-difference parallax-item-[0.4]">
            <span class="block sm:inline">Ein Blick auf </span>
            <span class="block sm:inline">Dunkel&shy;heit, </span>
            <span class="block sm:inline">Dist&shy;anz, </span>
            <span class="block sm:inline">und das Gefühl </span>
            <span class="block sm:inline">von Unsicher&shy;heit in der Stadt.</span>
          </p>
        </div>
      </div>
    </section>
    
    <section class="bg-light" id="einleitung">

      

      <div class="container-fluid">
        <div class="text-dark text-lg font-body text-justify hyphens-auto indent-5 relative z-10">
          <p class="indent-[100px] sm:indent-[120px] md:indent-[140px]">
            <span class="italic">ZEHN METER DUNKEL</span> 
            ist eine multimediale, künst&shy;ler&shy;isch‑for&shy;sch&shy;ende Auseinandersetzung mit Dunkelheit, Distanz und (Un-)Sicherheit im urbanen Raum. Ausgangspunkt ist eine Schwelle: jene wenigen Meter, in denen Orientierung noch möglich scheint – und zugleich kippen kann. Zehn Meter werden zur Wahrnehmungsspanne: nah genug, um Strukturen zu erkennen, weit genug, damit Gesichter und Absichten unscharf bleiben.
          </p> 
          <p class="">
          Die Arbeit sucht keine abschließende Antwort – auch, weil sich das Themenfeld nicht abnutzt: Es ordnet sich fortlaufend neu und bleibt gegenwärtig, selbst wenn seine Intensität schwankt. Sie setzt bei Situationen an, in denen Alltag kippt: Engstellen, tote Winkel, Warteschleifen. Aus fotografischer Bildlektüre, Erfahrungswissen und Schlagzeilensprache entwickelt sie Verfahren, die Lesbarkeit als Voraussetzung von Orientierung greifbar machen.
          </p> 
          <p class="">
          Im Zentrum steht nicht die Zuspitzung, sondern der zweite Blick – und die Verfahren, die ihn ermöglichen. Was bleibt, ist ein Maßstab, kein Manifest. Zivilität zeigt sich zwischen uns im Platzmachen, im Blickkontakt, im Ton, der beruhigt statt hetzt.
          </p> 
          <p class=""> Eine Einladung, die Stadt anders zu lesen: Aufmerksamkeit statt Alarm, Resonanz statt Rhetorik – und um auf ihre Herausforderungen zu antworten, mit Vielstimmigkeit und Paroli.
          </p>
        </div>
      </div>
 
    </section>

    <section class="bg-light  text-dark" id="ausstellung">
      <div class="container-fluid">

        <div class="mb-20">
          <h2 class="text-lg font-heading uppercase mb-1 indent-[80px] md:indent-[140px]">Ausstellung</h2>
          <p class="text-md font-body text-justify hyphens-auto indent-[80px] md:indent-[140px]">
            Die Arbeit <span class="italic">ZEHN METER DUNKEL</span> wird mit ausgewählten Positionen in Form einer Rauminstallation vom 29.01. bis 31.01.2026 im Rahmen der Werkschau an der Hochschule Bielefeld (HSBI) als Abschlussarbeit des Masterstudiengangs öffentlich ausgestellt.
          </p>
        </div>
        <div class="grid grid-cols-12 gap-5 md:gap-10 lg:gap-20">

          <!-- Lärmschutzwall I -->
          <div class="relative group col-span-12 sm:col-span-6 cursor-pointer work-item">
            <div class="image-fade-container relative mb-5 aspect-[4/5] w-full">
              <picture class="image-fade-item opacity-100 transition-opacity duration-[3000ms]">
                <source srcset="assets/laermschutzwall_i-03.webp" type="image/webp">
                <img src="assets/laermschutzwall_i-03.jpg" alt="Ausstellung" class="w-full">
              </picture>
              <picture class="image-fade-item absolute inset-0 opacity-0 transition-opacity duration-[3000ms]">
                <source srcset="assets/laermschutzwall_i-13.webp" type="image/webp">
                <img src="assets/laermschutzwall_i-13.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
              <picture class="image-fade-item absolute inset-0 opacity-0 transition-opacity duration-[3000ms]">
                <source srcset="assets/laermschutzwall_i-21.webp" type="image/webp">
                <img src="assets/laermschutzwall_i-21.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
            </div>
            <h2 class="text-md font-heading uppercase mb-3">Lärmschutzwall I</h2>
            <p class="text-md font-body text-justify hyphens-auto mb-5">
              <span class="italic">Lärmschutzwall I</span> zeigt in 21 Bildern eine zweihundert Meter lange Abschirmung, die Sichtbeziehungen kappt, und thematisiert, wie Sicherheit durch Abschottung Risiko in die wenigen Durchgänge verschiebt.
            </p>
            <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] border-grey px-[12px] py-[7px] bg-grey group-hover:bg-light transition-all duration-300">
              <span class="bg-svg-icon-arrow-light group-hover:bg-svg-icon-arrow-grey transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
              <span class="text-light group-hover:text-grey transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
            </button>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Lärmschutzwall I -->

          <!-- Lärmschutzwall II -->
          <div class="relative group col-span-12 sm:col-span-6 cursor-pointer work-item">
            <div class="relative mb-5 aspect-[4/3]">
              <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline>
                <source src="assets/laermschutzwall_ii.mp4" type="video/mp4">
              </video>
            </div>
            <h2 class="text-md font-heading uppercase mb-3">Lärmschutzwall II</h2>
            <p class="text-md font-body text-justify hyphens-auto mb-5">
            <span class="italic">Lärmschutzwall II</span> zeigt den fotografisch untersuchten Ort nachts aus der POV-Perspektive und thematisiert, wie blendende Autos und kurze Lichtinseln eingeschränkte Lesbarkeit körperlich erfahrbar machen.
            </p>
            <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] border-grey px-[12px] py-[7px] bg-grey group-hover:bg-light transition-all duration-300">
              <span class="bg-svg-icon-arrow-light group-hover:bg-svg-icon-arrow-grey transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
              <span class="text-light group-hover:text-grey transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
            </button>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Lärmschutzwall II -->

          <!-- Kesselbrink I -->
          <div class="relative group col-span-12 sm:col-span-6 cursor-pointer work-item">
            <div class="image-fade-container relative mb-5 aspect-[7/5]">
              <picture class="image-fade-item opacity-100 transition-opacity duration-[3000ms]">
                <source srcset="assets/kesselbrink_i-links.webp" type="image/webp">
                <img src="assets/kesselbrink_i-links.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
              <picture class="image-fade-item absolute inset-0 opacity-0 transition-opacity duration-[3000ms]">
                <source srcset="assets/kesselbrink_i-rechts.webp" type="image/webp">
                <img src="assets/kesselbrink_i-rechts.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
            </div>
            <h2 class="text-md font-heading uppercase mb-3">Kesselbrink I</h2>
            <p class="text-md font-body text-justify hyphens-auto mb-5">
              <span class="italic">Kesselbrink I</span> zeigt als Schwarz-Weiß-Dyptichon den Platz in horizontaler Schichtung mit verteilten Personen und thematisiert, wie die Reduktion auf Geometrie, Licht und Blickachsen Sicherheit als Verhandlung zwischen Gruppen im geteilten Raum sichtbar macht.
            </p>
            <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] border-grey px-[12px] py-[7px] bg-grey group-hover:bg-light transition-all duration-300">
              <span class="bg-svg-icon-arrow-light group-hover:bg-svg-icon-arrow-grey transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
              <span class="text-light group-hover:text-grey transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
            </button>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Kesselbrink I -->

          <!-- Kesselbrink II -->
          <div class="relative group col-span-12 sm:col-span-6 cursor-pointer work-item">
            <div class="relative mb-5 aspect-[4/3]">
              <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline>
                <source src="assets/kesselbrink_ii.mp4" type="video/mp4">
              </video>
            </div>
            <h2 class="text-md font-heading uppercase mb-3">Kesselbrink II</h2>
            <p class="text-md font-body text-justify hyphens-auto mb-5">
              <span class="italic">Kesselbrink II</span> zeigt denselben Platz wie das fotografische Dyptichon in einer Videosequenz, die den Ort nahezu menschenleer zeigt, und thematisiert, wie die Abwesenheit von Personen einen Raum mit hoher Aufenthaltsqualität als potenziell unsicher oder unbestimmt erscheinen lässt.
            </p>
            <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] border-grey px-[12px] py-[7px] bg-grey group-hover:bg-light transition-all duration-300">
              <span class="bg-svg-icon-arrow-light group-hover:bg-svg-icon-arrow-grey transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
              <span class="text-light group-hover:text-grey transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
            </button>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Kesselbrink II -->

          <!-- Membran der Anonymität -->
          <div class="relative group col-span-12 sm:col-span-6 cursor-pointer work-item">
            <div class="relative mb-5 aspect-[4/3]">
              <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline>
                <source src="assets/ich-habe-kein-gesicht_membran.mp4" type="video/mp4">
              </video>
            </div>
            <h2 class="text-md font-heading uppercase mb-3">Membran der Anonymität</h2>
            <p class="text-md font-body text-justify hyphens-auto mb-5">
              <span class="italic">Membran der Anonymität</span> zeigt eine durch eine halbtransparente Folie gefilmte Sequenz, in der Körper nur schemenhaft sichtbar bleiben, und thematisiert, wie Anonymität physisch erfahrbar wird und eine veränderte Art des Sehens erzwingt, in der Orientierung möglich bleibt, ohne Identität zu verlangen.
            </p>
            <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] border-grey px-[12px] py-[7px] bg-grey group-hover:bg-light transition-all duration-300">
              <span class="bg-svg-icon-arrow-light group-hover:bg-svg-icon-arrow-grey transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
              <span class="text-light group-hover:text-grey transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
            </button>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Membran der Anonymität -->

          <!-- Ceres -->
          <div class="relative group col-span-12 sm:col-span-6 cursor-pointer work-item">
            <div class="relative mb-5 aspect-[3/4]">
              <picture class="absolute inset-0">
                <source srcset="assets/ceres.webp" type="image/webp">
                <img src="assets/ceres.jpg" alt="Ausstellung" class="w-full h-full object-cover">
              </picture>
            </div>
            <h2 class="text-md font-heading uppercase mb-3">Ceres-Drucker</h2>
            <p class="text-md font-body text-justify hyphens-auto mb-5">
              Ceres-Drucker zeigt einen Thermodrucker in einer Box, der Schlagzeilen über zivile Gewalt auf Endlospapier druckt, das sich auf dem Boden sammelt, und thematisiert, wie die Wiederholung und Dramatisierung von Gewaltnachrichten durch die wachsende physische Spur körperlich erfahrbar wird.
            </p>
            <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] border-grey px-[12px] py-[7px] bg-grey group-hover:bg-light transition-all duration-300">
              <span class="bg-svg-icon-arrow-light group-hover:bg-svg-icon-arrow-grey transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
              <span class="text-light group-hover:text-grey transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
            </button>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Ceres -->

          <!-- Unterführung -->
          <div class="relative group col-span-12 sm:col-span-6 cursor-pointer work-item">
            <div class="relative mb-5 aspect-[4/3]">
              <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline>
                <source src="assets/unterfuehrung.mp4" type="video/mp4">
              </video>
            </div>
            <h2 class="text-md font-heading uppercase mb-3">Unterführung</h2>
            <p class="text-md font-body text-justify hyphens-auto mb-5">
              <span class="italic">Unterführung</span> zeigt eine Unterführung aus der Perspektive einer Sicherheitskamera mit verpixelten Personen und thematisiert, wie dieser reine Transitraum durch seine Gleichgültigkeit Verhalten strukturiert und die Dauer des Verweilens faktisch nicht existiert.
            </p>
            <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] border-grey px-[12px] py-[7px] bg-grey group-hover:bg-light transition-all duration-300">
              <span class="bg-svg-icon-arrow-light group-hover:bg-svg-icon-arrow-grey transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
              <span class="text-light group-hover:text-grey transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
            </button>
            <!-- <a href="#" class="absolute inset-0 z-10"></a> -->
          </div>
          <!--/ Unterführung -->

        </div>
      </div>
    </section>

    <section class="border-t bg-grey text-light" id="gesamtwerk">
      <div class="container-fluid">

        <div class="mb-20">
          <h2 class="text-lg font-heading uppercase mb-1 indent-[120px] md:indent-[140px]">Gesamtwerk</h2>
          <p class="text-md font-body text-justify hyphens-auto indent-[120px] md:indent-[140px]">
            Vom 29.01. bis 31.01.2026 wird die Arbeit <span class="italic">ZEHN METER DUNKEL</span> im Rahmen der Werkschau an der Hochschule Bielefeld (HSBI) als Abschlussarbeit des Masterstudiengangs in Form einer Rauminstallation öffentlich ausgestellt.
          </p>
        </div>

        <div class="flex flex-col gap-20 items-start">

            <!-- Das Rauschen des Moments -->
            <div class="relative group work-item">
              <div class="relative mb-5 col-span-8">
              <h2 class="text-md font-heading uppercase mb-3">Das Rauschen des Moments</h2>
                <p class="text-md font-body text-justify hyphens-auto mb-5">
                  Das Rauschen des Moments übersetzt die Akteur-Netzwerk-Theorie und das Rhizom-Konzept in eine interaktive Installation, die urbane Netzwerke körperlich erfahrbar macht: Zwei visuelle Ebenen – Hintergrundrauschen und reaktive Punktwolke – zeigen, wie Bewegung zum Erkenntnisraum wird und Orientierung aus dem Zusammenspiel von Stabilität und Wandel entsteht.
                </p>
                <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] px-[12px] py-[7px] bg-light group-hover:bg-grey transition-all duration-300">
                  <span class="bg-svg-icon-arrow-grey group-hover:bg-svg-icon-arrow-light transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
                  <span class="text-grey group-hover:text-light transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
                </button>
              </div>
              <!-- <a href="#" class="absolute inset-0 z-10"></a> --> 
            </div>
            <!--/ Das Rauschen des Moments -->

            <!-- Lesung urbaner Unsicherheiten -->
            <div class="relative group work-item">
              <div class="relative mb-5 col-span-8">
              <h2 class="text-md font-heading uppercase mb-3">Lesung urbaner Unsicherheiten</h2>
                <p class="text-md font-body text-justify hyphens-auto mb-5">
                  <span class="italic">Lesung urbaner Unsicherheiten</span> verbindet soziologische Empirie und künstlerische Forschung: Die Online-Umfrage mit rund tausend Teilnehmenden erhebt subjektives Sicherheitsempfinden und liefert die empirische Grundlage für die künstlerischen Arbeiten. Die wortgetreuen Originalzitate werden als vielstimmiges urbanes Klagelied präsentiert und zeigen, dass Unsicherheit durch Konstellationen aus Lesbarkeit, Nähe und sozialer Präsenz entsteht. Diese Erkenntnisse fließen direkt in die fotografische und videografische Arbeit ein, die jene Angsträume visualisieren, die die Befragten beschreiben.
                </p>
                <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] px-[12px] py-[7px] bg-light group-hover:bg-grey transition-all duration-300">
                  <span class="bg-svg-icon-arrow-grey group-hover:bg-svg-icon-arrow-light transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
                  <span class="text-grey group-hover:text-light transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
                </button>
              </div>
              <!-- <a href="#" class="absolute inset-0 z-10"></a> --> 
            </div>
            <!--/ Lesung urbaner Unsicherheiten -->

            <!-- Atlas der (Un-)Sicherheit -->
            <div class="relative group work-item">
              <div class="relative mb-5 col-span-8">
              <h2 class="text-md font-heading uppercase mb-3">Atlas der (Un-)Sicherheit</h2>
                <p class="text-md font-body text-justify hyphens-auto mb-5">
                Atlas der (Un-)Sicherheit übersetzt die Umfrageergebnisse in räumliche Konstellationen und nutzt Proxemik (Hall) und den produzierten Raum (Lefebvre), um sichtbar zu machen, wie Schwellen, Barrieren, Beleuchtung und Überwachung zu Akteuren des Sicherheitsempfindens werden. Die Serie testet Thesen im Medium der Anschauung und zeigt, dass Bilder Wissen erzeugen können.
                </p>
                <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] px-[12px] py-[7px] bg-light group-hover:bg-grey transition-all duration-300">
                  <span class="bg-svg-icon-arrow-grey group-hover:bg-svg-icon-arrow-light transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
                  <span class="text-grey group-hover:text-light transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
                </button>
              </div>
              <!-- <a href="#" class="absolute inset-0 z-10"></a> --> 
            </div>
            <!--/ Atlas der (Un-)Sicherheit -->

            <!-- Ceres -->
            <div class="relative group work-item">
              <div class="relative mb-5 col-span-8">
              <h2 class="text-md font-heading uppercase mb-3">Ceres</h2>
                <p class="text-md font-body text-justify hyphens-auto mb-5">
                  Ceres verbindet soziologische Medienanalyse und künstlerische Praxis: Das Projekt analysiert systematisch Schlagzeilen (rund vier Millionen Überschriften) und entwickelt die Ceres Content Markers zur Erkennung gewaltbezogener Sprache. Die Analyse zeigt, wie Gewalt medial in Szene gesetzt wird und das Mean World Syndrome (Gerbner) das Sicherheitsempfinden prägt. In der künstlerischen Umsetzung übersetzt ein Thermodrucker die digitalen Nachrichten in eine physische Spur, die sich auf dem Boden akkumuliert und den Rhythmus der Gewaltnachrichten sichtbar macht.
                </p>
                <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] px-[12px] py-[7px] bg-light group-hover:bg-grey transition-all duration-300">
                  <span class="bg-svg-icon-arrow-grey group-hover:bg-svg-icon-arrow-light transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
                  <span class="text-grey group-hover:text-light transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
                </button>
              </div>
              <!-- <a href="#" class="absolute inset-0 z-10"></a> --> 
            </div>
            <!--/ Ceres -->

            <!-- Ich habe kein Gesicht -->
            <div class="relative group work-item">
              <div class="relative mb-5 col-span-8">
              <h2 class="text-md font-heading uppercase mb-3">Ich habe kein Gesicht</h2>
                <p class="text-md font-body text-justify hyphens-auto mb-5">
                  <span class="italic">Ich habe kein Gesicht</span> verbindet soziologische Theorie und künstlerische Praxis: Die Videoinstallation thematisiert das Spannungsfeld zwischen Anonymität und permanenter Überwachung und bewegt sich zwischen Foucaults Panoptismus und Augés Nicht-Orten. Menschen sind verpixelt, Handlungen erkennbar. Die Installation macht sichtbar, wie unterschiedlich ein Raum erscheint, wenn er betrachtet oder durchschritten wird, und macht Anonymität zur Ressource, die Orientierung erlaubt, ohne dauerhafte Identifizierbarkeit zu erzwingen.
                </p>
                <button data-modal-open="modal-laermschutzwall" class="group inline-flex items-center gap-1 border-[2px] px-[12px] py-[7px] bg-light group-hover:bg-grey transition-all duration-300">
                  <span class="bg-svg-icon-arrow-grey group-hover:bg-svg-icon-arrow-light transition-all duration-300 w-[16px] h-[16px] bg-no-repeat bg-contain"></span>
                  <span class="text-grey group-hover:text-light transition-all duration-300 text-md font-body font-medium">Mehr erfahren</span>
                </button>
              </div>
              <!-- <a href="#" class="absolute inset-0 z-10"></a> --> 
            </div>
            <!--/ Ich habe kein Gesicht -->

            

        </div>
      </div>
    </section>

   

    <footer class="bg-grey">
      <div class="container-fluid py-25">
        <section>
          <h2 class="text-light text-lg font-heading uppercase mb-10">Impressum</h2>
          <div class="flex flex-col sm:grid grid-cols-12 gap-10 text-sm">
            <div class="col-span-4" id="impressum">

              <h3 class="text-light/50 font-heading uppercase mb-1">Betreuer</h3>
              <p class="text-light font-body font-medium mb-6">
                Prof. Dr. Kirsten Wagner<br>
                Prof. Adrian Sauer
              </p>
              

              <h3 class="text-light/50 font-heading uppercase mb-1">
                Layout, Fotografie & Medien,<br>
                Texte, Recherche & Forschung
              </h3>
              <p class="text-light font-body font-medium mb-6">
                Andreas Jon Grote
              </p>

              

              <h3 class="text-light/50 font-heading uppercase mb-1">Dank</h3>
              <p class="text-light font-body font-medium">
                Vanessa Biondi,<br>
                Carsten Gips,<br>
                Kim Groche,<br>
                Oliver Hunke,<br>
                Nadine & Kevin Schima,<br>
                Jana Sehnert
              </p>

              
            </div>
            <div class="col-span-4" id="kontakt">
            <h3 class="text-light/50 font-heading uppercase mb-1">
                Webdesign & Entwicklung
              </h3>
              <p class="text-light font-body font-medium mb-6">
                Andreas Jon Grote
              </p>

              <h3 class="text-light/50 font-heading uppercase mb-1">
                Hochschule Bielefeld<br>
                Fachbereich Gestaltung
              </h3>
              <p class="text-light font-body font-medium">
                Bielefeld, Dezember 2025
              </p>
            </div>
            <div class="col-span-4" id="kontakt">
              <h3 class="text-light/50 font-heading uppercase mb-1">
                Kontakt
              </h3>
              <p class="text-light font-body font-medium">
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

    <script type="module" src="./dist/js/main.js?v=<?php echo time(); ?>"></script>
  </body>
</html>