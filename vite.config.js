import { defineConfig } from "vite";
import { resolve } from "path";
import { copyFileSync, cpSync, existsSync, mkdirSync } from "fs";
import autoprefixer from "autoprefixer";
import purgecss from "@fullhuman/postcss-purgecss";

const isWatchMode = process.argv.includes("--watch") || Boolean(process.env.ROLLUP_WATCH);
const isProduction = process.env.NODE_ENV === "production" && !isWatchMode;

// PurgeCSS configuratie (alleen in productie)
const purgeCssPlugin = purgecss({
    content: ["./**/*.php", "./assets/js/**/*.js"],
    safelist: {
        standard: [
            /^btn-/,
            /^href/,
            /^is-/,
            /^fancybox-/,
            /^gform_/,
            /^ginput_/,
            /^lock/,
            /^block/,
            /^wpadminbar/,
            /^slick-/,
            // WordPress genereert deze body_class()-waarden zelf (nooit
            // letterlijk in theme-bestanden), dus zonder safelist worden
            // page-specifieke CSS-regels die erop scopen weggepurged.
            /^page-template-/,
            /^page-id-/,
            /^postid-/,
            // Contact Form 7 rendert zijn eigen markup/classes (net als
            // Gravity Forms hierboven) — nooit letterlijk in theme-bestanden.
            /^wpcf7-/,
            /^checkbox-wrapper/,
            // Google reCAPTCHA injecteert deze classes via zijn eigen script
            // (staan dus nooit in theme-bestanden en worden anders weggepurged).
            /^grecaptcha/,
            /^rc-anchor/
        ],
        // Behoud alle Bootstrap spacing utilities (m-, p-, gap-) met responsive prefixes
        greedy: [
            /^m[trblxy]?-/,
            /^p[trblxy]?-/,
            /^gap-/,
            /^g[xy]?-/,
            /^col-/,
            /^row-/,
            /^offset-/,
            /^order-/,
            /^d-/,
            /^flex-/,
            /^justify-/,
            /^align-/,
            /^text-/,
            /^bg-/,
            /^border-/,
            /^rounded-/,
            /^shadow-/,
            /^w-/,
            /^h-/,
            /^fw-/,
            /^fs-/,
            /^lh-/,
            /^position-/,
            /^top-/,
            /^bottom-/,
            /^start-/,
            /^end-/,
            /^overflow-/,
            /^opacity-/,
            /^z-/,
            /^visible/,
            /^invisible/
        ]
    }
});

export default defineConfig({
    root: ".",
    base: "./",

    build: {
        outDir: "dist",
        emptyOutDir: true,
        manifest: true,
        rollupOptions: {
            input: {
                app: resolve(__dirname, "assets/js/app.js"),
                styles: resolve(__dirname, "assets/scss/app.scss")
            },
            output: {
                entryFileNames: "js/[name].js",
                chunkFileNames: "js/[name]-[hash].js",
                assetFileNames: (assetInfo) => {
                    if (assetInfo.name?.endsWith(".css")) {
                        return "css/[name][extname]";
                    }
                    if (/\.(png|jpe?g|gif|svg|webp|ico)$/i.test(assetInfo.name || "")) {
                        return "images/[name][extname]";
                    }
                    if (/\.(woff2?|ttf|eot|otf)$/i.test(assetInfo.name || "")) {
                        return "fonts/[name][extname]";
                    }
                    return "assets/[name][extname]";
                }
            }
        },
        sourcemap: !isProduction
    },

    resolve: {
        alias: {
            "@": resolve(__dirname, "assets/js"),
            "~": resolve(__dirname, "assets/scss"),
            "jquery": resolve(__dirname, "node_modules/jquery/dist/jquery.js")
        }
    },

    css: {
        preprocessorOptions: {
            scss: {
                api: "modern-compiler",
                silenceDeprecations: [
                    "legacy-js-api",
                    "import",
                    "mixed-decls",
                    "color-functions",
                    "global-builtin",
                    "if-function"
                ],
                quietDeps: true,
                logger: {
                    warn: () => {}
                },
                loadPaths: [
                    resolve(__dirname, "node_modules"),
                    resolve(__dirname, "assets/scss")
                ]
            }
        },
        postcss: {
            plugins: [
                autoprefixer(),
                ...(isProduction ? [purgeCssPlugin] : [])
            ]
        }
    },

    server: {
        host: true,
        port: 5173,
        strictPort: true,
        origin: "http://localhost:5173",
        watch: {
            usePolling: false
        }
    },

    publicDir: false,

    plugins: [
        {
            name: "copy-images",
            writeBundle() {
                const imagesDir = resolve(__dirname, "dist/images");
                const cssDir = resolve(__dirname, "dist/css");

                // Zorg dat directories bestaan
                if (!existsSync(imagesDir)) mkdirSync(imagesDir, { recursive: true });
                if (!existsSync(cssDir)) mkdirSync(cssDir, { recursive: true });

                // Kopieer images directory
                if (existsSync(resolve(__dirname, "assets/images"))) {
                    cpSync(resolve(__dirname, "assets/images"), imagesDir, { recursive: true });
                }

                // Kopieer ajax-loader.gif naar css folder
                const ajaxLoader = resolve(__dirname, "assets/images/ajax-loader.gif");
                if (existsSync(ajaxLoader)) {
                    copyFileSync(ajaxLoader, resolve(cssDir, "ajax-loader.gif"));
                }
            }
        }
    ]
});
