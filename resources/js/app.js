import "../css/app.css";
import "primeicons/primeicons.css";
import Layout from "./Shared/Layout/Layout.vue";

import { createApp, h } from "vue";
import { createInertiaApp, Link } from "@inertiajs/vue3";
import FlashMessage from "./Shared/FlashMessage.vue";
import Heading from "./Shared/Heading.vue";

createInertiaApp({
    resolve: (name) => {
        const pages = import.meta.glob("./Pages/**/*.vue", { eager: true });
        let page = pages[`./Pages/${name}.vue`];
        if (page.default.layout === undefined) {
            page.default.layout = Layout;
        }
        return page;
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link", Link)
            .component("FlashMessage", FlashMessage)
            .component("Heading", Heading)
            .mount(el);
    },
});
