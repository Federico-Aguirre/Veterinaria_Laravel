const animations = require('./resources/js/utils/animations.js');

module.exports = {
  content: [
    './resources/**/*.blade.php',
    './resources/js/**/*.js',
    './resources/tailwind/**/*.scss',
  ],
  theme: {
    extend: {
      animation: animations.animation,
      keyframes: animations.keyframes,

      screens: {
        'custom': '1350px',
      },
      colors: {
        white: 'hsl(0, 0%, 100%)',
        black: 'hsl(0, 0%, 0%)',
        green: 'hsl(171, 83%, 40%)',
        skyBlue: 'hsl(194, 85%, 62%)',
        red: 'hsl(333, 93%, 40%)',
        gray: 'hsl(0, 0%, 95%)',
        colorFormulario: 'hsla(206, 42%, 13%, 0.9)',
      },
      fontFamily: {
        custom: ['sans-serif', 'serif', '"Times New Roman"', 'Times'],
      },
      fontSize: {
        normal: '1em',
        big: '1.3em',
        bigger: '3em',
      },
      boxShadow: {
        shadow: '6px 6px 20px 3px hsl(171, 83%, 40%)',
        lightShadow: '0 0 2em 0.5em hsl(171, 83%, 40%)',
      },
      transitionTimingFunction: {
        easein: 'ease-in',
      },
    },
  },
  plugins: [],
}
