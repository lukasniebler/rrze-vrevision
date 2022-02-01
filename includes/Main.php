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
        // Hook into the admin menu
        add_action('admin_menu', array( $this, 'create_plugin_settings_page'));
    }

    public function create_plugin_settings_page() {
        $page_title = 'RRZE vRevision Einstellungen';
        $menu_title = 'RRZE vRevision';
        $capability = 'manage_options';
        $slug = 'vRevision_fields';
        $callback = array ( $this, 'plugin_settings_page_content');
        add_submenu_page( 'options-general.php', $page_title, $menu_title, $capability, $slug, $callback);
    }

    public function plugin_settings_page_content() { ?>
        <div class="wrap">
            <h2>Musterinhalt Defaultwerte</h2>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'vRevision_fields' );
                    do_settings_sections( 'vRevision_fields' );
                    submit_button();
                ?>
            </form>
        </div> <?php
    }    

    /**
     * Es wird ausgeführt, sobald die Klasse instanziiert wird.
     */
    public function onLoaded()
    {
        //Shortcode-Klasse wird instanziiert.
        $shortcode = new Shortcode($this->pluginFile);
        $shortcode->onLoaded();
    }
}
