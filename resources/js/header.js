import { $q } from './variablesGlobales';
import animations from './utils/animations.js';

const navBar = $q('.header__navBar');
const navMenu = $q('.navBarMenu');
const navLine1 = $q('.header__navBar__line:nth-of-type(1)');
const navLine2 = $q('.header__navBar__line:nth-of-type(2)');

let isAnimating = false;
let isMenuOpen = false;

if (!navBar || !navMenu || !navLine1 || !navLine2) {
  console.warn('Faltan elementos necesarios para el menú');
} else {
  navBar.addEventListener('click', () => {
    if (isAnimating) return;
    isAnimating = true;

    // Resetear animaciones previas
    animations.resetMenuAnimations(navMenu, navLine1, navLine2);

    if (!isMenuOpen) {
      // Abrir menú
      navMenu.classList.remove('hidden');
      animations.toggleMenuAnimations(navMenu, navLine1, navLine2, true);
    } else {
      // Cerrar menú
      animations.toggleMenuAnimations(navMenu, navLine1, navLine2, false);

      // Ocultar visualmente tras animación
      setTimeout(() => {
        navMenu.classList.add('hidden');
      }, 600);
    }

    // Alternar estados después de la animación
    setTimeout(() => {
      isAnimating = false;
      isMenuOpen = !isMenuOpen;
    }, 600); // Coincide con duración en animations.js
  });
}
