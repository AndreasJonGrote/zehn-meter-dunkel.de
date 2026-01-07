<form class="relative ccm-search-form bg-paper p-1 rounded-lg flex gap-1">
  <input type="text" id="ccm-search" placeholder="Gib einen Text ein…" class="flex-1 py-3 px-4 bg-paper text-dark text-lg rounded-lg placeholder:text-grey/80">
  <button type="button" class="flex-shrink-0 py-3 px-4 border bg-grey rounded-lg">
    <span class="bg-svg-icon-shuffle-light w-[24px] h-[24px] block"></span>
  </button>
</form>
<div class="h-0 overflow-hidden transition-all duration-1000 ease-in-out">
  <div class="ccm-stats-wrapper text-light p-2 mt-2 bg-grey rounded-lg">
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