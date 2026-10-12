<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { SectionHeader, Surface } from "@gamo/ds"
import AppPage from "@/components/AppPage.vue"
import SocialIcon from "@/components/SocialIcon.vue"
import { SOCIAL, sectionNumber } from "@/content/nodes"

const { t } = useI18n()
</script>

<template>
  <AppPage>
    <SectionHeader
      :label="sectionNumber('about')"
      :title="t('sections.about.title')"
      :desc="t('sections.about.desc')"
    />

    <Surface class="about" padding="lg">
      <p class="about__text">{{ t("about.content") }}</p>

      <ul class="about__links">
        <li v-for="link in SOCIAL" :key="link.id">
          <a class="about__link" :href="link.url" target="_blank" rel="noopener noreferrer">
            <SocialIcon :name="link.icon" />
            <span>{{ t(`social.${link.id}`) }}</span>
          </a>
        </li>
      </ul>
    </Surface>
  </AppPage>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;
@use "@gamo/ds/scss/mixins" as m;

.about {
  margin-top: t.space(s6);
}

.about__text {
  max-width: 72ch;
  margin: 0;
  color: var(--muted);
  font-size: t.text(base);
  line-height: t.leading(relaxed);
}

.about__links {
  display: flex;
  flex-wrap: wrap;
  gap: t.space(s3);
  margin: t.space(s8) 0 0;
  padding: 0;
  list-style: none;
}

.about__link {
  display: inline-flex;
  gap: t.space(s2);
  align-items: center;
  padding: t.space(s2) t.space(s4);
  border: 1px solid var(--border);
  border-radius: t.radius(full);
  color: var(--muted);
  font-size: t.text(base);
  text-decoration: none;
  transition:
    color var(--dur-base) var(--ease-out),
    border-color var(--dur-base) var(--ease-out);

  &:hover {
    border-color: var(--lav);
    color: var(--text);
  }

  @include m.focus-ring;
}

@media (prefers-reduced-motion: reduce) {
  .about__link {
    transition: none;
  }
}
</style>
