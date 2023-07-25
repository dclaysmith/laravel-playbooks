// vite.config.js
import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import vue from "@vitejs/plugin-vue";

export default defineConfig({
    plugins: [vue(), laravel(["resources/admin/src/admin.js"])],
    build: {
        rollupOptions: {
            output: {
                entryFileNames: "js/[name].js",
                chunkFileNames: "js/[name].js",
                assetFileNames: (assetInfo) => {
                    if (/\.css$/.test(assetInfo.name)) {
                        return "css/admin[extname]";
                    }
                    return "img/[name][extname]";
                },
            },
        },
    },
});
