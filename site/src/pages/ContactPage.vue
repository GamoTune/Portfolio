<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { SectionHeader, Surface } from "@gamo/ds"
import AppPage from "@/components/AppPage.vue"
import SocialIcon from "@/components/SocialIcon.vue"
import { SOCIAL, sectionNumber } from "@/content/nodes"

const { t } = useI18n()
const mail = SOCIAL.find((s) => s.id === "mail")!
</script>

<template>
  <AppPage>
    <SectionHeader
      :label="sectionNumber('contact')"
      :title="t('sections.contact.title')"
      :desc="t('sections.contact.desc')"
    />

    <Surface class="contact" padding="lg">
      <a class="contact__mail" :href="mail.url">arthur.labregere@gmail.com</a>

      <ul class="contact__links">
        <li v-for="link in SOCIAL.filter((s) => s.id !== 'mail')" :key="link.id">
          <a class="contact__link" :href="link.url" target="_blank" rel="noopener noreferrer">
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

.contact {
  margin-top: t.space(s6);
}

.contact__mail {
  color: var(--lav);
  font-family: var(--font-mono);
  font-size: t.text(lg);
  text-decoration: none;

  &:hover {
    text-decoration: underline;
  }

  @include m.focus-ring;
}

.contact__links {
  display: flex;
  flex-wrap: wrap;
  gap: t.space(s3);
  margin: t.space(s6) 0 0;
  padding: 0;
  list-style: none;
}

.contact__link {
  display: inline-flex;
  gap: t.space(s2);
  align-items: center;
  padding: t.space(s2) t.space(s4);
  border: 1px solid var(--border);
  border-radius: t.radius(full);
  color: var(--muted);
  font-size: t.text(base);
  text-decoration: none;

  &:hover {
    border-color: var(--lav);
    color: var(--text);
  }

  @include m.focus-ring;
}
</style>
