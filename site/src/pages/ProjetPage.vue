<script setup lang="ts">
import { computed, ref } from "vue"
import { useI18n } from "vue-i18n"
import { Alert, Badge, Button, Icon, SectionHeader, Surface } from "@gamo/ds"
import AppPage from "@/components/AppPage.vue"
import AppPicture from "@/components/AppPicture.vue"
import MediaGallery from "@/components/MediaGallery.vue"
import SocialIcon from "@/components/SocialIcon.vue"
import NotFoundPage from "./NotFoundPage.vue"
import { NODE_BY_ID } from "@/content/nodes"
import { isVideo, media, video } from "@/content/images"

const props = defineProps<{ id: string }>()
const { t, tm } = useI18n()

const node = computed(() => {
  const n = NODE_BY_ID.get(props.id)
  return n && (n.kind === "projet" || n.kind === "expe") ? n : null
})

/** `tm` renvoie le tableau brut de paragraphes, là où `t` renverrait sa clé. */
const paragraphs = computed<string[]>(() => {
  if (!node.value) return []
  const raw = tm(`projects.${node.value.id}.description`) as unknown
  return Array.isArray(raw)
    ? (raw as string[]).map((_, i) => t(`projects.${node.value!.id}.description[${i}]`))
    : []
})

/**
 * Image de tête, déjà résolue. En exposer la valeur plutôt qu'un booléen évite
 * un `!` dans le gabarit : TypeScript ne sait pas restreindre `node.image` à
 * travers un `computed`.
 */
const cover = computed(() => (node.value?.image ? media(node.value.image) : null))

const galleryOpen = ref(false)
const galleryStart = ref(0)

function openAt(i: number) {
  galleryStart.value = i
  galleryOpen.value = true
}
</script>

<template>
  <NotFoundPage v-if="!node" />

  <AppPage v-else>
    <SectionHeader
      :label="node.year"
      :title="t(`projects.${node.id}.title`)"
      :desc="t(`nodes.${node.id}.desc`)"
    />

    <div class="detail" :class="{ 'detail--solo': !cover }">
      <Surface class="detail__body" padding="lg">
        <Alert v-if="node.todo" variant="warning" :title="t('ui.todo')" class="detail__todo" />

        <div class="detail__scroll">
          <p v-for="(p, i) in paragraphs" :key="i" class="detail__p">{{ p }}</p>
        </div>

        <div v-if="node.tech?.length" class="detail__tech">
          <Badge v-for="tech in node.tech" :key="tech" :variant="node.accent">{{ tech }}</Badge>
        </div>

        <div class="detail__actions">
          <Button v-if="node.github" :variant="node.accent" outline :href="node.github">
            <SocialIcon name="github" />
            {{ t("ui.github") }}
          </Button>
          <Button v-if="node.webpage" :variant="node.accent" :href="node.webpage">
            <Icon name="external-link" size="sm" />
            {{ t("ui.demo") }}
          </Button>
        </div>
      </Surface>

      <!-- Le média est carré et de taille fixe : toutes les vignettes de projet
           auront le même gabarit, quelle que soit la forme de l'original. -->
      <Surface v-if="cover" class="detail__media" padding="none" clip>
        <AppPicture
          :picture="cover"
          :alt="t(`projects.${node.id}.title`)"
          loading="eager"
          sizes="(max-width: 1024px) 100vw, 340px"
        />
      </Surface>
    </div>

    <!-- Plus de bouton : la galerie est la page. Un clic ouvre la visionneuse
         sur l'image choisie, pour la voir en grand et naviguer au clavier. -->
    <section v-if="node.gallery?.length" class="gallery">
      <h2 class="gallery__title">{{ t("ui.gallery") }}</h2>
      <ul class="gallery__grid">
        <li v-for="(path, i) in node.gallery" :key="path">
          <button class="gallery__tile" type="button" @click="openAt(i)">
            <!-- Une vidéo n'a pas de vignette : `#t=0.5` demande au navigateur de
                 se placer à une demi-seconde, sinon il n'affiche qu'un cadre noir.
                 `preload="metadata"` ne télécharge que l'en-tête. -->
            <template v-if="isVideo(path)">
              <video
                v-if="video(path)"
                class="gallery__tile-video"
                :src="`${video(path)}#t=0.5`"
                preload="metadata"
                muted
                playsinline
              />
              <span class="gallery__play" aria-hidden="true"><Icon name="play" size="lg" /></span>
            </template>

            <AppPicture
              v-else-if="media(path)"
              :picture="media(path)!"
              :alt="`${t(`projects.${node.id}.title`)} — ${i + 1}`"
              sizes="(max-width: 700px) 50vw, 280px"
            />
          </button>
        </li>
      </ul>
    </section>

    <MediaGallery
      v-if="node.gallery?.length"
      :items="node.gallery"
      :title="t(`projects.${node.id}.title`)"
      :open="galleryOpen"
      :start="galleryStart"
      @close="galleryOpen = false"
    />
  </AppPage>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;
