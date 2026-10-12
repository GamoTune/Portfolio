<script setup lang="ts">
import type { Picture } from "@/content/images"

/**
 * Rend une image traitée par le pipeline : un `<picture>` avec les formats
 * modernes en premier et le repli en dernier, dimensions incluses.
 *
 * Les dimensions sont toujours posées : sans elles le navigateur ne peut pas
 * réserver la place et la page tressaute au chargement.
 */
defineProps<{
  picture: Picture
  alt: string
  /** `lazy` pour une vignette hors écran, `eager` pour ce qu'on voit tout de suite. */
  loading?: "lazy" | "eager"
  sizes?: string
}>()
</script>

<template>
  <picture>
    <source
      v-for="(srcset, fmt) in picture.sources"
      :key="fmt"
      :srcset="srcset"
      :sizes="sizes"
      :type="`image/${fmt}`"
    />
    <img
      :src="picture.img.src"
      :width="picture.img.w"
      :height="picture.img.h"
      :sizes="sizes"
      :alt="alt"
      :loading="loading ?? 'lazy'"
      decoding="async"
    />
  </picture>
</template>
