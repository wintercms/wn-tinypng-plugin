# About

Automatically optimizes resized images with TinyPNG.

# Configuration

If you are using the [`.env` file](https://octobercms.com/docs/setup/configuration#dotenv-configuration) for configuration, simply add your [TinyPNG API Key](https://tinypng.com/dashboard/api) to the environment file as `TINYPNG_API_KEY`. If you are not using the `.env` file, simply copy `plugins/luketowers/tinypng/config/config.php` to `config/luketowers/tinypng/config.php` and change the value of `apiKey`.

That's it! This plugin will then start automatically optimizing images resized with the `| resize()` filter provided by the October CMS core.

>**NOTE:** This plugin will not cause existing resized images to be regenerated. If you would like to regenerate existing images then delete the existing generated images and the resizer will automatically regenerate them for you.

# Installation

To install from the [Marketplace](https://octobercms.com/plugin/luketowers-tinypng), click on the "Add to Project" button and then select the project you wish to add it to. Once the plugin has been added to the project, go to the backend and check for updates to pull in the plugin.

To install from the backend, go to **Settings -> Updates & Plugins -> Install Plugins** and then search for `LukeTowers.TinyPNG`.

To install from [the repository](https://github.com/luketowers/oc-tinypng-plugin), clone it into **plugins/luketowers/tinypng** and then run `composer update` from your project root in order to pull in the dependencies.

To install it with Composer, run `composer require luketowers/oc-tinypng-plugin` from your project root.