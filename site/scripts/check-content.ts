/**
 * Contrôle de cohérence du contenu.
 *
 * Le squelette précédent avait dérivé : les locales affirmaient « After Life · Python »
 * quand le site en ligne disait Node.js, et pointaient des images inexistantes. Rien ne
 * le signalait, parce que rien ne reliait les trois sources. Ce script le fait.
 *
 *   bun run check
 */
import { readdirSync, statSync, existsSync } from "node:fs"
import { join, relative } from "node:path"
import { NODES, SKILLS } from "../src/content/nodes"
import fr from "../src/locales/fr.json"

const IMG_ROOT = new URL("../src/assets/img", import.meta.url).pathname
const problems: string[] = []
const warnings: string[] = []

function walk(dir: string): string[] {
  return readdirSync(dir).flatMap((e) => {
    const p = join(dir, e)
    return statSync(p).isDirectory() ? walk(p) : [relative(IMG_ROOT, p)]
  })
}

const onDisk = new Set(walk(IMG_ROOT))
const referenced = new Set<string>()

for (const node of NODES) {
  // 1. Chaque nœud doit avoir un libellé et une description de tuile.
  const n = (fr.nodes as Record<string, { lbl?: string; desc?: string }>)[node.id]
  if (!n?.lbl) problems.push(`nodes.${node.id}.lbl manquant dans fr.json`)
  if (!n?.desc) problems.push(`nodes.${node.id}.desc manquant dans fr.json`)

  // 2. Un projet ou une expérimentation doit avoir un titre et du texte.
  if (node.kind === "projet" || node.kind === "expe") {
    const p = (fr.projects as Record<string, { title?: string; description?: string[] }>)[node.id]
    if (!p?.title) problems.push(`projects.${node.id}.title manquant dans fr.json`)
    const empty = !p?.description?.length
    if (empty && !node.todo) {
      problems.push(`projects.${node.id}.description est vide et le nœud n'est pas marqué todo`)
    }
    if (node.todo) warnings.push(`${node.id} : texte à écrire (todo)`)
  }

  // 3. Toute image citée doit exister sur le disque.
  for (const path of [node.image, ...(node.gallery ?? [])].filter(Boolean) as string[]) {
    referenced.add(path)
    if (!onDisk.has(path)) problems.push(`${node.id} cite une image absente : ${path}`)
  }
}

// 4. Une image non citée est du poids mort dans le dépôt.
for (const f of onDisk) {
  if (!referenced.has(f)) warnings.push(`image jamais citée : ${f}`)
}

// 5. Chaque compétence doit avoir son libellé, et chaque libellé sa compétence.
const frSkills = fr.skills as Record<string, { category?: string; items?: Record<string, string> }>
for (const [group, data] of Object.entries(SKILLS)) {
  const loc = frSkills[group]
  if (!loc?.category) problems.push(`skills.${group}.category manquant dans fr.json`)
  const declared = new Set(data.items.map((s) => s.id))
  for (const skill of data.items) {
    if (!loc?.items?.[skill.id]) {
      problems.push(`skills.${group}.items.${skill.id} manquant dans fr.json`)
    }
  }
  for (const id of Object.keys(loc?.items ?? {})) {
    if (!declared.has(id)) warnings.push(`libellé de compétence jamais affiché : ${group}.${id}`)
  }
}

// 6. Deux nœuds ne peuvent pas occuper la même case de la grille.
const seen = new Map<string, string>()
for (const node of NODES) {
  const key = `${node.hex.q},${node.hex.r}`
  const other = seen.get(key)
  if (other) problems.push(`collision de position ${key} entre ${other} et ${node.id}`)
  seen.set(key, node.id)
}

for (const w of warnings) console.log(`  avertissement : ${w}`)
if (problems.length) {
  console.error(`\n${problems.length} problème(s) :`)
  for (const p of problems) console.error(`  ✗ ${p}`)
  process.exit(1)
}
const skillCount = Object.values(SKILLS).reduce((n, g) => n + g.items.length, 0)
const strongCount = Object.values(SKILLS).reduce((n, g) => n + g.items.filter((s) => s.strong).length, 0)
console.log(
  `\n✓ ${NODES.length} nœuds cohérents (${onDisk.size} images sur disque)\n` +
    `  ${skillCount} compétences, dont ${strongCount} mises en avant`,
)
