let mix = require("laravel-mix");
let path = require("path");

require("laravel-mix-purgecss");

mix.webpackConfig((webpack) => {
	return {
		plugins: [
			new webpack.ProvidePlugin({
				$: "jquery",
				jQuery: "jquery",
				"window.jQuery": "jquery",
			}),
		],
		optimization: {
			minimize: false, // Minificatie volledig uitschakelen, ook in productie
		},
		output: {
			filename: "[name].js", // Houd de standaard bestandsnaam zonder .min.js
		},
	};
});

mix
	.extract(["@fancyapps/fancybox", "slick-slider"])
	.js("assets/js/app.js", "js") // Output naar dist/js/app.js
	.sass("assets/scss/app.scss", "css/app.css")
	.options({
		processCssUrls: false,
		postCss: [
			require("cssnano")({
				preset: [
					"default",
					{
						discardComments: { removeAll: true },
						normalizeWhitespace: true,
						minifyFontValues: false,
						convertValues: false,
						svgo: false,
					},
				],
			}),
		],
	})
	.copyDirectory("assets/images", "dist/images")
	.setPublicPath("dist")
	.purgeCss({
		content: [path.join(__dirname, "./**/*.php")],
		safelist: [
			/^btn-/,
			/^href/,
			/^is-/,
			/^fancybox-/,
			/^gform_/,
			/^ginput_/,
			/^lock/,
			/^block/,
			/^wpadminbar/,
			/^panel/,
			/^slick-/,
			/^js-/,
			/^spurt-logo/,
			/^stretched-link/,
			/^form-floating/,
			/^input/,
			/^select/,
			/^textarea/,
			/^form-control/,
			/^wpcf7-/,
			/^wpcf7-*/,
			/^grecaptcha-badge/,
			/grecaptcha-badge/,
		],
	});

// Hernoem CSS naar .min.css na afloop, maar laat JS ongemoeid
if (mix.inProduction()) {
	mix.after(() => {
		const fs = require("fs");

		// Hernoem CSS bestand naar .min.css
		const cssPath = "dist/css/app.css";
		const cssMinPath = "dist/css/app.min.css";
		if (fs.existsSync(cssPath)) {
			fs.renameSync(cssPath, cssMinPath);
		}
	});
}
