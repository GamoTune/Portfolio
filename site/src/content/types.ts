import type { AccentColor, IconName } from "@gamo/ds"

/**
 * Position dans la grille hexagonale de HexNav (coordonnées axiales).
 * `q` court vers la droite, `r` vers le bas-droite.
 */
export interface HexPos {
  q: number
  r: number
}

/** Ce qu'une tuile de HexNav mène à afficher. */
export type NodeKind =
  /** Le centre de la carte : la page d'accueil. */
  | "hub"
  /** Une réalisation, listée sous « Projets ». */
  | "projet"
  /** Un bricolage d'infrastructure, listé sous « Expérimentations ». */
  | "expe"
  /** Une page de section : stack, parcours, à propos, contact. */
  | "section"

/**
 * Un nœud de la carte.
 *
 * Tout ce qui est ici est **indépendant de la langue** : les textes (libellé,
 * description, paragraphes) vivent dans les fichiers de locale, sous la clé de
 * l'identifiant. Un `id` est donc à la fois la clé de routage, la clé de
 * traduction et l'ancre dans la grille.
 */
export interface HexNode {
  id: string
  kind: NodeKind
  hex: HexPos
  accent: AccentColor
  /**
   * Icône affichée quand le nœud n'a pas d'image. `IconName` et non `string` :
   * seules les icônes du design system sont admises, et une faute de frappe
   * devient une erreur de compilation.
   */
  icon: IconName
  /** Année affichée sous le libellé. Vide pour les sections. */
  year?: string
  /** Chemin dans `src/assets/img/`, résolu par `content/images.ts`. */
  image?: string
  /** Route interne visée. Déduite de `id` si absente. */
  route?: string
  github?: string
  webpage?: string
  /** Chemins d'images, mêmes clés que `image`. */
  gallery?: string[]
  /** Technologies, relevées sur le dépôt lui-même — jamais devinées. */
  tech?: string[]
  /**
   * Cadre de réalisation, déduit des descriptions du site en ligne :
   * `lycee` pour les projets NSI, `iut` pour les SAE, `perso` pour le reste.
   */
  context?: "lycee" | "iut" | "perso"
  /**
   * Marque un nœud dont le texte reste à écrire. La page s'affiche quand même,
   * avec un avertissement visible plutôt qu'un contenu inventé.
   */
  todo?: boolean
}

export interface TimelineEntry {
  id: string
  type: "education" | "work"
}

export interface SocialLink {
  id: string
  url: string
  /**
   * Clé rendue par `components/SocialIcon.vue`.
   *
   * Les trois marques gardent leur logo officiel : un design system générique
   * n'a pas à porter des marques tierces, et le rendu au trait du composant
   * `Icon` les rendrait méconnaissables. `mail` n'est pas une marque et prend
   * donc l'icône du DS.
   */
  icon: "github" | "linkedin" | "mail" | "discord"
}
