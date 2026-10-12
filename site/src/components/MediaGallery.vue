<script setup lang="ts">
import { computed, ref, watch, onBeforeUnmount } from "vue"
import { useI18n } from "vue-i18n"
import { Icon, MediaViewer } from "@gamo/ds"
import { full, isVideo, video } from "@/content/images"

/**
 * Visionneuse de médias : images et vidéos.
 *
 * Bâtie sur `<dialog>` natif ouvert par `showModal()` : le navigateur fournit le
 * piège du focus, l'inertie de l'arrière-plan et la fermeture par Échap. Ce n'est
 * pas le `Modal` du design system parce que celui-ci plafonne à 760 px et impose
 * une structure en-tête / corps / pied dont une visionneuse n'a que faire.
 *
 * Le préchargement se fait **par le DOM** : les images voisines sont rendues, mais
 * masquées. Un `new Image().src` aurait préchargé le repli JPEG, pas la variante
 * AVIF que le navigateur va réellement choisir dans le `<picture>` — le
 * préchargement aurait donc téléchargé deux fois le mauvais fichier.
 */
const props = defineProps<{
  /** Chemins de médias, tels que cités par le module de contenu. */
  items: string[]
  title: string
  open: boolean
  /** Index d'ouverture — la vignette sur laquelle on a cliqué. */
  start?: number
}>()

const emit = defineEmits<{ close: [] }>()

const { t } = useI18n()

const dialog = ref<HTMLDialogElement | null>(null)
const index = ref(0)

/**
 * Les médias résolus, dans l'ordre. Une image garde son `<picture>` — et donc le
 * choix AVIF/WebP du navigateur ; une vidéo passe par `MediaViewer` du design
 * system, qui sait aussi rendre l'audio et les PDF si le besoin vient.
 */
const media = computed(() =>
  props.items
    .map((path) => {
      if (isVideo(path)) {
        const src = video(path)
        return src ? ({ kind: "video", path, src } as const) : null
      }
      const picture = full(path)
      return picture ? ({ kind: "image", path, picture } as const) : null
    })
    .filter((m) => m !== null),
)

const count = computed(() => media.value.length)

/**
 * Fenêtre glissante précédent / courant / suivant. Les trois sont dans le DOM, donc
 * déjà téléchargées quand l'utilisateur appuie sur une flèche : le changement est
 * instantané, au lieu de l'image blanche de la version d'origine.
 */
const windowed = computed(() => {
  const n = count.value
  if (n === 0) return []
  const at = (i: number) => (i + n) % n
  const slots =
    n === 1
      ? [0]
      : n === 2
        ? [index.value, at(index.value + 1)]
        : [at(index.value - 1), index.value, at(index.value + 1)]
  return [...new Set(slots)].map((i) => ({ i, item: media.value[i]! }))
})

function go(delta: number) {
  if (count.value === 0) return
  index.value = (index.value + delta + count.value) % count.value
}

function close() {
  emit("close")
}

// ── Ouverture et fermeture ───────────────────────────────────────────────────
watch(
  () => props.open,
  (open) => {
    const el = dialog.value
    if (!el) return
    if (open) {
      index.value = props.start ?? 0
      if (!el.open) el.showModal()
      // showModal() ne verrouille pas le défilement de la page.
      document.body.style.overflow = "hidden"
    } else {
      if (el.open) el.close()
      document.body.style.overflow = ""
    }
  },
)

// La fermeture native (Échap, ou `close()`) doit remonter au parent, sinon l'état
// `open` resterait vrai et la visionneuse ne pourrait plus se rouvrir.
function onNativeClose() {
  document.body.style.overflow = ""
  if (props.open) emit("close")
}

function onKeydown(e: KeyboardEvent) {
  if (e.key === "ArrowLeft") {
    e.preventDefault()
    go(-1)
  } else if (e.key === "ArrowRight") {
    e.preventDefault()
    go(1)
  }
}

// ── Balayage tactile ─────────────────────────────────────────────────────────
const SWIPE = 50
let startX: number | null = null

function onPointerDown(e: PointerEvent) {
  startX = e.clientX
}

function onPointerUp(e: PointerEvent) {
  if (startX === null) return
  const dx = e.clientX - startX
  startX = null
  if (Math.abs(dx) < SWIPE) return
  go(dx < 0 ? 1 : -1)
}

// Le style est restauré même si le composant est démonté ouvert.
onBeforeUnmount(() => {
  document.body.style.overflow = ""
})
</script>

