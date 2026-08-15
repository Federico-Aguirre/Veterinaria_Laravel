import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.min.css";
import "flatpickr/dist/flatpickr.min.css";
import { Spanish } from "flatpickr/dist/l10n/es.js";
flatpickr.localize(Spanish); // Habilitar la traducción en español por defecto

import '../tailwind/main.scss';
import './variablesGlobales';
import './agregar_al_carro';
import './calendario';
import './header';
import './borrar_perfil';
import './eliminar_del_carro';

import Alpine from 'alpinejs';
if (!window.Alpine) {
    window.Alpine = Alpine;
    Alpine.start();
}