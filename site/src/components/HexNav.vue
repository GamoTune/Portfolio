<script setup lang="ts">
import { ref, computed, onMounted, onUnmounted } from "vue"
import { useI18n } from "vue-i18n"
import { Icon } from "@gamo/ds"
import { NODES, routeOf } from "@/content/nodes"
import { nodeIcon } from "@/content/images"
import type { HexNode } from "@/content/types"

/**
 * La carte hexagonale : l'entrée principale du site.
 *
 * Reprise de la version d'origine, à rendu identique, avec quatre corrections de
 * fond : les données viennent du module de contenu, les couleurs des tokens du
 * design system, les tuiles sont atteignables au clavier, et le bloc « anneau L2 »
 * — quarante lignes pilotées par un tableau resté vide — a été retiré.
 */

defineProps<{ open: boolean }>()
const emit = defineEmits<{ navigate: [node: HexNode]; close: [] }>()

const { t } = useI18n()

// ── Géométrie (hexagones pointe à plat) ──────────────────────────────────────
const R = 70
const S3 = Math.sqrt(3)
/** Demi-hauteur d'un hexagone. */
const HW = (R * S3) / 2
/** Hauteur de la bande de libellé, sous l'image. */
const TXT_H = (HW * 2) / 3
/** Hauteur de la bande d'année, tout en bas. */
const YR_H = HW / 3
/** Largeur utile pour un libellé, marges comprises. */
const LBL_W = R * 2 - 24
/**
 * Au-delà de cette longueur, le libellé est resserré pour tenir dans la tuile.
 * En chasse fixe, le nombre de caractères est un indicateur fiable : à 16 px,
 * JetBrains Mono fait ~9,6 px par caractère, soit 116 px pour douze.
 * Sans cela « Serveur Ubuntu » sortait de l'hexagone et se faisait rogner.
 */
const LBL_MAX_CHARS = 12

// ── Viewport ─────────────────────────────────────────────────────────────────
const vw = ref(1280)
const vh = ref(800)

function readViewport() {
  vw.value = window.innerWidth
  vh.value = window.innerHeight
}

onMounted(() => {
  readViewport()
  window.addEventListener("resize", readViewport)
})
onUnmounted(() => window.removeEventListener("resize", readViewport))

/**
 * Le hub est à l'origine du repère ; c'est le `viewBox` qui cadre.
 *
 * La version d'origine positionnait les tuiles en pixels écran autour du centre.
 * Sur un téléphone, la grille — huit colonnes, environ 900 px de large — débordait
 * donc des deux côtés : cinq tuiles sur seize étaient hors de l'écran, et cinq
 * pages devenaient injoignables dès lors que la carte est la navigation principale.
 *
 * En cadrant par `viewBox`, le SVG se met à l'échelle tout seul : la carte reste
 * au format 1:1 tant qu'elle tient, et rétrécit juste ce qu'il faut sinon.
 */
function axialPos(q: number, r: number): [number, number] {
  return [1.5 * R * q, R * S3 * (r + q / 2)]
}

/** Marge autour de la grille : le bouton de fermeture et la barre de statut. */
const MARGIN = 90

/** Étendue occupée par les tuiles, symétrique autour de l'origine. */
const contentBox = computed(() => {
  let halfW = 0
  let halfH = 0
  for (const n of NODES) {
    const [x, y] = axialPos(n.hex.q, n.hex.r)
    halfW = Math.max(halfW, Math.abs(x) + R)
    halfH = Math.max(halfH, Math.abs(y) + R)
  }
  return { w: (halfW + MARGIN) * 2, h: (halfH + MARGIN) * 2 }
})

/**
 * Le cadre, exprimé en unités du monde.
 *
 * On calcule d'abord l'échelle qui fait tenir la grille, plafonnée à 1 — on ne
 * grossit jamais la carte sur grand écran. Le cadre vaut ensuite exactement la
 * fenêtre divisée par cette échelle, ce qui lui donne le **même rapport d'aspect
 * que la fenêtre**.
 *
 * C'est indispensable : avec un cadre au rapport différent, `meet` centre le
 * dessin et laisse des bandes vides sur les côtés ou en haut et en bas — la
 * grille de fond cessait alors de couvrir l'écran sur une fenêtre très haute.
 */
