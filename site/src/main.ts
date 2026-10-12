import { createApp } from "vue"

// Pose les custom properties `:root` du design system. Sans cet import, tous les
// `var(--…)` des composants seraient vides.
import "@gamo/ds/style.css"
import "./styles/global.scss"

import App from "./App.vue"
import { router } from "./router"
import { i18n } from "./i18n"

createApp(App).use(router).use(i18n).mount("#app")
