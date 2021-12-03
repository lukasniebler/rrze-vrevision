<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;


use RRZE\vRevision\Shortcode;

/**
 * Hauptklasse (Main)
 */

class Main {
    /**
     * Der vollständige Pfad- und Dateiname der Plugin-Datei.
     * @var string
     */
    protected $pluginFile;

    /**
     * Variablen Werte zuweisen.
     * @param string $pluginFile Pfad- und Dateiname der Plugin-Datei
     */
    public function __construct($pluginFile){
        $this->pluginFile = $pluginFile;
    }

    /**
     * Es wird ausgeführt, sobald die Klasse instanziiert wird.
     */
    public function onLoaded() {
        //Shortcode-Klasse wird instanziiert.
        $shortcode = new Shortcode($this->pluginFile);
        $shortcode->onLoaded();
    }
}
