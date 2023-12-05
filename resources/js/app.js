import './bootstrap';
import Alpine from 'alpinejs';

const pathName = location.pathname;

if (pathName == '/') {
    import('./views/menu');
} else if (pathName == '/confirm') {
    import('./views/cfm');
} else if (pathName == '/categories') {
    import('./views/genre');
}

window.Alpine = Alpine;

Alpine.start();
