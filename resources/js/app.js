import { createApp, h } from 'vue';
import { Link, createInertiaApp, Head } from '@inertiajs/vue3';

createInertiaApp({
  resolve: name => {
    // const pages = import.meta.glob('./Pages/**/*.vue', { eager: true }) // Without codeSplitting
    // return pages[`./Pages/${name}.vue`] // Without codeSplitting
    const pages = import.meta.glob('./Pages/**/*.vue');
    return pages[`./Pages/${name}.vue`]();
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('Link', Link) // Global component
      .component('Head', Head) // Global component
      .mount(el)
  },
  progress: {
    delay: 250,
    color: '#000000',
    includeCSS: true,
    showSpinner: true,
  },
  title: title => `My App - ${title}`
})