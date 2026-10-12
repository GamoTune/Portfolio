<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { Badge, Icon, Surface } from "@gamo/ds"
import { TIMELINE } from "@/content/nodes"

/**
 * Frise du parcours.
 *
 * Le design system n'a pas de composant Timeline, et n'en aura un que si un
 * second usage le réclame : on le construit ici, sur `Surface`, plutôt que de
 * faire grossir le DS pour un seul appelant.
 */
const { t } = useI18n()
</script>

<template>
  <ol class="tl">
    <li v-for="entry in TIMELINE" :key="entry.id" class="tl__item">
      <span class="tl__dot" :class="`tl__dot--${entry.type}`" aria-hidden="true" />
      <Surface class="tl__card" padding="md">
        <p class="tl__year">{{ t(`timeline.${entry.id}.year`) }}</p>
        <h3 class="tl__title">{{ t(`timeline.${entry.id}.title`) }}</h3>
        <p class="tl__inst">
          {{ t(`timeline.${entry.id}.institution`) }}
          <Badge :variant="entry.type === 'education' ? 'cyan' : 'green'">
            <Icon :name="entry.type === 'education' ? 'graduation-cap' : 'briefcase'" size="sm" />
            {{ entry.type === "education" ? "formation" : "expérience" }}
          </Badge>
        </p>
        <p class="tl__desc">{{ t(`timeline.${entry.id}.description`) }}</p>
      </Surface>
    </li>
  </ol>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;

.tl {
  position: relative;
  margin: t.space(s8) 0 0;
  padding: 0 0 0 t.space(s8);
  list-style: none;

  // Le filet vertical. `--faint` est décoratif par définition dans le DS : c'est
  // exactement son emploi.
  &::before {
    content: "";
    position: absolute;
    top: 6px;
    bottom: 6px;
    left: 5px;
    width: 1px;
    background: var(--faint);
  }
}

.tl__item {
  position: relative;

  & + & {
    margin-top: t.space(s6);
  }
}

.tl__dot {
  position: absolute;
  top: 18px;
  left: calc(-1 * #{t.space(s8)} + 1px);
  width: 9px;
  height: 9px;
  border-radius: 50%;

  &--education {
    background: var(--cyan);
  }

  &--work {
    background: var(--green);
  }
}

.tl__year {
  margin: 0;
  color: var(--muted);
  font-family: var(--font-mono);
  font-size: t.text(xs);
  letter-spacing: 0.1em;
}

.tl__title {
  margin: t.space(s2) 0 0;
  font-size: t.text(md);
  font-weight: 700;
}

.tl__inst {
  display: flex;
  gap: t.space(s2);
  align-items: center;
  margin: t.space(s1) 0 0;
  color: var(--muted);
  font-size: t.text(base);
}

.tl__desc {
  margin: t.space(s3) 0 0;
  color: var(--muted);
  font-size: t.text(base);
  line-height: t.leading(relaxed);
}
</style>
