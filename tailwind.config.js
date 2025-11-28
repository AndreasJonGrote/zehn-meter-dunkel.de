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

      'zmd-logo': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 132.107 83.506"><defs><clipPath id="a"><path fill="none" d="M0 83.506h132.107V0H0Z" data-name="Pfad 3"/></clipPath></defs><g data-name="Gruppe 6"><g clip-path="url(#a)" data-name="Gruppe 4"><g data-name="Gruppe 2"><path fill="svgcolor" d="M0 83.172h6.851c3.957 0 7.034-1.2 9.086-3.264s3.187-5.029 3.187-8.793-1.136-6.728-3.187-8.793-5.129-3.264-9.086-3.264H0Zm5.789-4.563V63.622h.989a6.1 6.1 0 0 1 4.836 2 8.26 8.26 0 0 1 1.685 5.5 8.26 8.26 0 0 1-1.685 5.5 6.1 6.1 0 0 1-4.836 2Zm16.925-19.55v15.953a8.33 8.33 0 0 0 2.052 5.895 9.6 9.6 0 0 0 7.071 2.6 9.6 9.6 0 0 0 7.071-2.6 8.3 8.3 0 0 0 2.052-5.862V59.059h-5.68v16.12a3.93 3.93 0 0 1-.733 2.564 3.3 3.3 0 0 1-2.638 1.066 3.34 3.34 0 0 1-2.675-1.066 3.92 3.92 0 0 1-.7-2.564v-16.12Zm22.714 24.113h5.239V68.851l8.756 14.321h4.25V59.059h-5.24v13.389l-8.206-13.389h-4.8Zm22.933 0h5.825V71.349l7.254 11.823h6.668l-8.06-12.556 7.693-11.557h-6.447l-7.108 11.124V59.059h-5.825Zm23.74 0h16.742v-4.563h-10.99V73.08h9.747v-4.4h-9.747v-5.062H108.7v-4.563H92.1Zm22.787-24.113v24.113h17.219v-4.563h-11.394v-19.55Z" data-name="Pfad 1"/></g><g data-name="Gruppe 3"><path fill="svgcolor" d="M0 53.618h5.129V39.064l3.957 7.527 3.957-7.527v14.554h5.422V29.505h-4.873l-4.323 8.593-4.36-8.593H0Zm24.069 0h16.743v-4.563H29.821v-5.529h9.745v-4.4h-9.745v-5.062h10.844v-4.563h-16.6Zm27.66-19.55v19.55h5.825v-19.55h6.961v-4.563H44.768v4.563ZM69.5 53.618h16.74v-4.563H75.249v-5.529h9.745v-4.4h-9.745v-5.062h10.844v-4.563H69.5Zm35.1 0h6.375l-6.192-10.225a6.83 6.83 0 0 0 4.36-6.461 6.69 6.69 0 0 0-3.077-5.8 12.23 12.23 0 0 0-6.924-1.632h-8.06v24.113h5.788v-9.159h2.345Zm-7.73-19.717h1.83a6.17 6.17 0 0 1 3.334.666 2.89 2.89 0 0 1 1.282 2.531 2.87 2.87 0 0 1-1.282 2.5 6.17 6.17 0 0 1-3.334.666h-1.837Z" data-name="Pfad 2"/></g></g><g data-name="Gruppe 5"><path fill="svgcolor" d="M81.916 0v13.388L73.71 0h-4.8v24.113h5.239V9.792l8.756 14.321h4.25V0Zm-23.3 0v9.525h-6.594V0h-5.825v24.113h5.825v-9.992h6.594v9.991h5.825V0ZM24.728 0v24.113H41.47V19.55H30.479v-5.528h9.745v-4.4h-9.745V4.563h10.844V0ZM.805 0v4.563H10.99L-.001 24.047v.067h19.38V19.55H8.718L19.71.066V0Z" data-name="Pfad 4"/></g></g></svg>',      

      'icon-printer': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><polyline points="64 80 64 40 192 40 192 80" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><rect x="64" y="152" width="128" height="64" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><path d="M64,176H24V96c0-8.84,7.76-16,17.33-16H214.67C224.24,80,232,87.16,232,96v80H192" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="188" cy="116" r="12"/></svg>',
      'icon-photo': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><path d="M208,208H48a16,16,0,0,1-16-16V80A16,16,0,0,1,48,64H80L96,40h64l16,24h32a16,16,0,0,1,16,16V192A16,16,0,0,1,208,208Z" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><circle cx="128" cy="132" r="36" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>',
      'icon-video': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><rect width="256" height="256" fill="none"/><rect x="24" y="64" width="176" height="128" rx="8" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/><polyline points="200 112 248 80 248 176 200 144" fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16"/></svg>',
    },
  },
  plugins: [
    require('./packages/functions/bg-svg'),
  ],
};