@use "@gamo/ds/scss/mixins" as m;

// Côté du média. Les deux colonnes s'y accordent : le cadre de texte ne dépasse
// jamais l'image en hauteur, ce qui garde la ligne du bas commune.
$media: 340px;

.detail {
  display: grid;
  grid-template-columns: 1fr $media;
  gap: t.space(s6);
  align-items: start;
  margin-top: t.space(s6);

  @include m.below(lg) {
    grid-template-columns: 1fr;
  }
}

.detail__body {
  display: flex;
  flex-direction: column;
  height: $media;

  @include m.below(lg) {
    height: auto;
  }
}

// Sans média, plus rien ne justifie de brider la hauteur du texte : la contrainte
// n'existait que pour aligner le bas des deux colonnes.
.detail--solo {
  grid-template-columns: 1fr;

  .detail__body {
    height: auto;
  }

  .detail__scroll {
    overflow: visible;
  }
}

// Seuls les paragraphes défilent : les technologies et les liens restent visibles
// en bas du cadre, où on les cherche.
.detail__scroll {
  flex: 1;
  min-height: 0;
  overflow-y: auto;

  @include m.below(lg) {
    overflow: visible;
  }
}

.detail__todo {
  margin-bottom: t.space(s4);
}

.detail__p {
  max-width: 70ch;
  margin: 0 0 t.space(s4);
  color: var(--muted);
  font-size: t.text(base);
  line-height: t.leading(relaxed);

  &:last-of-type {
    margin-bottom: 0;
  }
}

.detail__tech {
  display: flex;
  flex-wrap: wrap;
  gap: t.space(s2);
  margin-top: t.space(s4);
}

.detail__actions {
  display: flex;
  flex-wrap: wrap;
  gap: t.space(s3);
  margin-top: t.space(s4);

  &:empty {
    margin-top: 0;
  }
}

.detail__media {
  width: $media;
  height: $media;

  @include m.below(lg) {
    width: 100%;
    height: auto;
    aspect-ratio: 1;
  }

  :deep(picture),
  :deep(img) {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
  }
}

// ── Galerie ───────────────────────────────────────────────────────────────────
.gallery {
  margin-top: t.space(s12);
}

.gallery__title {
  margin: 0 0 t.space(s5);
  color: var(--text);
  font-family: var(--font-display);
  font-size: t.text(lg);
  font-weight: 700;
}

.gallery__grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: t.space(s4);
  margin: 0;
  padding: 0;
  list-style: none;
  // Chaque vignette garde sa hauteur propre : sans cela, les cases d'une même
  // rangée s'étireraient sur la plus haute et le rapport d'origine serait perdu.
  align-items: start;
}

.gallery__tile {
  position: relative;
  display: block;
  width: 100%;
  padding: 0;
  overflow: hidden;
  border: 1px solid var(--border);
  border-radius: t.radius(lg);
  background: var(--surface);
  cursor: pointer;
  transition: border-color var(--dur-base) var(--ease-out);

  &:hover {
    border-color: var(--lav);
  }

  @include m.focus-ring;

  // Pas de rapport imposé ni de recadrage : la vignette prend la forme de
  // l'image. Les dimensions posées par `AppPicture` donnent au navigateur le
  // rapport exact, donc la place est réservée avant même le chargement.
  :deep(picture) {
    display: block;
  }

  :deep(img),
  .gallery__tile-video {
    display: block;
    width: 100%;
    height: auto;
  }
}

// Pastille de lecture, pour qu'une vignette vidéo ne passe pas pour une image fixe.
.gallery__play {
  position: absolute;
  top: 50%;
  left: 50%;
  display: grid;
  place-items: center;
  width: 48px;
  height: 48px;
  transform: translate(-50%, -50%);
  border-radius: 50%;
  background: color-mix(in srgb, var(--void) 70%, transparent);
  color: var(--text);
  backdrop-filter: blur(4px);
  pointer-events: none;
}

@media (prefers-reduced-motion: reduce) {
  .gallery__tile {
    transition: none;
  }
}
</style>
