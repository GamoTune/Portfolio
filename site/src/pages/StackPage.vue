<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { Badge, SectionHeader, Surface } from "@gamo/ds"
import AppPage from "@/components/AppPage.vue"
import { SKILLS, sectionNumber } from "@/content/nodes"

const { t } = useI18n()
</script>

<template>
  <AppPage>
    <SectionHeader
      :label="sectionNumber('stack')"
      :title="t('sections.stack.title')"
      :desc="t('sections.stack.desc')"
    />

    <div class="grid">
      <Surface v-for="(group, key) in SKILLS" :key="key" padding="md">
        <h2 class="grid__title">
          <span class="grid__dot" :style="{ background: `var(--${group.accent})` }" />
          {{ t(`skills.${key}.category`) }}
        </h2>

        <div class="grid__items">
          <!-- Les compétences mises en avant prennent l'accent du groupe ; les
               autres restent neutres. La couleur porte donc une information, elle
               n'est pas décorative. -->
          <Badge
            v-for="skill in group.items"
            :key="skill.id"
            :variant="skill.strong ? group.accent : 'muted'"
          >
            {{ t(`skills.${key}.items.${skill.id}`) }}
          </Badge>
        </div>
      </Surface>
    </div>
  </AppPage>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;

.grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: t.space(s4);
  margin-top: t.space(s6);
}

.grid__title {
  display: flex;
  gap: t.space(s2);
  align-items: center;
  margin: 0 0 t.space(s4);
  font-size: t.text(md);
  font-weight: 700;
}

.grid__dot {
  flex-shrink: 0;
  width: 8px;
  height: 8px;
  border-radius: 50%;
}

.grid__items {
  display: flex;
  flex-wrap: wrap;
  gap: t.space(s2);
}
</style>
