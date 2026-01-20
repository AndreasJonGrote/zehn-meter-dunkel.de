<?php include 'library/config.php'; ?>

<!DOCTYPE html>
<html lang="de">
  <head>

    <?php include 'library/head.php'; ?>

    <title>ZEHN METER DUNKEL | Andreas Jon Grote</title>
  </head>
  <body class="bg-light">
      
    <?php include 'library/header.php'; ?>

    <div class="fixed inset-0 pointer-events-none bg-light/90 opacity-0 transition-opacity duration-300 [body.modal-open_&]:backdrop-blur-lg [body.modal-open_&]:opacity-100 z-10"></div>

      <?php include 'views/hero.php'; ?>

      <section class="bg-light text-dark" id="ausstellung">
        <div class="container-fluid">

          <div class="grid grid-cols-12 gap-5 mb-10">

            <!-- Einleitung -->
            <div class="col-span-4 parallax-item-[0.1]">
              <h2 class="text-sm font-heading uppercase mb-3">Ausstellung</h2>
              <p class="text-md font-body text-justify hyphens-auto">
                Zwischen Laternenlicht und Schatten liegt oft nur ein kurzer Abschnitt, 
                wenige Schritte, in denen Orientierung noch möglich scheint und zugleich 
                kippen kann. <span class="italic">ZEHN METER DUNKEL</span> setzt dort an, wo Distanz zu einer 
                Wahrnehmungsspanne wird, nah genug, um Strukturen zu erkennen, 
                weit genug, damit Details, Gesichter und Absichten in Unschärfe geraten. 
                Die Ausstellung zeigt eine Auswahl von Arbeiten, die diesen Zustand als 
                Frage von Lesbarkeit und Blick erfahrbar machen, als Fotografie, als 
                Bewegtbild und als installative Setzung, die Verhalten, 
                Sichtbarkeit und soziale Räume hinterfragen.
              </p>
            </div>
            <!--/ Einleitung -->

            <!-- Lärmschutzwall I -->
            <div class="relative group col-span-3 col-start-7 cursor-pointer work-item parallax-item-[0.05]">
              <div class="image-fade-container relative aspect-[4/5] w-full">
                <picture class="image-fade-item opacity-100 transition-opacity duration-[3000ms]">
                  <source srcset="<?php the_url() ; ?>/assets/laermschutzwall_i-03.webp" type="image/webp">
                  <img src="<?php the_url() ; ?>/assets/laermschutzwall_i-03.jpg" alt="Ausstellung" class="w-full" loading="lazy" decoding="async">
                </picture>
                <picture class="image-fade-item absolute inset-0 opacity-0 transition-opacity duration-[3000ms]">
                  <source srcset="<?php the_url() ; ?>/assets/laermschutzwall_i-13.webp" type="image/webp">
                  <img src="<?php the_url() ; ?>/assets/laermschutzwall_i-13.jpg" alt="Ausstellung" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </picture>
                <picture class="image-fade-item absolute inset-0 opacity-0 transition-opacity duration-[3000ms]">
                  <source srcset="<?php the_url() ; ?>/assets/laermschutzwall_i-21.webp" type="image/webp">
                  <img src="<?php the_url() ; ?>/assets/laermschutzwall_i-21.jpg" alt="Ausstellung" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </picture>
              </div>
              <h2 class="text-sm font-heading uppercase mt-3">Lärmschutzwall I</h2>
              <a href="<?php the_url() ; ?>/laermschutzwall-i/" data-modal="laermschutzwall-i" class="absolute inset-0 z-10"></a>
            </div>
            <!--/ Lärmschutzwall I -->

            <!-- Lärmschutzwall II -->
            <div class="relative group col-span-3 cursor-pointer work-item parallax-item-[-0.05]">
              <div class="relative aspect-[4/3]">
                <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline preload="none">
                  <source src="<?php the_url() ; ?>/assets/laermschutzwall_ii.mp4" type="video/mp4">
                </video>
              </div>
              <h2 class="text-sm font-heading uppercase mt-3">Lärmschutzwall II</h2>
              <a href="<?php the_url() ; ?>/laermschutzwall-ii/" data-modal="laermschutzwall-ii" class="absolute inset-0 z-10"></a>
            </div>
            <!--/ Lärmschutzwall II -->
          </div>

          <div class="grid grid-cols-12 gap-5 mb-10">
            <!-- Ceres -->
            <div class="relative group col-span-2 col-start-3 cursor-pointer work-item parallax-item-[0.05]">
              <div class="relative aspect-[3/4]">
                <picture class="absolute inset-0">
                  <source srcset="<?php the_url() ; ?>/assets/ceres.webp" type="image/webp">
                  <img src="<?php the_url() ; ?>/assets/ceres.jpg" alt="Ausstellung" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </picture>
              </div>
              <h2 class="text-sm font-heading uppercase mt-3">Ceres-Drucker</h2>
              <a href="<?php the_url() ; ?>/ceres-drucker/" data-modal="ceres-drucker" class="absolute inset-0 z-10"></a>
            </div>
            <!--/ Ceres -->
          </div>

          <div class="grid grid-cols-12 gap-5 mb-10">
            <!-- Kesselbrink I -->
            <div class="relative group col-span-3 col-start-6 cursor-pointer work-item parallax-item-[0.03]">
              <div class="image-fade-container relative aspect-[7/5]">
                <picture class="image-fade-item opacity-100 transition-opacity duration-[3000ms]">
                  <source srcset="<?php the_url() ; ?>/assets/kesselbrink_i-links.webp" type="image/webp">
                  <img src="<?php the_url() ; ?>/assets/kesselbrink_i-links.jpg" alt="Ausstellung" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </picture>
                <picture class="image-fade-item absolute inset-0 opacity-0 transition-opacity duration-[3000ms]">
                  <source srcset="<?php the_url() ; ?>/assets/kesselbrink_i-rechts.webp" type="image/webp">
                  <img src="<?php the_url() ; ?>/assets/kesselbrink_i-rechts.jpg" alt="Ausstellung" class="w-full h-full object-cover" loading="lazy" decoding="async">
                </picture>
              </div>
              <h2 class="text-sm font-heading uppercase mt-3">Kesselbrink I</h2>
              <a href="<?php the_url() ; ?>/kesselbrink-i/" data-modal="kesselbrink-i" class="absolute inset-0 z-10"></a>
            </div>
            <!--/ Kesselbrink I -->
            <!-- Kesselbrink II -->
            <div class="relative group col-span-3 cursor-pointer work-item parallax-item-[-0.05]">
              <div class="relative aspect-[4/3]">
                <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline preload="none">
                  <source src="<?php the_url() ; ?>/assets/kesselbrink_ii.mp4" type="video/mp4">
                </video>
              </div>
              <h2 class="text-sm font-heading uppercase mt-3">Kesselbrink II</h2>
              <a href="<?php the_url() ; ?>/kesselbrink-ii/" data-modal="kesselbrink-ii" class="absolute inset-0 z-10"></a>
            </div>
            <!--/ Kesselbrink II -->
          </div>

          <div class="grid grid-cols-12 gap-5 mb-10">
            <!-- Membran der Anonymität -->
            <div class="relative group col-span-3 col-start-2 cursor-pointer work-item parallax-item-[0.05]">
              <div class="relative aspect-[4/3]">
                <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline preload="none">
                  <source src="<?php the_url() ; ?>/assets/ich-habe-kein-gesicht_membran.mp4" type="video/mp4">
                </video>
              </div>
              <h2 class="text-sm font-heading uppercase mt-3">Membran der Anonymität</h2>
              <a href="<?php the_url() ; ?>/membran-der-anonymitaet/" data-modal="membran-der-anonymitaet" class="absolute inset-0 z-10"></a>
            </div>
            <!--/ Membran der Anonymität -->
            <!-- Unterführung -->
            <div class="relative group col-span-3 col-start-10 cursor-pointer work-item mt-[150px] parallax-item-[-0.05]">
              <div class="relative aspect-[4/3]">
                <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline preload="none">
                  <source src="<?php the_url() ; ?>/assets/unterfuehrung.mp4" type="video/mp4">
                </video>
              </div>
              <h2 class="text-sm font-heading uppercase mt-3">Unterführung</h2>
              <a href="<?php the_url() ; ?>/unterfuehrung/" data-modal="unterfuehrung" class="absolute inset-0 z-10"></a>
            </div>
            <!--/ Unterführung -->
          </div>
        </div>
      </section>

      <section class="bg-light text-dark" id="theorie">
        <div class="container-fluid">
          <div class="relative flex items-center justify-center gap-5">
            <p><a href="<?php the_url() ; ?>/masterthesis/" class="text-sm font-heading uppercase text-dark">Masterthesis</a></p>
            <p><a href="<?php the_url() ; ?>/forschungsprojekte/" class="text-sm font-heading uppercase text-dark">Forschungsprojekte</a></p>
          </div>
        </div>
      </section>
    

      <?php include 'views/modals-ausstellung.php'; ?>

      <?php include 'library/footer.php'; ?>

  </body>
</html>