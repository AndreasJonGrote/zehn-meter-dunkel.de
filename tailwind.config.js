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
      fontFamily: {
        heading: ['Fira Sans', 'sans-serif'],
        body: ['Cormorant Garamond', 'serif'],
        title: ['Inter', 'sans-serif'],
      },
      fontSize: {
        sm: ['rfs(18px)', {
          lineHeight: '1.5',
        }],
        md: ['rfs(18px)', {
          lineHeight: '1.5',
        }],
        lg: ['rfs(18px)', {
          lineHeight: '1.5',
        }],
        clamp: [clamp('48px', '400px', '1280px', '62px'), {
          lineHeight: '1.156',
          fontWeight: '800',
          letterSpacing: '-0.13px',
        }],
      },
      colors: {
        dark: '#000000',
        light: '#FFFFFF',
      },
    },
    bgSvg: {
      icon: '',
    },
  },
  plugins: [
    require('./packages/functions/bg-svg'),
  ],
};
