import { createI18n } from "vue-i18n"
import fr from "../locales/fr.json"
import en from "../locales/en.json"

/**
 * `en.json` porte pour l'instant les **valeurs françaises**, à la demande d'Arthur :
 * la structure bilingue est en place, la traduction viendra plus tard. Un `en.json`
 * partiel ferait tomber la moitié des clés sur le repli sans qu'on sache lesquelles ;
 * un doublon complet rend la traduction future mécanique — il suffit de traduire un
 * fichier, clé par clé, sans en chercher aucune.
 */
const saved = localStorage.getItem("locale")
const locale = saved === "fr" || saved === "en" ? saved : "fr"

export const i18n = createI18n({
  legacy: false,
  locale,
  fallbackLocale: "fr",
  messages: { fr, en },
})

export function setLocale(next: "fr" | "en") {
  i18n.global.locale.value = next
  localStorage.setItem("locale", next)
  document.documentElement.lang = next
}
