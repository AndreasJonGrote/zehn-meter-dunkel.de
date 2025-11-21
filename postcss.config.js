const rfs = require('rfs');
const tailwindcss = require('tailwindcss');

module.exports = {
  plugins: [
    tailwindcss(),
    rfs({
      baseValue: '1rem',
      breakpoint: 1280,
    }),
  ],
};
