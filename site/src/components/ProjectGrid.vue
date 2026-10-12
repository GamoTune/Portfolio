<script setup lang="ts">
import { useRouter } from "vue-router"
import { useI18n } from "vue-i18n"
import { Badge, Icon, ProjectCard } from "@gamo/ds"
import AppPicture from "./AppPicture.vue"
import { card } from "@/content/images"
import { routeOf } from "@/content/nodes"
import type { HexNode } from "@/content/types"

/** Grille de projets. Un seul rendu : `ProjectCard` du design system. */
defineProps<{ nodes: HexNode[] }>()

const { t } = useI18n()
const router = useRouter()

/** `lycee` → `ui.contextLycee`. */
const CONTEXT_KEY = { lycee: "contextLycee", iut: "contextIut", perso: "contextPerso" } as const

function open(node: HexNode) {
  void router.push(routeOf(node))
}
</script>

<template>
  <div class="grid">
    <ProjectCard
      v-for="n in nodes"
      :key="n.id"
      :accent="n.accent"
      :title="t(`projects.${n.id}.title`)"
      :year="n.year"
      interactive
      @click="open(n)"
    >
      <template #image>
        <AppPicture
          v-if="n.image && card(n.image)"
          :picture="card(n.image)!"
          :alt="t(`projects.${n.id}.title`)"
          sizes="80px"
        />
        <Icon v-else class="grid__glyph" :name="n.icon" size="lg" />
      </template>

      {{ t(`nodes.${n.id}.desc`) }}

      <template #tags>
        <Badge v-for="tech in n.tech" :key="tech" variant="muted">{{ tech }}</Badge>
      </template>

      <!-- Le cadre de réalisation : lycée, IUT ou personnel. Il répond à la
           question que pose chaque projet d'étudiant — travail scolaire imposé,
           ou initiative propre ? -->
      <template v-if="n.context" #footer-tag>
        {{ t(`ui.${CONTEXT_KEY[n.context]}`) }}
      </template>
    </ProjectCard>
  </div>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: t.space(s4);
  margin-top: t.space(s6);
}

.grid__glyph {
  color: var(--muted);
}

:deep(picture) {
  display: block;
  width: 100%;
  height: 100%;
}

:deep(picture img) {
  width: 100%;
  height: 100%;
  object-fit: cover;
}
</style>