const box = computed(() => {
  const scale = Math.min(
    vw.value / contentBox.value.w,
    vh.value / contentBox.value.h,
    1,
  )
  return { w: vw.value / scale, h: vh.value / scale }
})

const viewBox = computed(() => `${-box.value.w / 2} ${-box.value.h / 2} ${box.value.w} ${box.value.h}`)

function hexPts(cx: number, cy: number, r: number) {
  return Array.from({ length: 6 }, (_, i) => {
    const a = (i * Math.PI) / 3
    return `${(cx + r * Math.cos(a)).toFixed(2)},${(cy + r * Math.sin(a)).toFixed(2)}`
  }).join(" ")
}

// ── Nœuds positionnés ────────────────────────────────────────────────────────
interface PlacedNode extends HexNode {
  cx: number
  cy: number
  lbl: string
  desc: string
  img: string | null
  /** Largeur imposée au libellé quand il est trop long, sinon `undefined`. */
  lblWidth?: number
}

const nodes = computed<PlacedNode[]>(() =>
  NODES.map((n) => {
    const [cx, cy] = axialPos(n.hex.q, n.hex.r)
    const lbl = t(`nodes.${n.id}.lbl`)
    return {
      ...n,
      cx,
      cy,
      lbl,
      desc: t(`nodes.${n.id}.desc`),
      img: n.image ? nodeIcon(n.image) : null,
      lblWidth: lbl.length > LBL_MAX_CHARS ? LBL_W : undefined,
    }
  }),
)

/** Grille décorative qui remplit le cadre derrière les tuiles. */
const bgCells = computed(() => {
  const cells: { px: number; py: number }[] = []
  const halfW = box.value.w / 2
  const halfH = box.value.h / 2
  const qMax = Math.ceil(halfW / (1.5 * R)) + 1
  const rMax = Math.ceil(halfH / (R * S3)) + 1
  for (let q = -qMax; q <= qMax; q++) {
    for (let r = -rMax; r <= rMax; r++) {
      const [px, py] = axialPos(q, r)
      if (Math.abs(px) > halfW + R || Math.abs(py) > halfH + R) continue
      cells.push({ px, py })
    }
  }
  return cells
})

// ── État ─────────────────────────────────────────────────────────────────────
const activeId = ref<string | null>(null)
const hoverId = ref<string | null>(null)

const hinted = computed(() => nodes.value.find((n) => n.id === (hoverId.value ?? activeId.value)))

function activate(node: PlacedNode) {
  activeId.value = node.id
  emit("navigate", node)
}
</script>

