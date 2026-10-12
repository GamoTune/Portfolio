import type { AccentColor } from "@gamo/ds"
import type { HexNode, SocialLink, TimelineEntry } from "./types"

/**
 * La carte hexagonale, et donc le plan du site.
 *
 * Les icônes sont des noms du registre du design system, jamais des glyphes ni
 * des emoji. Six tuiles seulement les affichent — celles qui n'ont pas d'image ;
 * les autres gardent une icône de repli au cas où une image viendrait à manquer.
 *
 * Disposition d'origine, conservée : la **colonne centrale** (`q = 0`) porte les
 * sections, la **branche gauche** (`q < 0`) les projets du plus récent au plus
 * ancien en s'éloignant, la **branche droite** (`q > 0`) les expérimentations.
 *
 * Les couleurs sont des noms d'accent du design system, jamais des hex : le nœud
 * `parallax` était en `#FF4500`, l'ancien orange écarté du DS pour contraste
 * insuffisant, et devient donc `orange` (`#ff6a3d`).
 *
 * Faits vérifiés à la source : les textes viennent de l'ancien `main/texts.php`
 * (le site en ligne), les technologies de l'API GitHub des dépôts eux-mêmes.
 */
export const NODES: HexNode[] = [
  // ── Colonne centrale : le hub et les sections ───────────────────────────────
  { id: "base", kind: "hub", hex: { q: 0, r: 0 }, accent: "lav", icon: "home", route: "/" },
  { id: "parcours", kind: "section", hex: { q: 0, r: -2 }, accent: "yellow", icon: "flag", route: "/parcours" },
  { id: "stack", kind: "section", hex: { q: 0, r: -1 }, accent: "green", icon: "code", route: "/stack" },
  { id: "contact", kind: "section", hex: { q: 0, r: 1 }, accent: "pink", icon: "mail", route: "/contact" },
  { id: "about", kind: "section", hex: { q: 0, r: 2 }, accent: "lav", icon: "user", route: "/a-propos" },

  // ── Branche gauche : les projets ────────────────────────────────────────────
  {
    id: "eca",
    kind: "projet",
    hex: { q: -1, r: 0 },
    accent: "yellow",
    icon: "grid",
    year: "2023",
    context: "lycee",
    // eca_logo.png faisait 25×25 pour 300 octets — un gabarit, pas un logo.
    // ECA.jpg est la vraie capture, jusqu'ici inutilisée.
    image: "eca/ECA.jpg",
    github: "https://github.com/GamoTune/Electro_Cube_Adventure",
    tech: ["Python"],
    // Les cinq captures eca1…eca5 de l'ancien site renvoient 404 et n'existent
    // nulle part. Ce sont les démos filmées de la branche v2 qui les remplacent,
    // réencodées : 114 Mo de captures brutes à 12 Mbit/s pour 260 Ko au total.
    gallery: [
      "eca/eca_demo_intro.mp4",
      "eca/eca_editor.mp4",
      "eca/eca_demo_door.mp4",
      "eca/eca_demo_key_tp.mp4",
      "eca/eca_demo_tp.mp4",
      "eca/eca_demo_next.mp4",
      "eca/eca_demo_finish.mp4",
    ],
  },
  {
    id: "afterlife",
    kind: "projet",
    hex: { q: -2, r: 1 },
    accent: "lav",
    icon: "server",
    year: "2023",
    context: "perso",
    image: "afterlife_logo.jpg",
    github: "https://github.com/GamoTune/AfterLife",
    tech: ["Node.js", "discord.js"],
  },
  {
    id: "blackjack",
    kind: "projet",
    hex: { q: -2, r: 0 },
    accent: "lav",
    icon: "copy",
    year: "2024",
    context: "lycee",
    image: "blackjack_logo.jpg",
    github: "https://github.com/GamoTune/Mini_Projet_BlackJack/",
    tech: ["Node.js", "PHP"],
  },
  {
    id: "splatoon",
    kind: "projet",
    hex: { q: -3, r: 1 },
    accent: "pink",
    icon: "refresh",
    year: "2024",
    context: "perso",
    image: "judd.png",
    github: "https://github.com/GamoTune/Discord_Webhook_Splatoon_Rotations",
    tech: ["JavaScript", "PHP"],
    gallery: ["splatoon/normal.jpg", "splatoon/event.jpg", "splatoon/salmon.jpg"],
  },
  {
    id: "bash",
    kind: "projet",
    hex: { q: -4, r: 2 },
    accent: "lav",
    icon: "code",
    year: "2024",
    context: "iut",
    image: "bash_logo.png",
    github: "https://github.com/GamoTune/SAE1.03",
    tech: ["Bash"],
  },
  {
    id: "latice",
    kind: "projet",
    hex: { q: -3, r: 0 },
    accent: "lav",
    icon: "grid",
    year: "2025",
    context: "iut",
    // L'ancien site pointait sur une image hébergée dans le dépôt Latice ; elle
    // n'a pas été rapatriée, le nœud tombe donc sur son glyphe.
    github: "https://github.com/GamoTune/Latice",
    tech: ["Java", "JavaFX"],
  },
  {
    id: "roomviewer",
    kind: "projet",
    hex: { q: -4, r: 1 },
    accent: "green",
    icon: "eye",
    year: "2025",
    context: "perso",
    image: "room_viewer_logo.png",
    github: "https://github.com/gamotune/iut-room-viewer",
    tech: ["TypeScript", "JavaScript"],
    gallery: ["room_viewer/salles_mtn.jpg", "room_viewer/salles_entre.jpg"],
  },

  // ── Branche droite : les expérimentations ───────────────────────────────────
  {
    id: "ubuntu",
    kind: "expe",
    hex: { q: 1, r: -1 },
    accent: "cyan",
    icon: "server",
    year: "2023",
    context: "perso",
    image: "server/server_icon.jpeg",
    webpage: "https://server.gamo.one",
    gallery: ["server/server.jpeg", "server/ssh_login.jpeg"],
  },
  {
    id: "parallax",
    kind: "expe",
    hex: { q: 2, r: -1 },
    accent: "orange",
    icon: "image",
    year: "2023",
    context: "perso",
    image: "parallax_logo.jpg",
    todo: true,
  },
  {
    id: "ray",
    kind: "expe",
    hex: { q: 2, r: -2 },
    accent: "cyan",
    icon: "server",
    year: "2025",
    context: "perso",
    image: "ray/pc_icon.jpg",
    gallery: [
      "ray/pc.jpeg",
      "ray/cable.jpeg",
      "ray/stats.jpeg",
      "ray/linux_starting.jpeg",
    ],
  },
  {
    id: "lab",
    kind: "expe",
    hex: { q: 3, r: -1 },
    accent: "green",
    icon: "cloud",
    year: "2026",
    context: "perso",
    tech: ["Proxmox VE", "LXC", "Tailscale", "Cloudflare Tunnel", "Forgejo"],
    // Infrastructure privée, répartie sur deux réseaux locaux : rien à exposer
    // publiquement, donc aucun lien.
  },
  {
    id: "proxmox",
    kind: "expe",
    hex: { q: 3, r: -2 },
    accent: "cyan",
    icon: "server",
    year: "2025",
    context: "perso",
    image: "proxmox/pve1.jpg",
    gallery: [
      "proxmox/pve1.jpg",
      "proxmox/pve2.jpg",
      "proxmox/pve3.jpg",
      "proxmox/pve4.jpg",
      "proxmox/pve5.jpg",
    ],
    todo: true,
  },
]

