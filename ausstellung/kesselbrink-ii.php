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
            <h2 class="text-2xl font-heading uppercase">Kesselbrink II</h2>
          </div>
        </div>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center">
          <div class="col-span-6 col-start-7 font-medium text-md font-body">
            <div class="relative aspect-[4/3]">
              <video class="w-full h-full object-cover" autoplay muted loop playsinline webkit-playsinline>
                <source src="<?php the_url() ; ?>/assets/kesselbrink_ii.mp4" type="video/mp4">
              </video>
            </div>
          </div>
          
        </div>
      </div>
    </section>

    <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center">
          <div class="col-span-6 col-start-2 font-medium text-md font-body">
            <p class="text-justify hyphens-auto">
              Der Kesselbrink erscheint in der Videosequenz nahezu menschenleer, 
              seine sozialen Zeichen wirken wie zurückgestellt. Bewegung entsteht 
              nur an den Rändern – durch digitale Werbeflächen, Wind in Bäumen und 
              Fahnen –, während die architektonische Struktur umso deutlicher 
              hervortritt, wie ein Raster, das bereitsteht, aber nicht genutzt wird. 
              In <span class="italic">Kesselbrink II</span> wird so sichtbar, wie ein 
              Ort mit hoher Aufenthaltsqualität, sobald soziale Präsenz fehlt, in eine 
              unbestimmte Lesbarkeit kippen kann – und damit auch als potenziell unsicher 
              erscheint.
            </p>
          </div>
        </div>
      </div>
    </section>

      <section class="">
      <div class="container-fluid">
        <div class="grid grid-cols-12 h-full relative items-center] mt-10">
          <div class="col-span-6 col-start-9 font-medium text-md font-body">
          <p><a href="<?php the_url() ; ?>/ausstellung/kesselbrink-i.php" class="text-sm font-heading uppercase text-dark">Kesselbrink I</a></p>
          <p><a href="<?php the_url() ; ?>/ausstellung/membran-der-anonymitaet.php" class="text-sm font-heading uppercase text-dark">Membran der Anonymität</a></p>
          </div>
        </div>
      </div>
    </section>

    <?php include '../library/footer.php'; ?>

  </body>
</html>