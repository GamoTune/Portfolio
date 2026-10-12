import { createRouter, createWebHistory, type RouteRecordRaw } from "vue-router"

/**
 * La carte hexagonale gouverne le plan du site : un nœud mène à une page, et
 * chaque page a donc une URL partageable. L'ancien site PHP avait déjà des URLs
 * (`?cat=projects`) — s'en passer serait une régression.
 */
const routes: RouteRecordRaw[] = [
  { path: "/", name: "hub", component: () => import("./pages/HubPage.vue") },
  { path: "/projet/:id", name: "projet", component: () => import("./pages/ProjetPage.vue"), props: true },
  { path: "/stack", name: "stack", component: () => import("./pages/StackPage.vue") },
  { path: "/parcours", name: "parcours", component: () => import("./pages/ParcoursPage.vue") },
  { path: "/a-propos", name: "about", component: () => import("./pages/AboutPage.vue") },
  { path: "/contact", name: "contact", component: () => import("./pages/ContactPage.vue") },
  { path: "/:pathMatch(.*)*", name: "404", component: () => import("./pages/NotFoundPage.vue") },
]

export const router = createRouter({
  history: createWebHistory(),
  routes,
  // Revenir en haut à chaque page — sauf quand le navigateur restaure une position,
  // ou quand l'URL vise une ancre : sans ce cas, le bouton « Voir les projets »
  // changerait l'URL puis annulerait aussitôt son propre défilement.
  scrollBehavior: (to, _from, saved) => {
    if (saved) return saved
    if (to.hash) return { el: to.hash, behavior: "smooth" }
    return { top: 0 }
  },
})
