<script setup lang="ts">
import { Icon } from "@gamo/ds"
import type { SocialLink } from "@/content/types"

/**
 * Icônes des liens de contact.
 *
 * `mail` vient du design system : ce n'est pas une marque. Les trois autres
 * gardent leur **logo officiel**, dessiné ici en aplat. Le composant `Icon` du DS
 * rend au trait de 2 px, ce qui rendrait ces marques méconnaissables à 16 px — et
 * un design system générique n'a de toute façon pas à porter des marques tierces.
 *
 * L'ancien site chargeait Font Awesome depuis un CDN — 75 ko de police et une
 * requête tierce — pour ces quelques glyphes.
 */
defineProps<{ name: SocialLink["icon"] }>()

type BrandName = Exclude<SocialLink["icon"], "mail">

const PATHS: Record<BrandName, string> = {
  github:
    "M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.17 6.84 9.5.5.09.66-.22.66-.48v-1.7c-2.78.6-3.37-1.34-3.37-1.34-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.6.07-.6 1 .07 1.53 1.03 1.53 1.03.89 1.53 2.34 1.09 2.91.83.09-.65.35-1.09.63-1.34-2.22-.25-4.55-1.11-4.55-4.94 0-1.09.39-1.98 1.03-2.68-.1-.25-.45-1.27.1-2.64 0 0 .84-.27 2.75 1.02a9.56 9.56 0 0 1 5 0c1.91-1.29 2.75-1.02 2.75-1.02.55 1.37.2 2.39.1 2.64.64.7 1.03 1.59 1.03 2.68 0 3.84-2.34 4.68-4.57 4.93.36.31.68.92.68 1.85v2.74c0 .27.16.58.67.48A10 10 0 0 0 22 12c0-5.52-4.48-10-10-10z",
  linkedin:
    "M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3V9zm7 0h3.8v1.7h.05c.53-1 1.83-2.05 3.76-2.05 4.02 0 4.76 2.65 4.76 6.1V21h-4v-5.4c0-1.29-.02-2.95-1.8-2.95-1.8 0-2.07 1.4-2.07 2.85V21h-4V9z",
  discord:
    "M20.3 4.9A19 19 0 0 0 15.6 3.5l-.24.44c1.6.4 2.9 1 4.1 1.8a15.7 15.7 0 0 0-11-1.3c-.7.2-1.3.4-1.9.6A16.8 16.8 0 0 1 8.6 3.9L8.4 3.5A19 19 0 0 0 3.7 4.9C1.2 8.6.5 12.2.85 15.8a19 19 0 0 0 5.8 2.9l.9-1.4c-.8-.3-1.5-.7-2.2-1.1l.5-.4a13.6 13.6 0 0 0 12.3 0l.5.4c-.7.4-1.4.8-2.2 1.1l.9 1.4a19 19 0 0 0 5.8-2.9c.4-4.2-.7-7.8-2.85-10.9zM8.9 13.9c-1.1 0-2-1-2-2.3s.9-2.3 2-2.3 2 1 2 2.3-.9 2.3-2 2.3zm6.2 0c-1.1 0-2-1-2-2.3s.9-2.3 2-2.3 2 1 2 2.3-.9 2.3-2 2.3z",
}
</script>

<template>
  <Icon v-if="name === 'mail'" name="mail" size="sm" />
  <svg v-else viewBox="0 0 24 24" width="18" height="18" aria-hidden="true" focusable="false">
    <path :d="PATHS[name]" fill="currentColor" />
  </svg>
</template>
