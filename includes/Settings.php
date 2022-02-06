<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class Settings
{
    public function __construct()
    {
        // Hook into the admin menu
        add_action('admin_menu', array($this, 'create_plugin_settings_page'));
        add_action('admin_init', array($this, 'setup_sections'));
        add_action('admin_init', array($this, 'setup_fields'));
    }
    public function setup_fields()
    {
        $fields = array(
            array(
                'uid' => 'vrevision_theme',
                'label' => 'Bildmotive',
                'section' => 'our_first_section',
                'type' => 'select',
                'options' => array(
                    'istanbul' => 'Istanbul',
                    'medicine' => 'Medizin',
                    'microscopy' => 'Mikroskopie-Aufnahmen',
                    'mint' => 'MINT',
                ),
                'placeholder' => 'Text goes here',
                'helper' => 'Steuert das Bildmotiv.',
                'supplemental' => '',
                'default' => 'microscopy',
            ),
            array(
                'uid' => 'vrevision_imgformat',
                'label' => 'Bildformat',
                'section' => 'our_first_section',
                'type' => 'select',
                'options' => array(
                    'jpeg' => 'JPEG',
                    'svg' => 'SVG',
                ),
                'placeholder' => 'Text goes here',
                'helper' => 'Wählt das Bildformat. SVG deaktiviert die Auswahlmöglichkeit des Bildmotivs. Alle SVG-Files sind Illustrationen von manypixels.co',
                'supplemental' => '',
                'default' => 'jpeg',
            ),
            array(
                'uid' => 'vrevision_color',
                'label' => 'Fakultätsfarbe',
                'section' => 'our_first_section',
                'type' => 'select',
                'options' => array(
                    '' => 'zentrale Einrichtungen',
                    'rw' => 'rw',
                    'med' => 'med',
                    'nat' => 'nat',
                    'phil' => 'phil',
                    'tf' => 'tf',
                ),
                'placeholder' => 'Text goes here',
                'helper' => 'Steuert die Farbausgabe der Akkordeons, Alerts und Elemente.',
                'supplemental' => '',
                'default' => 'zentral'
            ),
            array(
                'uid' => 'vrevision_modus',
                'label' => 'Darstellung',
                'section' => 'our_first_section',
                'type' => 'select',
                'options' => array(
                    'post' => 'Lange Beiträge',
                    'text-medium' => 'Kurze Texte',
                    'text-long' => 'Lange Texte',
                    'list' => 'Listen',
                    'unicode' => 'Unicode',
                    'test' => 'Test-Templates',
                ),
                'placeholder' => 'Text goes here',
                'helper' => 'Setzt den Default für die Auswahl der jeweiligen Templates.',
                'supplemental' => 'Steuert den Defaultwert der Darstellung.',
                'default' => 'post',
            ),
        );
        foreach ($fields as $field) {
            add_settings_field($field['uid'], $field['label'], array($this, 'field_callback'), 'vRevision_fields', $field['section'], $field);
            register_setting('vRevision_fields', $field['uid']);
        }
    }

    public function field_callback($arguments)
    {
        $value = get_option($arguments['uid']); // Get the current value, if there is one
        if (!$value) { // If no value exists
            $value = $arguments['default']; // Set to our default
        }

        // Check which type of field we want
        switch ($arguments['type']) {
            case 'text':
                printf('<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />', $arguments['uid'], $arguments['type'], $arguments['placeholder'], $value);
                break;
            case 'textarea':
                printf('<textarea name="%1$s" id="%1$s" placeholder="%2$s" rows="5" cols="50">%3$s</textarea>', $arguments['uid'], $arguments['placeholder'], $value);
                break;
            case 'select':
                if (!empty($arguments['options']) && is_array($arguments['options'])) {
                    $options_markup = '';
                    foreach ($arguments['options'] as $key => $label) {
                        $options_markup .= sprintf('<option value="%s" %s>%s</option>', $key, selected($value, $key, false), $label);
                    }
                    printf('<select name="%1$s" id="%1$s">%2$s</select>', $arguments['uid'], $options_markup);
                }
                break;
        }


        // If there is help text
        if ($helper = $arguments['helper']) {
            printf('<span class="helper"> %s</span>', $helper); // Show it
        }

        // If there is supplemental text
        if ($supplimental = $arguments['supplemental']) {
            printf('<p class="description">%s</p>', $supplimental); // Show it
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
            <h2>RRZE vRevision Einstellungen</h2>
            <p>Das Setzen des Default-Werts erlaubt es mit der Kurzform der Shortcodes, schneller passende Inhaltstypen zu erstellen, oder passend zum Theme die Farben oder Bild-Motive zu wechseln.</p>
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
        add_settings_section('our_first_section', 'Einstellung der Default-Werte', false, 'vRevision_fields');
    }
    public function section_callback($arguments)
    {
        echo 'Hello World!';
    }
}
