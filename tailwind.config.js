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
        title: ['rfs(14px)', {
          lineHeight: '1.1',
          fontWeight: '700',
        }],
        sm: ['rfs(12px)', {
          lineHeight: '1.2',
        }],
        md: ['rfs(16px)', {
          lineHeight: '1.2',
        }],
        lg: ['rfs(20px)', {
          lineHeight: '1.2',
        }],
        xl: ['rfs(32px)', {
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
			keyframes: {
				'caret-float': {
					'0%, 100%': {
						transform: 'translateY(0)',
						opacity: '0.85',
					},
					'50%': {
						transform: 'translateY(8px)',
						opacity: '1',
					},
				},
			},
			animation: {
				'caret-float': 'caret-float 1.8s ease-in-out infinite',
			},
    },
    bgSvg: {
      'menu': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><line x1="40" y1="128" x2="216" y2="128" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="40" y1="64" x2="216" y2="64" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="40" y1="192" x2="216" y2="192" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>',
      'menu-close': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><line x1="200" y1="56" x2="56" y2="200" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><line x1="200" y1="200" x2="56" y2="56" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>',
      'caret-double-down': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="208 136 128 216 48 136" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="208 56 128 136 48 56" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>',

      'icon-printer': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="64 80 64 40 192 40 192 80" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="64" y="152" width="128" height="64" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M64,176H24V96c0-8.84,7.76-16,17.33-16H214.67C224.24,80,232,87.16,232,96v80H192" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="188" cy="116" r="12"/></svg>',
      'icon-photo': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M208,208H48a16,16,0,0,1-16-16V80A16,16,0,0,1,48,64H80L96,40h64l16,24h32a16,16,0,0,1,16,16V192A16,16,0,0,1,208,208Z" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="128" cy="132" r="36" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>',
      'icon-video': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="24" y="64" width="176" height="128" rx="8" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="200 112 248 80 248 176 200 144" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>',
    },
  },
  plugins: [
    require('./packages/functions/bg-svg'),
  ],
};
