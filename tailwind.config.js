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
    './library/**/*.{php,twig}',
    './views/**/*.{php,twig}',
    './css/*.css',
    './js/**/*.{js,ts}',
    './safelist.txt',
    './ausstellung/**/*.{html,php}',
    './analytics/**/*.php',
  ],
  theme: {
    extend: {
      fontFamily: {
        heading: ['Noway', 'sans-serif'],
        body: ['Cormorant', 'serif'],
        italic: ['Cormorant', 'serif'],
      },
      fontSize: {
        sm: [
          clamp('14px', '400px', '1024px', '18px'),
          { lineHeight: '1.35' }
        ],
        md: [
          clamp('18px', '400px', '1024px', '22px'),
          { lineHeight: '1.35' }
        ],
        lg: [
          clamp('22px', '400px', '1024px', '26px'),
          { lineHeight: '1.35' }
        ],
        xl: [
          clamp('26px', '400px', '1024px', '32px'),
          { lineHeight: '1.25' }
        ],
        '2xl': [
          clamp('30px', '400px', '1024px', '46px'),
          { lineHeight: '1.25' }
        ]
      },
			colors: {
				dark: '#050505',
        grey: '#262522',
				light: '#fbfbf8',
        paper: '#e1d6cd',
        stone: '#686563'
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

      'icon-arrow': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><defs><clipPath id="a"><path fill="none" d="M0 11.785h18V0H0Z" data-name="Pfad 6"/></clipPath></defs><g data-name="Gruppe 10"><path fill="none" d="M0 0h24v24H0z" data-name="Rechteck 2"/><g data-name="Gruppe 9"><g clip-path="url(#a)" data-name="Gruppe 8" transform="translate(3 6)"><g data-name="Gruppe 7"><path fill="svgcolor" d="M10.791.068c-.072.072-.1.126-.076.168l4.572 5.67-4.572 5.638a.14.14 0 0 0 .046.2.21.21 0 0 0 .229.015l6.888-5.642a.248.248 0 0 0 0-.427L10.989.022q-.09-.063-.2.046m6.053 6.449q.09 0 .122-.32a3.4 3.4 0 0 0 0-.625q-.03-.3-.122-.3H.107q-.063 0-.091.3a3.4 3.4 0 0 0 0 .625q.03.32.122.32Z" data-name="Pfad 5"/></g></g></g></g></svg>',
      'icon-shuffle': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path fill="none" d="M0 0h256v256H0z"/><path fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M32 72h23.06a64 64 0 0 1 52.08 26.8l41.72 58.4a64 64 0 0 0 52.08 26.8H232M208 48l24 24-24 24"/><path fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="m208 160 24 24-24 24M147.66 100.47l1.2-1.67A64 64 0 0 1 200.94 72H232M32 184h23.06a64 64 0 0 0 52.08-26.8l1.2-1.67"/></svg>',
      'icon-arrow-up': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path fill="none" d="M0 0h256v256H0z"/><path fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M128 224V72M56 144l72-72 72 72M40 40h176"/></svg>',
      'icon-arrow-right': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256"><path fill="none" d="M0 0h256v256H0z"/><path fill="none" stroke="svgcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="16" d="M40 128h176M144 56l72 72-72 72"/></svg>',
      'z': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.374 16.652"><path d="M12.167 16.652v-3.151H5.474l6.9-13.455V0H.51v3.152H6.9L0 16.606v.046Z" data-name="Pfad 5"/></svg>',
      'm': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 11.592 16.652"><path d="M-.004 16.652h3.22V6.601l2.484 5.2 2.484-5.2v10.051h3.4V0H8.533L5.819 5.934 3.082 0H-.004Z" data-name="Pfad 6"/></svg>',
      'd': '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12.006 16.652"><path d="M0 16.652h4.3a7.4 7.4 0 0 0 5.7-2.254 8.8 8.8 0 0 0 2-6.072 8.8 8.8 0 0 0-2-6.072A7.4 7.4 0 0 0 4.3 0H0Zm3.634-3.151V3.152h.621a3.68 3.68 0 0 1 3.036 1.38 6.1 6.1 0 0 1 1.058 3.8 6.1 6.1 0 0 1-1.058 3.8 3.68 3.68 0 0 1-3.036 1.38Z" data-name="Pfad 7"/></svg>',
    },
  },
  plugins: [
    require('./packages/functions/bg-svg'),
  ],
};
