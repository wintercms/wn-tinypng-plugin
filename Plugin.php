<?php namespace Winter\TinyPNG;

use Log;
use Event;
use Config;
use Backend;
use Tinify\Tinify;
use Tinify\Source;
use System\Classes\PluginBase;

/**
 * TinyPNG Plugin Information File
 */
class Plugin extends PluginBase
{
    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'TinyPNG',
            'description' => 'Automatically optimize resized images with TinyPNG',
            'author'      => 'Winter CMS',
            'icon'        => 'icon-bolt'
        ];
    }

    /**
     * Boot method, called right before the request route.
     *
     * @return array
     */
    public function boot()
    {
        if ($apiKey = Config::get('winter.tinypng::apiKey')) {
            Tinify::setKey($apiKey);

            // Process as late in the filter collection as possible to optimize the finished product
            Event::listen('system.resizer.afterResize', function ($resizer, $tempPath) {
                $supportedExtensions = ['jpg', 'jpeg', 'png'];
                if (in_array(pathinfo($tempPath, PATHINFO_EXTENSION), $supportedExtensions)) {
                    try {
                        $source = Source::fromFile($tempPath);
                        $source->toFile($tempPath);
                    } catch (\Exception $ex) {
                        $resizedImage = $resizer->getResizedUrl();
                        $sourcePath = $resizer->getConfig()['image']['path'];

                        // Log errors without breaking the resizing process
                        Log::info("TinyPNG failed to process $resizedImage (originally: $sourcePath). Error: " . $ex->getMessage());
                    }
                }
            }, -9999);
        }
    }
}
