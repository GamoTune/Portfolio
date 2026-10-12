<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { Button, EmptyState, Icon } from "@gamo/ds"
import AppPage from "@/components/AppPage.vue"

const { t } = useI18n()
</script>

<template>
  <AppPage>
    <EmptyState :title="t('ui.notFound')" accent="lav">
      <template #icon><Icon name="x-circle" size="lg" /></template>
      <template #actions>
        <Button variant="lav" href="/">{{ t("ui.backHome") }}</Button>
      </template>
    </EmptyState>
  </AppPage>
</template>