<template>
  <!-- L'écouteur clavier vit sur le dialogue, pas sur `document` : la version
       d'origine en ajoutait un par montage sans jamais le retirer. -->
  <dialog
    ref="dialog"
    class="gallery"
    :aria-label="t('ui.galleryOf', { title })"
    @close="onNativeClose"
    @keydown="onKeydown"
    @click.self="close"
  >
    <header class="gallery__head">
      <h2 class="gallery__title">{{ title }}</h2>
      <button class="gallery__btn" :aria-label="t('ui.closeGallery')" @click="close">
        <Icon name="x" />
      </button>
    </header>

    <div class="gallery__stage" @pointerdown="onPointerDown" @pointerup="onPointerUp">
      <button
        v-if="count > 1"
        class="gallery__btn gallery__nav gallery__nav--prev"
        :aria-label="t('ui.prev')"
        @click="go(-1)"
      >
        <Icon name="chevron-left" />
      </button>

      <template v-for="slot in windowed" :key="slot.i">
        <!-- Les images voisines sont montées mais masquées : elles sont donc déjà
             chargées, au bon format, quand on appuie sur une flèche. -->
        <picture
          v-if="slot.item.kind === 'image'"
          class="gallery__pic"
          :class="{ 'is-current': slot.i === index }"
          :aria-hidden="slot.i !== index"
        >
          <source
            v-for="(srcset, fmt) in slot.item.picture.sources"
            :key="fmt"
            :srcset="srcset"
            :type="`image/${fmt}`"
          />
          <!-- Dimensions connues d'avance : la boîte ne saute plus d'une image à
               l'autre. `eager` parce que l'image est affichée tout de suite — le
               `lazy` de la version d'origine retardait ce qu'on voulait voir. -->
          <img
            :src="slot.item.picture.img.src"
            :width="slot.item.picture.img.w"
            :height="slot.item.picture.img.h"
            :alt="`${title} — ${slot.i + 1}`"
            loading="eager"
            decoding="async"
            draggable="false"
          />
        </picture>

        <!-- Une vidéo n'est montée que lorsqu'elle est à l'écran : la précharger
             comme une image lancerait plusieurs téléchargements pour rien. -->
        <div v-else-if="slot.i === index" class="gallery__video">
          <MediaViewer kind="video" :src="slot.item.src" :name="`${title} — ${slot.i + 1}`" />
        </div>
      </template>

      <button
        v-if="count > 1"
        class="gallery__btn gallery__nav gallery__nav--next"
        :aria-label="t('ui.next')"
        @click="go(1)"
      >
        <Icon name="chevron-right" />
      </button>
    </div>

    <!-- Le compteur change sans que rien ne bouge à l'écran pour un lecteur
         d'écran : il faut l'annoncer. -->
    <p class="gallery__counter" aria-live="polite">
      {{ t("ui.counter", { current: index + 1, total: count }) }}
    </p>
  </dialog>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;
@use "@gamo/ds/scss/mixins" as m;

.gallery {
  width: min(96vw, 1400px);
  max-width: none;
  height: min(92vh, 1000px);
  padding: 0;
  border: 1px solid var(--border);
  border-radius: t.radius(lg);
  background: var(--surface);
  color: var(--text);

  &::backdrop {
    background: color-mix(in srgb, var(--void) 88%, transparent);
    backdrop-filter: blur(4px);
  }
}

.gallery__head {
  display: flex;
  gap: t.space(s4);
  align-items: center;
  justify-content: space-between;
  padding: t.space(s3) t.space(s4);
  border-bottom: 1px solid var(--border);
}

.gallery__title {
  margin: 0;
  overflow: hidden;
  color: var(--text);
  font-size: t.text(md);
  font-weight: 600;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.gallery__stage {
  position: relative;
  display: grid;
  // `minmax(0, 1fr)` plutôt qu'un `auto` implicite : sans taille définie, la
  // rangée se dimensionne sur l'image, et le `max-height: 100%` de celle-ci
  // devient circulaire — il ne contraint alors plus rien et l'image déborde de
  // la scène (mesuré : 1200 px de haut dans un cadre de 304 px).
  grid-template: minmax(0, 1fr) / minmax(0, 1fr);
  place-items: center;
  height: calc(100% - 104px);
  padding: t.space(s4);
  touch-action: pan-y;
}

// Les trois créneaux se superposent dans la même cellule de grille : les deux
// masqués gardent leur poids de chargement, mais aucune place à l'écran.
// La vidéo occupe la même cellule de grille que les images.
.gallery__video {
  grid-area: 1 / 1;
  display: grid;
  place-items: center;
  width: 100%;
  height: 100%;
  min-width: 0;
  min-height: 0;
}

.gallery__pic {
  display: contents;

  img {
    grid-area: 1 / 1;
    // `auto` laisse l'image se réduire : les attributs width/height restent
    // présents pour l'`aspect-ratio`, mais ne dictent plus la taille rendue.
    width: auto;
    height: auto;
    min-width: 0;
    min-height: 0;
    max-width: 100%;
    max-height: 100%;
    border-radius: t.radius(md);
    object-fit: contain;
    visibility: hidden;
  }

  &.is-current img {
    visibility: visible;
  }
}

.gallery__btn {
  display: grid;
  place-items: center;
  width: 40px;
  height: 40px;
  border: 1px solid var(--border);
  border-radius: t.radius(full);
  background: color-mix(in srgb, var(--card) 85%, transparent);
  color: var(--muted);
  font-size: t.text(lg);
  line-height: 1;
  cursor: pointer;
  transition:
    color var(--dur-base) var(--ease-out),
    border-color var(--dur-base) var(--ease-out);

  &:hover {
    border-color: var(--lav);
    color: var(--text);
  }

  @include m.focus-ring;
}

.gallery__nav {
  position: absolute;
  top: 50%;
  z-index: 1;
  transform: translateY(-50%);
  backdrop-filter: blur(4px);

  &--prev {
    left: t.space(s4);
  }

  &--next {
    right: t.space(s4);
  }
}

.gallery__counter {
  margin: 0;
  padding: t.space(s3);
  border-top: 1px solid var(--border);
  color: var(--muted);
  font-family: var(--font-mono);
  font-size: t.text(xs);
  letter-spacing: 0.08em;
  text-align: center;
}

@media (prefers-reduced-motion: reduce) {
  .gallery__btn {
    transition: none;
  }
}
</style>
