<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

use RRZE\vRevision\Shortcode;

class Main
{
    /**
     * Full path- and file name of plugin.
     * @var string
     */
    protected $pluginFile;

    /**
     * Variablen Werte zuweisen.
     * @param string $pluginFile Path and file name of plugin
     */
    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
        
    }
    
    public function onLoaded()
    {
        $shortcode = new Shortcode($this->pluginFile);
        $shortcode->onLoaded();

        new Settings();
    }
}
