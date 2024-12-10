import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp, Head, Link } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
<<<<<<< HEAD
import 'boxicons/css/boxicons.min.css';

=======
>>>>>>> bf6d9dd0450b9804df6ab0da319b464c95b19409

createInertiaApp({
    title: (title) => `${title} - System Management`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('Head', Head)
            .component('Link', Link)
            .mount(el);
    },
    progress: {
        color: '#fff',
        includeCSS: true,
    },
});
