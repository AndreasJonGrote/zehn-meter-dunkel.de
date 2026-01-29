<header class="fixed top-0 left-0 w-full z-30 mix-blend-difference">
  <div class="container-fluid py-5">
    <div class="md:grid grid-cols-12 gap-5">
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
              $loadingAttr = $first ? 'loading="eager" fetchpriority="high"' : 'loading="lazy"';
              $first = false;
            ?>
            <picture class="atlas-rotator-item absolute inset-0 <?php echo $hiddenClass; ?>">
              <source srcset="<?php echo $webpPath; ?>" type="image/webp">
              <img src="<?php the_url() ; ?>/<?php echo $jpgPath; ?>" alt="<?php echo $alt; ?>" class="w-full h-full object-contain" <?php echo $loadingAttr; ?> decoding="async">
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
      <?php /*
      <div class="col-span-6">
        <ul class="flex items-center justify-end gap-5 text-light text-xs [body.modal-open_&]:hidden">
          <li><a href="<?php the_url() ; ?>/#ausstellung" class="font-heading uppercase">Ausstellung</a></li>
          <li><a href="<?php the_url() ; ?>/masterthesis/" class="font-heading uppercase">Masterthesis</a></li>
          <li><a href="<?php the_url() ; ?>/forschungsprojekte/" class="font-heading uppercase">Forschungsprojekte</a></li>
        </ul>
        <div class="hidden text-light items-center justify-end gap-5 [body.modal-open_&]:flex">
          <button class="bg-svg-menu-close-white w-[20px] h-[20px] bg-no-repeat bg-contain cursor-pointer"></button>
        </div>
      </div>
      */ ?>
    </div>
  </div>
</header>