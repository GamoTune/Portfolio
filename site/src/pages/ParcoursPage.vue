<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { SectionHeader } from "@gamo/ds"
import AppPage from "@/components/AppPage.vue"
import { sectionNumber } from "@/content/nodes"
import ParcoursTimeline from "@/components/ParcoursTimeline.vue"

const { t } = useI18n()
</script>

<template>
  <AppPage>
    <SectionHeader
      :label="sectionNumber('parcours')"
      :title="t('sections.parcours.title')"
      :desc="t('sections.parcours.desc')"
    />
    <ParcoursTimeline />
  </AppPage>
</template>
