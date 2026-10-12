<script setup lang="ts">
import { computed } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useI18n } from "vue-i18n"
import { Button, Icon } from "@gamo/ds"

/**
 * Gabarit commun à toutes les pages : une largeur maximale, un rembourrage qui
 * se resserre sous `md`, et un retour à l'accueil sur toutes les pages sauf
 * l'accueil lui-même.
 *
 * Ce n'est **pas** un `<main>` : l'application n'en a qu'un, dans `App.vue`.
 */
const { t } = useI18n()
const route = useRoute()
const router = useRouter()

const isHome = computed(() => route.path === "/")
</script>

<template>
  <div class="page">
    <!-- La sidebar rend ce retour redondant sur grand écran, mais elle devient un
         tiroir sous `md` : le bouton reste alors le seul chemin visible. -->
    <Button
      v-if="!isHome"
      class="page__back"
      variant="lav"
      ghost
      size="sm"
      @click="router.push('/')"
    >
      <Icon name="chevron-left" size="sm" />
      {{ t("ui.backHome") }}
    </Button>

    <slot />
  </div>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;
@use "@gamo/ds/scss/mixins" as m;

.page {
  max-width: 1180px;
  margin: 0 auto;
  padding: t.space(s12) t.space(s12) t.space(s12) * 2;

  @include m.below(md) {
    padding: t.space(s6) t.space(s4) t.space(s12);
  }
}

.page__back {
  margin-bottom: t.space(s6);
}
</style>