<template>
  <Teleport to="body">
    <Transition name="hexnav">
      <div v-if="open" class="hexnav" role="dialog" :aria-label="t('nav.open')">
        <svg
          class="hexnav__svg"
          :viewBox="viewBox"
          preserveAspectRatio="xMidYMid meet"
          xmlns="http://www.w3.org/2000/svg"
        >
          <defs>
            <clipPath v-for="n in nodes" :id="`hn-c-${n.id}`" :key="`clip-${n.id}`">
              <polygon :points="hexPts(n.cx, n.cy, R - 0.5)" />
            </clipPath>
            <linearGradient
              v-for="n in nodes"
              :id="`hn-g-${n.id}`"
              :key="`grad-${n.id}`"
              :x1="n.cx"
              :y1="n.cy - HW"
              :x2="n.cx"
              :y2="n.cy"
              gradientUnits="userSpaceOnUse"
            >
              <stop class="hexnav__grad-top" offset="0%" />
              <stop class="hexnav__grad-bottom" offset="100%" />
            </linearGradient>
          </defs>

          <!-- Grille de fond, purement décorative -->
          <g class="hexnav__grid" aria-hidden="true">
            <polygon
              v-for="(cell, i) in bgCells"
              :key="`bg-${i}`"
              :points="hexPts(cell.px, cell.py, R - 1.5)"
            />
          </g>

          <!-- Tuiles. Un <a> SVG plutôt qu'un <g> cliquable : il est atteignable
               au Tab et s'active à Entrée, sans rien réimplémenter. -->
          <a
            v-for="n in nodes"
            :key="n.id"
            class="hexnav__node"
            :class="{ 'hexnav__node--hub': n.kind === 'hub', 'is-on': activeId === n.id || hoverId === n.id }"
            :style="{ '--node': `var(--${n.accent})` }"
            :href="routeOf(n)"
            :aria-label="`${n.lbl} — ${n.desc}`"
            @click.prevent="activate(n)"
            @mouseenter="hoverId = n.id"
            @mouseleave="hoverId = null"
            @focus="hoverId = n.id"
            @blur="hoverId = null"
          >
            <g :clip-path="`url(#hn-c-${n.id})`">
              <template v-if="n.kind === 'hub'">
                <polygon class="hexnav__hub-fill" :points="hexPts(n.cx, n.cy, R - 0.5)" />
                <Icon
                  class="hexnav__hub-icon"
                  :name="n.icon"
                  :x="n.cx - 10"
                  :y="n.cy - 19"
                  width="20"
                  height="20"
                />
                <text class="hexnav__hub-lbl" :x="n.cx" :y="n.cy + 7">{{ n.lbl }}</text>
                <text class="hexnav__hub-sub" :x="n.cx" :y="n.cy + 19">GAMO</text>
              </template>

              <template v-else>
                <polygon class="hexnav__face" :points="hexPts(n.cx, n.cy, R - 0.5)" />

                <!-- Zone média : toute la largeur de la tuile, du sommet jusqu'à
                     la bande de libellé. `slice` remplit sans bandes noires ; le
                     `clipPath` de l'hexagone se charge de tailler les angles. -->
                <image
                  v-if="n.img"
                  :href="n.img"
                  :x="n.cx - R"
                  :y="n.cy - HW"
                  :width="R * 2"
                  :height="HW"
                  preserveAspectRatio="xMidYMid slice"
                />
                <template v-else>
                  <rect
                    :x="n.cx - R"
                    :y="n.cy - HW"
                    :width="R * 2"
                    :height="HW"
                    :fill="`url(#hn-g-${n.id})`"
                  />
                  <!-- `Icon` rend un <svg>. Imbriqué dans celui de la carte, il
                       ignore le dimensionnement CSS de `.ds-icon` et retomberait sur
                       `width: 100%` — mesuré à 480 px de large dans une tuile de 138.
                       On lui passe donc `x`, `y`, `width` et `height` en attributs :
                       Vue les fait suivre jusqu'au <svg> racine du composant. -->
                  <Icon
                    class="hexnav__glyph"
                    :name="n.icon"
                    :x="n.cx - 14"
                    :y="n.cy - HW / 2 - 14"
                    width="28"
                    height="28"
                  />
                </template>

                <!-- Bande de libellé -->
                <rect class="hexnav__band" :x="n.cx - R" :y="n.cy" :width="R * 2" :height="TXT_H" />
                <text
                  class="hexnav__lbl"
                  :x="n.cx"
                  :y="n.cy + TXT_H / 2"
                  :textLength="n.lblWidth"
                  lengthAdjust="spacingAndGlyphs"
                >
                  {{ n.lbl }}
                </text>

                <!-- Bande d'année -->
                <rect
                  class="hexnav__band hexnav__band--year"
                  :x="n.cx - R"
                  :y="n.cy + TXT_H"
                  :width="R * 2"
                  :height="YR_H"
                />
                <line
                  class="hexnav__rule"
                  :x1="n.cx - R"
                  :y1="n.cy + TXT_H"
                  :x2="n.cx + R"
                  :y2="n.cy + TXT_H"
                />
                <text v-if="n.year" class="hexnav__year" :x="n.cx" :y="n.cy + TXT_H + YR_H / 2">
                  {{ n.year }}
                </text>
              </template>
            </g>

            <!-- Contour, hors du clip pour ne pas être rogné de moitié -->
            <polygon class="hexnav__outline" :points="hexPts(n.cx, n.cy, R - 1)" />
          </a>
        </svg>

        <button class="hexnav__close" :aria-label="t('nav.close')" @click="emit('close')">
          <Icon name="x" />
        </button>

        <div class="hexnav__bar">
          <span class="hexnav__pip" :class="{ 'is-on': hinted }" />
          <span class="hexnav__info" :class="{ 'is-on': hinted }">
            {{ hinted?.desc ?? t("nav.hint") }}
          </span>
        </div>
      </div>
    </Transition>
  </Teleport>
