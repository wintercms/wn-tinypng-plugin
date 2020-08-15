<?php namespace LukeTowers\TinyPNG;

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
            'author'      => 'Luke Towers',
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
        if ($apiKey = Config::get('luketowers.tinypng::apiKey')) {
            Tinify::setKey($apiKey);

            // Process as late in the filter collection as possible to optimize the finished product
            Event::listen('system.resizer.afterResize', function ($resizer, $tempPath) {
                $source = Source::fromFile($tempPath);
                $source->toFile($tempPath);
            }, -9999);
        }
    }
}
