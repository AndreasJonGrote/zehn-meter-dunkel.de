
<!DOCTYPE html>
<html lang="de">
  <head>

    <?php include 'views/head.php'; ?>

    <title>ZEHN METER DUNKEL | Andreas Jon Grote</title>
  </head>
  <body class="bg-light">
      
    <?php include 'views/header.php'; ?>


    <section class="text-light mix-blend-difference">
      <div class="container-fluid mt-40">
        <div class="grid grid-cols-12 relative parallax-item-[-0.2]">
          <div class="col-span-4 col-start-3 font-medium text-lg font-body">
            <h2 class="text-2xl font-heading uppercase">CERES CONTENT MARKERS</h2>
          </div>
        </div>
      </div>
    </section>

		<section class="text-light">
      <div class="container-fluid mix-blend-difference">
        <div class="grid grid-cols-12 relative parallax-item-[-0.2]">
          <div class="col-span-8 col-start-4 font-medium text-md font-body">
            <p>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
            <p class="indent-5">
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
						</p>
          </div>
        </div>
      </div>
    </section>

    <section class="text-grey">
      <div class="container-fluid">
        
          <div class="grid grid-cols-12 h-full relative items-center">
            <div class="col-span-6 col-start-2">
            <div class="parallax-item-[-0.5]">
              <form class="relative ccm-search-form bg-paper p-1 rounded-lg flex gap-1">
                <input type="text" id="ccm-search" placeholder="Gib einen Text ein…" class="flex-1 py-3 px-4 bg-paper text-dark text-lg font-body rounded-lg placeholder:text-grey/80">
                <button type="button" class="flex-shrink-0 py-3 px-4 border bg-grey rounded-lg">
                  <span class="bg-svg-icon-shuffle-light w-[24px] h-[24px] block"></span>
                </button>
              </form>

              <div class="ccm-stats-wrapper text-light p-2 mt-2 bg-grey rounded-lg hidden">

                <div class="ccm-stats gap-2 items-stretch justify-center flex-grow flex">
                  <div class="text-center border border-light/50 rounded-lg p-2 flex-1 flex flex-col justify-between">
                    <div class="scoring">
											<div class="uppercase font-medium font-heading">CCM</div>
											<div class="ccm-score font-heading">0</div>
										</div>
                    <div class="text-xs font-heading">Wertung der Gewaltmarker im Text</div>
                  </div>
                  <div class="text-center border border-light/50 rounded-lg p-2 flex-1 flex flex-col justify-between">
										<div class="scoring">
											<div class="uppercase font-medium font-heading">nCCM</div>
											<div class="nccm-score font-heading">0</div>
										</div>
                    <div class="text-xs font-heading">Berechnete normalisierte Gewaltbewertung</div>
                  </div>
                  <div class="text-center border border-light/50 rounded-lg p-2 flex-1 flex flex-col justify-between">
										<div class="scoring">
											<div class="uppercase font-medium font-heading">Confidence</div>
											<div class="confidence-score font-heading">0</div>
										</div>
                    <div class="text-xs font-heading">Anzunehmende Zuverläßlichkeit der Bewertung</div>
                  </div>
                </div>

								<ul class="ccm-tokens flex flex-wrap gap-2 text-xs items-center justify-center font-heading py-2">
                  <li class="ccm-template hidden flex-col w-fit">
                    <span class="border-b-[2px] border-grey whitespace-nowrap text-center">{term}</span>
                    <span class="items-center p-1 gap-2 text-xs hidden whitespace-nowrap [.ccm-tokens.ccm-loaded_&]:flex">
                      <span class="uppercase underline">{tag}</span>
                      <span class="uppercase">{score}</span>
                    </span> 
                  </li>
                </ul>

                <div class="ccm-commment py-2 text-center border-t border-light/50">
                  <p class="ccm-comment-text font-heading">
                    —
                  </p>
                </div>
    
	
                
              </div>

            </div>
          </div>
        </div>
      </div>
    </section>  

    <?php include 'views/footer.php'; ?>

	<script src="js/ccm.js"></script>

  </body>
</html>