</template>

<style lang="scss" scoped>
@use "@gamo/ds/scss" as t;
// Les mixins ont leur propre spécificateur : `_tokens.scss` ne les réexporte pas.
@use "@gamo/ds/scss/mixins" as m;

.hexnav {
  position: fixed;
  inset: 0;
  // Au-dessus de l'en-tête du DS, qui occupe --z-header.
  z-index: 200;
  background: color-mix(in srgb, var(--void) 92%, transparent);

  &__svg {
    position: absolute;
    inset: 0;
    display: block;
    width: 100%;
    height: 100%;
  }
}

// ── Grille de fond ────────────────────────────────────────────────────────────
.hexnav__grid {
  opacity: 0.8;

  polygon {
    fill: var(--void);
    stroke: var(--card);
    stroke-width: 1;
  }
}

// ── Tuile ─────────────────────────────────────────────────────────────────────
.hexnav__node {
  cursor: pointer;
  // Les textes et images ne doivent pas voler le survol au lien lui-même.
  text,
  image,
  rect,
  line {
    pointer-events: none;
  }
}

.hexnav__face {
  fill: var(--surface);
}

.hexnav__outline {
  fill: none;
  stroke: var(--border);
  stroke-width: 1.5;
  transition:
    stroke var(--dur-base) var(--ease-out),
    filter var(--dur-base) var(--ease-out);
}

.hexnav__node.is-on .hexnav__outline,
.hexnav__node--hub .hexnav__outline {
  stroke: var(--node);
  stroke-width: 2;
}

.hexnav__node.is-on .hexnav__outline {
  filter: drop-shadow(0 0 10px color-mix(in srgb, var(--node) 50%, transparent));
}

// L'anneau de focus doit rester visible sur le contour coloré : on double le trait
// avec la couleur de texte, qui contraste sur tous les accents.
.hexnav__node:focus-visible {
  outline: none;

  .hexnav__outline {
    stroke: var(--text);
    stroke-width: 3;
  }
}

// ── Bandes et textes ──────────────────────────────────────────────────────────
.hexnav__band {
  fill: var(--surface);

  &--year {
    fill: var(--void);
  }
}

.hexnav__rule {
  stroke: color-mix(in srgb, var(--node) 45%, transparent);
  stroke-width: 1;
}

// Le registre monospace est celui de la carte : c'est une grille technique, pas
// une liste de libellés d'interface. JetBrains Mono remplace le Courier New écrit
// en dur dans chaque élément de texte de la version d'origine.
%hex-text {
  font-family: var(--font-mono);
  text-anchor: middle;
  dominant-baseline: middle;
}

.hexnav__glyph {
  color: var(--node);
  opacity: 0.88;
}

.hexnav__lbl {
  @extend %hex-text;
  fill: var(--muted);
  font-size: 16px;
  font-weight: 700;
  letter-spacing: 0.05em;
  transition: fill var(--dur-base) var(--ease-out);
}

.hexnav__node.is-on .hexnav__lbl {
  fill: var(--text);
}

