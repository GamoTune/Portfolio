<script setup lang="ts">
import { computed } from "vue"
import { useRoute, useRouter } from "vue-router"
import { useI18n } from "vue-i18n"
import { Avatar, Icon, Sidebar, SidebarItem, SidebarSection } from "@gamo/ds"
import { EXPES, NAV_SECTIONS, NODES, PROJETS, routeOf } from "@/content/nodes"
import type { HexNode } from "@/content/types"

/**
 * Navigation latérale.
 *
 * La carte hexagonale reste la signature du site, mais elle demande un geste et
 * masque la page : elle devient donc une **option**, dans le pied du panneau,
 * tandis que la sidebar porte la navigation ordinaire.
 *
 * L'entrée courante est déduite de la route et non d'un état local, sinon un
 * retour arrière du navigateur ou un lien profond laisserait la sidebar
 * désynchronisée de la page affichée.
 */
const props = defineProps<{ open: boolean }>()
const emit = defineEmits<{ "update:open": [boolean]; openMap: [] }>()

const { t } = useI18n()
const route = useRoute()
const router = useRouter()

const active = computed(() => {
  const match = NODES.find((n) => routeOf(n) === route.path)
  return match?.id ?? null
})

function go(node: HexNode) {
  void router.push(routeOf(node))
  // Sur petit écran le panneau est un tiroir : le laisser ouvert masquerait la
  // page vers laquelle on vient de naviguer.
  emit("update:open", false)
}

function openMap() {
  emit("update:open", false)
  emit("openMap")
}

const drawerOpen = computed({
  get: () => props.open,
  set: (v: boolean) => emit("update:open", v),
})
</script>

<template>
  <Sidebar
    v-model:open="drawerOpen"
    :active="active"
    accent="lav"
    :aria-label="t('nav.sidebar')"
  >
    <template #header>
      <Avatar size="sm" variant="lav" initials="AL" />
    </template>

    <SidebarSection :label="t('nav.sections')">
      <SidebarItem
        v-for="n in NAV_SECTIONS"
        :key="n.id"
        :value="n.id"
        @click="go(n)"
      >
        <template #icon><Icon :name="n.icon" size="sm" /></template>
        {{ t(`nodes.${n.id}.lbl`) }}
      </SidebarItem>
    </SidebarSection>

    <SidebarSection :label="t('nav.projects')">
      <SidebarItem v-for="n in PROJETS" :key="n.id" :value="n.id" @click="go(n)">
        <template #icon><Icon :name="n.icon" size="sm" /></template>
        {{ t(`projects.${n.id}.title`) }}
      </SidebarItem>
    </SidebarSection>

    <SidebarSection :label="t('nav.expes')">
      <SidebarItem v-for="n in EXPES" :key="n.id" :value="n.id" @click="go(n)">
        <template #icon><Icon :name="n.icon" size="sm" /></template>
        {{ t(`projects.${n.id}.title`) }}
      </SidebarItem>
    </SidebarSection>

    <template #footer>
      <SidebarItem value="__map" @click="openMap">
        <template #icon><Icon name="grid" size="sm" /></template>
        {{ t("nav.map") }}
      </SidebarItem>
    </template>
  </Sidebar>
</template>
