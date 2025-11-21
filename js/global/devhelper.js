/**
 * Development helpers
 * @param {Boolean} breakpoint Enable of disable the breakpoint indicator. `Default: false`
 * @param {Object} grid
 * @param {Boolean} grid.enable Enable or disable the grid layout overlay `Default: false`
 * @param {Boolean} grid.onload Hide or show in on load `Default: false`
 * @param {Number} grid.opacity Layout opacity `Default: 10`
 */
function devHelpers(breakpoint, grid) {
  const BREAKPOINT = breakpoint || false;
  const GRID = grid.enable || false;

  if (BREAKPOINT || GRID) {
    const container = document.createElement('div');
    container.className = 'flex fixed top-[var(--wp-admin--admin-bar--height,_0px)] right-0 z-50 flex-row items-center text-sm bg-black border border-white divide-x dev-helpers';
    document.getElementsByTagName('body')[0].prepend(container);

    if (BREAKPOINT) {
      const indicator = document.createElement('div');
      indicator.className = 'px-2 py-0.5 text-white z-50 before:content-["Mobile"] sm:before:content-["SM"] md:before:content-["MD"] lg:before:content-["LG"] xl:before:content-["XL"] 2xl:before:content-["2XL"]';
      container.prepend(indicator);
    }

    if (GRID) {
      const button = document.createElement('button');
      button.className = 'z-50 px-2 py-0.5 text-white toggle-grid';
      button.innerHTML = 'Grid';
      const gridLayout = document.createElement('div');
      gridLayout.className = `${grid.onload ? '' : 'hidden'} container-fluid fixed !border-0 inset-0 z-50 mx-auto pointer-events-none grid-helper opacity-10`;
      gridLayout.innerHTML = `
        <div class="grid grid-cols-12 gap-5 h-full">
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
          <div class="grid-cols-1 bg-[#ff0000]"></div>
        </div>
      `;
      container.appendChild(button);
      container.appendChild(gridLayout);

      document.querySelector('.toggle-grid').addEventListener('click', () => {
        document.querySelector('.grid-helper').classList.toggle('hidden');
      });

      document.addEventListener('keydown', (event) => {
        if (event.ctrlKey && event.key === 'l') {
          document.querySelector('.grid-helper').classList.toggle('hidden');
        }
      });
    }
  }
}

export default devHelpers;