/**
 * Ordre de la navigation.
 *
 * La sidebar **et** les numéros affichés par les `SectionHeader` en découlent
 * tous les deux. Ils avaient divergé parce que les numéros suivaient l'ordre
 * d'écriture des pages et non celui du panneau ; en les dérivant d'une seule
 * liste, la question ne peut plus se reposer.
 */
export const SECTION_KEYS = [
  "parcours",
  "stack",
  "contact",
  "about",
  "projects",
  "expes",
] as const

export type SectionKey = (typeof SECTION_KEYS)[number]

/** `"stack"` → `"02"`. */
export function sectionNumber(key: SectionKey): string {
  return String(SECTION_KEYS.indexOf(key) + 1).padStart(2, "0")
}

/** Accès direct par identifiant — le routeur en a besoin à chaque navigation. */
export const NODE_BY_ID: ReadonlyMap<string, HexNode> = new Map(
  NODES.map((n) => [n.id, n]),
)

/** La route d'un nœud : explicite, ou `/projet/<id>` par défaut. */
export function routeOf(node: HexNode): string {
  return node.route ?? `/projet/${node.id}`
}

/** Entrées de section de la sidebar, dans l'ordre canonique, accueil en tête. */
export const NAV_SECTIONS = [
  NODE_BY_ID.get("base")!,
  ...SECTION_KEYS.map((k) => NODE_BY_ID.get(k)).filter((n) => n !== undefined),
]

