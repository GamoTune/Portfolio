<script setup lang="ts">
import { ref } from "vue"
import { useRouter } from "vue-router"
import { useI18n } from "vue-i18n"
import { Button, Icon, PageBackground, SiteHeader } from "@gamo/ds"
import AppSidebar from "./components/AppSidebar.vue"
import HexNav from "./components/HexNav.vue"
import { setLocale } from "./i18n"
import { routeOf } from "./content/nodes"
import type { HexNode } from "./content/types"

const { t, locale } = useI18n()
const router = useRouter()

/** Carte hexagonale, ouverte depuis le pied de la sidebar. */
const mapOpen = ref(false)
/** Tiroir de la sidebar, sous le point de rupture `md`. */
const drawerOpen = ref(false)

function toggleLocale() {
  setLocale(locale.value === "fr" ? "en" : "fr")
}

function onNavigate(node: HexNode) {
  mapOpen.value = false
  void router.push(routeOf(node))
}
</script>

<template>
  <PageBackground />

  <!-- L'en-tête du DS est en `position: relative` : c'est au site de décider s'il
       reste au-dessus. Il le faut ici, la sidebar se collant juste en dessous. -->
  <div class="shell__header">
    <SiteHeader name="gamo" prefix="portfolio" accent="lav">
      <template #tagline>{{ t("site.role") }}</template>
      <template #right>
        <Button
          class="shell__menu"
          variant="lav"
          ghost
          size="icon"
          :aria-label="t('nav.menu')"
          @click="drawerOpen = true"
        >
          <Icon name="menu" />
        </Button>
        <Button variant="lav" ghost size="sm" @click="toggleLocale">
          {{ locale === "fr" ? "EN" : "FR" }}
        </Button>
      </template>
    </SiteHeader>
  </div>

  <div class="shell">
    <div class="shell__aside">
      <AppSidebar v-model:open="drawerOpen" @open-map="mapOpen = true" />
    </div>

    <main class="shell__main">
      <RouterView v-slot="{ Component }">
        <component :is="Component" />
      </RouterView>
    </main>
  </div>

  <HexNav :open="mapOpen" @navigate="onNavigate" @close="mapOpen = false" />
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;
@use "@gamo/ds/scss/mixins" as m;

$header-h: 96px;

.shell__header {
  position: sticky;
  top: 0;
  z-index: var(--z-header);
}

.shell {
  display: flex;
  align-items: stretch;
  min-height: calc(100vh - #{$header-h});
}

// La sidebar du DS est en `height: 100%` : c'est au conteneur de décider si elle
// suit le défilement. On la colle sous l'en-tête, qui est lui-même collé en haut.
.shell__aside {
  position: sticky;
  top: $header-h;
  align-self: flex-start;
  height: calc(100vh - #{$header-h});

  @include m.below(md) {
    position: static;
    height: auto;
  }
}

.shell__main {
  flex: 1;
  // Sans cela, une grille ou un tableau trop large étirerait le conteneur flex
  // au lieu de défiler dans sa propre boîte.
  min-width: 0;
}

// Le bouton d'ouverture du tiroir n'a de sens que là où la sidebar est masquée.
.shell__menu {
  display: none;

  @include m.below(md) {
    display: inline-flex;
  }
}
</style>
