/* eslint-disable max-len */
/* eslint-disable import/no-extraneous-dependencies */

const flattenColorPalette = require('tailwindcss/lib/util/flattenColorPalette');
const plugin = require('tailwindcss/plugin');

const bgSvg = plugin(
  ({ e, addUtilities, theme }) => {
    const values = theme('bgSvg');
    const colors = flattenColorPalette.default(theme('colors'));

    addUtilities([
      ...Object.entries(colors).map(([modifier, value]) => Object.entries(values).map(([svgName, svg]) => {
        const svg64 = encodeURIComponent(svg.replace(/svgcolor/g, value));
        return {
          [`.${e(`bg-svg-${svgName}-${modifier}`)}`]: {
            'background-image': `url("data:image/svg+xml,${svg64}")`,
          },
        };
      })).flat(),
    ]);
  },
);

module.exports = bgSvg;
