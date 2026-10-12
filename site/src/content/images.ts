/**
 * Pipeline d'images.
 *
 * Les 25 images du portfolio sortent d'un appareil photo ou d'une capture d'écran :
 * 29 Mo bruts, jusqu'à 4032×3024 pour une vignette de 80 px à l'écran. Elles sont
 * redimensionnées et réencodées **au build** par `vite-imagetools`.
 *
 * Quatre variantes, calibrées sur les tailles de rendu **mesurées**, pas devinées :
 *
 * | Fonction     | Largeur | Rendu réel                        |
 * | ------------ | ------- | --------------------------------- |
 * | `nodeIcon()` | 320 px  | tuile HexNav, 140 px              |
 * | `card()`     | 160 px  | `ds-card-project__image`, 80 px   |
 * | `media()`    | 700 px  | colonne de la page projet, 340 px |
 * | `full()`     | 1600 px | visionneuse plein écran           |
 *
 * Chaque largeur vaut le double du rendu, pour les écrans à densité 2.
 *
 * On charge par `import.meta.glob` plutôt que par imports nommés : le module de
 * contenu désigne ses images par un chemin (`"ray/cable.jpeg"`), et un import
 * statique par image obligerait à tenir une liste en double.
 *
 * PNG et JPEG sont glob-és séparément parce que le **dernier format de la liste
 * sert de repli** dans un `<picture>` : un logo transparent replié en JPEG perdrait
 * son canal alpha et arriverait sur un aplat noir.
 *
 * Pas de directive `quality` : le défaut de sharp vaut 50 en AVIF et ~80 en JPEG.
 * Forcer une valeur unique s'applique à TOUS les formats et double le poids de
 * l'AVIF — or c'est lui que reçoivent les navigateurs modernes. Mesuré sur ce
 * dépôt : AVIF le plus lourd 128 Ko par défaut, 310 Ko avec `quality=72`.
 */

/** Sortie `as=picture` d'imagetools. */
export interface Picture {
  /** `{ avif: "…160w", webp: "…160w" }` — un srcset par format moderne. */
  sources: Record<string, string>
  /** Le repli, avec ses dimensions réelles après redimensionnement. */
  img: { src: string; w: number; h: number }
}

const PREFIX = "../assets/img/"

/** `"../assets/img/ray/cable.jpeg"` → `"ray/cable.jpeg"`. */
function keyed(...groups: Record<string, unknown>[]): Record<string, Picture> {
  const out: Record<string, Picture> = {}
  for (const group of groups) {
    for (const [path, mod] of Object.entries(group)) {
      out[path.slice(PREFIX.length)] = mod as Picture
    }
  }
  return out
}

// `withoutEnlargement` est le défaut d'imagetools : une image déjà plus petite que
// la cible n'est jamais agrandie.
const CARDS = keyed(
  import.meta.glob("../assets/img/**/*.{jpg,jpeg}", {
    eager: true,
    import: "default",
    query: "?w=160&format=avif;webp;jpg&as=picture",
  }),
  import.meta.glob("../assets/img/**/*.png", {
    eager: true,
    import: "default",
    query: "?w=160&format=avif;webp;png&as=picture",
  }),
)

const MEDIA = keyed(
  import.meta.glob("../assets/img/**/*.{jpg,jpeg}", {
    eager: true,
    import: "default",
    query: "?w=700&format=avif;webp;jpg&as=picture",
  }),
  import.meta.glob("../assets/img/**/*.png", {
    eager: true,
    import: "default",
    query: "?w=700&format=avif;webp;png&as=picture",
  }),
)

const FULLS = keyed(
  import.meta.glob("../assets/img/**/*.{jpg,jpeg}", {
    eager: true,
    import: "default",
    query: "?w=1600&format=avif;webp;jpg&as=picture",
  }),
  import.meta.glob("../assets/img/**/*.png", {
    eager: true,
    import: "default",
    query: "?w=1600&format=avif;webp;png&as=picture",
  }),
)

// Une tuile de HexNav est un `<image>` SVG : il ne sait pas faire de `srcset`, donc
// un format unique. WebP gère la transparence, il couvre logos et photos.
// 320 px = les 140 px de large de la tuile, doublés pour les écrans à densité 2.
const NODE_ICONS: Record<string, string> = {}
for (const [path, url] of Object.entries(
  import.meta.glob("../assets/img/**/*.{jpg,jpeg,png}", {
    eager: true,
    import: "default",
    query: "?w=320&format=webp&as=url",
  }),
)) {
  NODE_ICONS[path.slice(PREFIX.length)] = url as string
}

// Les vidéos ne passent pas par imagetools : Vite les copie telles quelles et
// l'import par défaut rend leur URL. Elles sont réencodées à la main avant d'être
// versées au dépôt (voir README) — les captures d'écran brutes font 12 Mbit/s.
const VIDEOS: Record<string, string> = {}
for (const [path, url] of Object.entries(
  import.meta.glob("../assets/img/**/*.{mp4,webm}", { eager: true, import: "default" }),
)) {
  VIDEOS[path.slice(PREFIX.length)] = url as string
}

/** Un chemin de galerie désigne-t-il une vidéo plutôt qu'une image ? */
export const isVideo = (path: string): boolean => /\.(mp4|webm)$/i.test(path)

/** URL d'une vidéo de galerie. */
export const video = (path: string): string | null => VIDEOS[path] ?? null

/**
 * Résolvent un chemin du module de contenu vers ses variantes.
 * Renvoient `null` sur un chemin inconnu plutôt que de lever : une image manquante
 * doit dégrader la page, pas la faire disparaître.
 */
export const card = (path: string): Picture | null => CARDS[path] ?? null
export const media = (path: string): Picture | null => MEDIA[path] ?? null
export const full = (path: string): Picture | null => FULLS[path] ?? null

/** URL WebP 96 px pour une tuile de la carte hexagonale. */
export const nodeIcon = (path: string): string | null => NODE_ICONS[path] ?? null

/** Tous les médias connus — sert au contrôle de cohérence du contenu. */
export function knownImages(): string[] {
  return [...Object.keys(CARDS), ...Object.keys(VIDEOS)].sort()
}
