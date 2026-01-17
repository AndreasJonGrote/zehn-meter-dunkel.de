<header class="fixed top-0 left-0 w-full z-20 mix-blend-difference">
  <div class="container-fluid py-5">
    <div class="grid grid-cols-12 gap-5">
      <div class="col-span-6">
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
              <img src="<?php the_url() ; ?>/<?php echo $jpgPath; ?>" alt="<?php echo $alt; ?>" class="w-full h-full object-contain">
            </picture>
            <?php endforeach; ?>
          </div>
          <a href="<?php the_url() ; ?>/#top" class="block">
            <h1>
                <span class="block bg-svg-zmd-logo-white w-[70px] h-[45px] bg-no-repeat bg-contain"></span>
                <span class="sr-only">ZEHN METER DUNKEL</span>
            </h1>
          </a>
        </div>
      </div>
      <div class="col-span-6">
        <ul class="flex items-center justify-end gap-5 text-light text-xs">
          <li><a href="<?php the_url() ; ?>/#ausstellung" class="font-heading uppercase">Ausstellung</a></li>
          <li><a href="<?php the_url() ; ?>/masterthesis.php" class="font-heading uppercase">Masterthesis</a></li>
          <li><a href="<?php the_url() ; ?>/forschungsprojekte.php" class="font-heading uppercase">Forschungsprojekte</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>