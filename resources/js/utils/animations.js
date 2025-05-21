const animations = {
  keyframes: {
    navBarClickedLine1: {
      '50%': {
        margin: '0 0 -2px 0',
        transform: 'rotate(0)',
      },
      '100%': {
        margin: '0 0 -2px 0',
        transform: 'rotate(50deg) scale(1.3)',
      },
    },
    navBarClickedLine2: {
      '50%': {
        margin: '-2px 0 0 0',
        transform: 'rotate(0)',
      },
      '100%': {
        margin: '-2px 0 0 0',
        transform: 'rotate(-50deg) scale(1.3)',
      },
    },
    navBarClosingLine1: {
      '0%': {
        margin: '0 0 -2px 0',
        transform: 'rotate(50deg) scale(1.3)',
      },
      '50%': {
        margin: '0 0 -2px 0',
        transform: 'rotate(0)',
      },
      '100%': {
        transform: 'rotate(0)',
        margin: '0',
        marginTop: '-5px',
      },
    },
    navBarClosingLine2: {
      '0%': {
        margin: '-2px 0 0 0',
        transform: 'rotate(-50deg) scale(1.3)',
      },
      '50%': {
        margin: '-2px 0 0 0',
        transform: 'rotate(0)',
      },
      '100%': {
        margin: '0',
        marginLeft: '10px',
        marginTop: '5px',
        transform: 'rotate(0)',
      },
    },
    navBarHide: {
      from: {
        height: 'calc(100vh - 50px)',
        width: '200px',
        right: '0',
      },
      to: {
        height: '0vh',
        width: '0',
        right: '-20em',
      },
    },
    navBarShow: {
      from: {
        height: '0',
        width: '0',
        right: '-20em',
      },
      to: {
        height: 'calc(100vh - 50px)',
        width: '200px',
        right: '0',
      },
    },
    line: {
      from: {
        strokeDashoffset: '250',
      },
      to: {
        strokeDashoffset: '0',
      },
    },
  },

  animation: {
    navBarClickedLine1: 'navBarClickedLine1 0.4s ease forwards',
    navBarClickedLine2: 'navBarClickedLine2 0.4s ease forwards',
    navBarClosingLine1: 'navBarClosingLine1 0.4s ease forwards',
    navBarClosingLine2: 'navBarClosingLine2 0.4s ease forwards',
    navBarHide: 'navBarHide 0.6s ease forwards',
    navBarShow: 'navBarShow 0.6s ease forwards',
    line: 'line 2s ease forwards',
  },

  toggleMenuAnimations(menuElement, line1, line2, isMenuOpen) {
    if (isMenuOpen) {
      menuElement.classList.remove('hidden');
      menuElement.classList.remove('animate-navBarHide');
      menuElement.classList.add('animate-navBarShow');
      line1.classList.remove('animate-navBarClosingLine1');
      line2.classList.remove('animate-navBarClosingLine2');
      line1.classList.add('animate-navBarClickedLine1');
      line2.classList.add('animate-navBarClickedLine2');
    } else {
      menuElement.classList.remove('animate-navBarShow');
      menuElement.classList.add('animate-navBarHide');
      line1.classList.remove('animate-navBarClickedLine1');
      line2.classList.remove('animate-navBarClickedLine2');
      line1.classList.add('animate-navBarClosingLine1');
      line2.classList.add('animate-navBarClosingLine2');

      setTimeout(() => {
        menuElement.classList.add('hidden');
      }, 600);
    }
  },

  resetMenuAnimations(menuElement, line1, line2) {
    menuElement.classList.remove('animate-navBarShow', 'animate-navBarHide');
    line1.classList.remove('animate-navBarClickedLine1', 'animate-navBarClosingLine1');
    line2.classList.remove('animate-navBarClickedLine2', 'animate-navBarClosingLine2');
  },
};

export default animations;
