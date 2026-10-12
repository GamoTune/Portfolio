<script setup lang="ts">
import { useI18n } from "vue-i18n"
import { Avatar, SectionHeader } from "@gamo/ds"
import AppPage from "@/components/AppPage.vue"
import ProjectGrid from "@/components/ProjectGrid.vue"
import { EXPES, PROJETS, sectionNumber } from "@/content/nodes"

/**
 * Accueil.
 *
 * Le hero n'utilise pas `PageHero` du design system : celui-ci a 24 px de
 * rembourrage horizontal et aucune largeur maximale, quand le reste des pages
 * vit dans `AppPage` — 48 px, plafonné à 1180 px. Les deux ne s'alignaient pas.
 *
 * L'avatar est **au-dessus** du texte et non à côté : en colonne latérale, il
 * décalait le paragraphe et la ligne de chiffres vers la droite, sur un axe
 * différent de celui des sections qui suivent.
 *
 * La biographie complète est restée sur `/a-propos` ; ici, deux phrases et un lien.
 */
const { t } = useI18n()

const FIRST_YEAR = "2023"
</script>

<template>
  <AppPage>
    <section class="hero">
      <Avatar size="xl" variant="lav" initials="AL" ring />

      <h1 class="hero__name">{{ t("site.title") }}</h1>
      <p class="hero__role">{{ t("site.role") }}</p>

      <p class="hero__accroche">
        {{ t("site.accroche") }}
        <RouterLink class="hero__more" to="/a-propos">{{ t("ui.seeMore") }}</RouterLink>
      </p>

      <p class="hero__stats">
        <span><strong>{{ PROJETS.length }}</strong> {{ t("ui.projectsCount") }}</span>
        <span><strong>{{ EXPES.length }}</strong> {{ t("ui.expesCount") }}</span>
        <span>{{ t("ui.since") }} <strong>{{ FIRST_YEAR }}</strong></span>
      </p>
    </section>

    <section id="projets" class="section">
      <SectionHeader
        :label="sectionNumber('projects')"
        :title="t('sections.projects.title')"
        :desc="t('sections.projects.desc')"
      />
      <ProjectGrid :nodes="PROJETS" />
    </section>

    <section class="section">
      <SectionHeader
        :label="sectionNumber('expes')"
        :title="t('sections.expes.title')"
        :desc="t('sections.expes.desc')"
      />
      <ProjectGrid :nodes="EXPES" />
    </section>
  </AppPage>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;

// Tout part du même bord gauche : avatar, titre, paragraphe et chiffres.
.hero {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: t.space(s3);
}

.hero__name {
  margin: t.space(s3) 0 0;
  color: var(--text);
  font-family: var(--font-display);
  // Syne s'arrête à 800 : un 900 ferait fabriquer un faux gras au navigateur.
  font-weight: 800;
  font-size: clamp(2rem, 4vw, 3rem);
  letter-spacing: -0.02em;
  line-height: t.leading(tight);
}

.hero__role {
  margin: 0;
  color: var(--lav);
  font-family: var(--font-mono);
  font-size: t.text(xs);
  font-weight: 500;
  letter-spacing: 0.12em;
}

.hero__accroche {
  // Une mesure courte : au-delà d'environ 65 caractères par ligne, l'œil perd
  // le début de la ligne suivante.
  max-width: 52ch;
  margin: 0;
  color: var(--muted);
  font-size: t.text(md);
  line-height: t.leading(relaxed);
}

// Le lien prolonge la phrase : il est en Syne pour se détacher du corps de texte
// sans rompre le fil de lecture.
.hero__more {
  margin-left: t.space(s2);
  color: var(--lav);
  font-family: var(--font-display);
  font-weight: 700;
  text-decoration: none;
  border-bottom: 1px solid color-mix(in srgb, var(--lav) 45%, transparent);
  transition: border-color var(--dur-base) var(--ease-out);

  &:hover {
    border-bottom-color: var(--lav);
  }
}

.hero__stats {
  display: flex;
  flex-wrap: wrap;
  gap: t.space(s5);
  margin: t.space(s3) 0 0;
  padding-top: t.space(s4);
  border-top: 1px solid var(--border);
  color: var(--muted);
  font-size: t.text(sm);

  strong {
    color: var(--text);
    font-family: var(--font-mono);
    font-weight: 600;
  }
}

.section {
  margin-top: t.space(s12);
  // L'en-tête est collé en haut sur 96 px : sans cette marge, une ancre amènerait
  // le titre de section juste dessous, donc masqué.
  scroll-margin-top: 112px;
}

@media (prefers-reduced-motion: reduce) {
  .hero__more {
    transition: none;
  }
}
</style>
