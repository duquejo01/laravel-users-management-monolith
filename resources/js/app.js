import { createApp, h } from "vue";
import { createInertiaApp, Head } from "@inertiajs/vue3";
import { createPinia } from "pinia";
import Layout from "./Layout/BaseLayout.vue";

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });

    let page = pages[`./Pages/${name}.vue`];
    page.default.layout = page.default.layout || Layout;

    return page;
  },
  setup: ({ el, App, props, plugin }) => {
    
    const app = createApp({ render: () => h(App, props) });
    const pinia = createPinia();

    app.use(plugin)
      .use(pinia)
      .component("Head", Head) // Global component
      .mount(el);

    return app;
  },
  progress: {
    delay: 250,
    color: "#000000",
    includeCSS: true,
    showSpinner: true,
  },
  title: (title) => `Users management GUI - ${title}`,
});
