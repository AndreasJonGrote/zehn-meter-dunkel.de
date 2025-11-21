/* eslint-disable array-element-newline */
/* eslint-disable import/no-extraneous-dependencies */
/* eslint-disable global-require */

const plugin = require('tailwindcss/plugin');
const clamp = require('./packages/functions/clamp');
const bgSvgIcons = require('./packages/ui/bg-svg-icons');

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    './*.{html,php}',
    './static/**/*.{html,php}',
    './templates/**/*.{php,twig}',
    './css/*.css',
    './js/**/*.{js,ts}',
    './safelist.txt',
  ],
  theme: {
    extend: {
      screens: {
        '2xl': '1500px',
      },
      fontSize: {
        h1: [clamp('48px', '400px', '1280px', '62px'), {
          lineHeight: '1.156',
          fontWeight: '800',
          letterSpacing: '-0.13px',
        }],
        lg: ['rfs(18px)', {
          lineHeight: '1.5',
        }],
      },
      colors: {
        bg: 'var(--cal-bg)',
      },
    },
    bgSvg: {
      ...bgSvgIcons,
    },
  },
  plugins: [
    require('./packages/functions/bg-svg'),
  ],
};
