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
        add_action('admin_menu', array($this, 'create_plugin_settings_page'));
        add_action('admin_init', array($this, 'setup_sections'));
        add_action('admin_init', array($this, 'setup_fields'));
    }

    public function setup_fields() {
        $fields = array(
            array(
                'uid' => 'our_first_field',
                'label' => 'Awesome Date',
                'section' => 'our_first_section',
                'type' => 'text',
                'options' => false,
                'placeholder' => 'DD/MM/YYYY',
                'helper' => 'Does this help?',
                'supplemental' => 'I am underneath!',
                'default' => '01/01/2015'
            )
        );
        foreach( $fields as $field ){
            add_settings_field( $field['uid'], $field['label'], array( $this, 'field_callback' ), 'vRevision_fields', $field['section'], $field );
            register_setting( 'vRevision_fields', $field['uid'] );
        }
    }

    public function field_callback( $arguments ) {
        $value = get_option( $arguments['uid'] ); // Get the current value, if there is one
        if( ! $value ) { // If no value exists
            $value = $arguments['default']; // Set to our default
        }
    
        // Check which type of field we want
        switch( $arguments['type'] ){
            case 'text': // If it is a text field
                printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value );
                break;
        }
    
        // If there is help text
        if( $helper = $arguments['helper'] ){
            printf( '<span class="helper"> %s</span>', $helper ); // Show it
        }
    
        // If there is supplemental text
        if( $supplimental = $arguments['supplemental'] ){
            printf( '<p class="description">%s</p>', $supplimental ); // Show it
        }
    }

    public function create_plugin_settings_page()
    {
        $page_title = 'RRZE vRevision Einstellungen';
        $menu_title = 'RRZE vRevision';
        $capability = 'manage_options';
        $slug = 'vRevision_fields';
        $callback = array($this, 'plugin_settings_page_content');
        add_submenu_page('options-general.php', $page_title, $menu_title, $capability, $slug, $callback);
    }

    public function plugin_settings_page_content()
    { ?>
        <div class="wrap">
            <h2>Musterinhalt Defaultwerte</h2>
            <form method="post" action="options.php">
                <?php
                settings_fields('vRevision_fields');
                do_settings_sections('vRevision_fields');
                submit_button();
                ?>
            </form>
        </div> <?php
            }

            public function setup_sections()
            {
                add_settings_section('our_first_section', 'My First Section Title', false, 'vRevision_fields');
            }

            public function section_callback($arguments)
            {
                echo 'Hello World!';
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