// --faint est réservé au décoratif par le design system : l'année est du texte,
// elle prend donc --muted, qui passe AA sur --void.
.hexnav__year {
  @extend %hex-text;
  fill: var(--muted);
  font-size: 12px;
  letter-spacing: 0.12em;
}

// ── Hub ───────────────────────────────────────────────────────────────────────
.hexnav__hub-fill {
  fill: color-mix(in srgb, var(--node) 16%, transparent);
}

.hexnav__hub-icon {
  color: var(--node);
}

.hexnav__hub-lbl {
  @extend %hex-text;
  fill: var(--text);
  font-size: 11px;
  font-weight: 700;
  letter-spacing: 0.14em;
}

.hexnav__hub-sub {
  @extend %hex-text;
  fill: color-mix(in srgb, var(--node) 65%, transparent);
  font-size: 8.5px;
  letter-spacing: 0.22em;
}

// ── Dégradé de la zone média ──────────────────────────────────────────────────
.hexnav__grad-top {
  stop-color: var(--node);
  stop-opacity: 0.32;
}

.hexnav__grad-bottom {
  stop-color: var(--node);
  stop-opacity: 0.06;
}

// ── Habillage ─────────────────────────────────────────────────────────────────
.hexnav__close {
  position: absolute;
  top: 20px;
  right: 24px;
  z-index: 10;
  width: 32px;
  height: 32px;
  border: 1px solid var(--border);
  border-radius: t.radius(sm);
  background: color-mix(in srgb, var(--surface) 75%, transparent);
  color: var(--muted);
  font-family: var(--font-mono);
  font-size: t.text(sm);
  cursor: pointer;
  backdrop-filter: blur(4px);
  transition:
    color var(--dur-base) var(--ease-out),
    border-color var(--dur-base) var(--ease-out);

  &:hover {
    border-color: var(--lav);
    color: var(--text);
  }

  @include m.focus-ring;
}

.hexnav__bar {
  position: absolute;
  bottom: 24px;
  left: 50%;
  z-index: 10;
  display: flex;
  gap: 9px;
  align-items: center;
  padding: t.space(s2) t.space(s4);
  transform: translateX(-50%);
  border: 1px solid var(--border);
  border-radius: 999px;
  background: color-mix(in srgb, var(--surface) 75%, transparent);
  white-space: nowrap;
  pointer-events: none;
  backdrop-filter: blur(8px);
}

// Ce bandeau n'est PAS un composant du design system — celui-ci n'a rien pour une
// barre de statut flottante. Sa typographie s'aligne en revanche sur celle de
// `Badge` (Plus Jakarta Sans 11 px / 600, pastille de 6 px) : le registre mono est
// réservé au code, aux commandes et aux chemins, pas à une phrase.
.hexnav__pip {
  flex-shrink: 0;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: var(--muted);
  transition:
    background var(--dur-base) var(--ease-out),
    box-shadow var(--dur-base) var(--ease-out);

  &.is-on {
    background: var(--lav);
    box-shadow: 0 0 8px color-mix(in srgb, var(--lav) 55%, transparent);
  }
}

.hexnav__info {
  color: var(--muted);
  font-family: var(--font-body);
  font-size: t.text(xs);
  font-weight: 600;
  transition: color var(--dur-base) var(--ease-out);

  &.is-on {
    color: var(--lav);
  }
}

// ── Transition ────────────────────────────────────────────────────────────────
// Le `v-if` vit désormais À L'INTÉRIEUR du composant : dans la version d'origine
// le parent montait et démontait HexNav en entier, donc la transition ne jouait
// jamais.
.hexnav-enter-active,
.hexnav-leave-active {
  transition: opacity var(--dur-base) var(--ease-out);
}

.hexnav-enter-from,
.hexnav-leave-to {
  opacity: 0;
}

@media (prefers-reduced-motion: reduce) {
  .hexnav-enter-active,
  .hexnav-leave-active,
  .hexnav__outline,
  .hexnav__lbl,
  .hexnav__pip,
  .hexnav__info {
    transition: none;
  }
}
</style>