export const PROJETS = NODES.filter((n) => n.kind === "projet")
export const EXPES = NODES.filter((n) => n.kind === "expe")

/**
 * Compétences.
 *
 * Chaque entrée porte un identifiant stable ; le libellé affiché vit dans les
 * locales, sous `skills.<groupe>.items.<id>`. Accrocher la mise en avant à la
 * chaîne française aurait suffi tant que les deux locales sont identiques, mais
 * aurait rompu à la première traduction.
 *
 * `strong` marque ce qu'Arthur maîtrise le mieux ou préfère : ces badges prennent
 * l'accent du groupe, les autres restent neutres. C'est un seul mot-clé à ajouter
 * ou retirer par compétence.
 */
export interface Skill {
  id: string
  /** Mise en avant : le badge prend l'accent du groupe au lieu du gris. */
  strong?: boolean
}

export interface SkillGroup {
  accent: AccentColor
  items: Skill[]
}

export const SKILLS: Record<string, SkillGroup> = {
  langages: {
    accent: "lav",
    items: [
      { id: "python", strong: true },
      { id: "javascript-node-js", strong: true },
      { id: "typescript", strong: true },
      { id: "php", strong: true },
      { id: "java", strong: true },
      { id: "sql" },
      { id: "markdown" },
      { id: "html" },
    ],
  },
  frameworks: {
    accent: "cyan",
    items: [
      { id: "express-js" },
      { id: "discord-js" },
      { id: "three-js" },
      { id: "vite-js" },
      { id: "electron" },
    ],
  },
  bases: {
    accent: "green",
    items: [
      { id: "postgresql", strong: true },
      { id: "mysql" },
      { id: "ms-sql" },
      { id: "nosql" },
      { id: "mariadb" },
    ],
  },
  outils: {
    accent: "orange",
    items: [
      { id: "docker", strong: true },
      { id: "git", strong: true },
      { id: "ray" },
      { id: "apache2" },
      { id: "mamp" },
      { id: "phpmyadmin" },
      { id: "wine" },
    ],
  },
  logiciels: {
    accent: "pink",
    items: [
      { id: "vs-code" },
      { id: "xcode" },
      { id: "intellij" },
      { id: "eclipse" },
      { id: "figma" },
      { id: "termius" },
      { id: "filezilla" },
      { id: "utm" },
      { id: "ms-office" },
      { id: "apple-pages-numbers" },
    ],
  },
  os: {
    accent: "yellow",
    items: [
      { id: "macos" },
      { id: "windows" },
      { id: "linux-ubuntu-debian-arch", strong: true },
      { id: "ios" },
      { id: "android" },
    ],
  },
  langues: {
    accent: "cyan",
    items: [
      { id: "francais-natif", strong: true },
      { id: "anglais-b2" },
      { id: "espagnol-a2" },
    ],
  },
  perso: {
    accent: "green",
    items: [
      { id: "travail-en-equipe" },
      { id: "resolution-de-problemes" },
      { id: "adaptabilite" },
      { id: "curiosite" },
      { id: "creativite" },
    ],
  },
}

/** Ordre d'affichage des groupes. */
export const SKILL_GROUPS = Object.keys(SKILLS)

export const TIMELINE: TimelineEntry[] = [
  { id: "but", type: "education" },
  { id: "auto", type: "work" },
  { id: "bac", type: "education" },
]

export const SOCIAL: SocialLink[] = [
  { id: "github", url: "https://github.com/GamoTune", icon: "github" },
  { id: "linkedin", url: "https://linkedin.com/in/arthur-labregere", icon: "linkedin" },
  { id: "mail", url: "mailto:arthur.labregere@gmail.com", icon: "mail" },
  { id: "discord", url: "https://discord.com/users/429319137710440449", icon: "discord" },
]
