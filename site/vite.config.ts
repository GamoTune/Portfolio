import { defineConfig } from "vite"
import vue from "@vitejs/plugin-vue"
import { imagetools } from "vite-imagetools"
import { fileURLToPath, URL } from "node:url"

export default defineConfig({
  plugins: [vue(), imagetools()],

  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url)),
    },
  },

  css: {
    preprocessorOptions: {
      scss: {
        // Sass ne lit pas le champ `exports` d'un paquet : sans ce chemin de
        // recherche, `@use "@gamo/ds/design-system/tokens/tokens"` ne résout pas.
        loadPaths: [fileURLToPath(new URL("./node_modules", import.meta.url))],
      },
    },
  },

  // La sortie remplace l'ancien site PHP. `blackjack/` et `chimu/` vivent à côté,
  // dans le dossier parent, et ne sont donc jamais touchés par le vidage.
  build: {
    outDir: fileURLToPath(new URL("../main", import.meta.url)),
    emptyOutDir: true,
  },

  server: { port: 5174 },
})
