<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class Options {
    protected static function known_themes() {
        $known_themes = array(
            'fauthemes' => [
                'FAU-Einrichtungen',
                'FAU-Einrichtungen-BETA',
                'FAU-Medfak',
                'FAU-RWFak',
                'FAU-Philfak',
                'FAU-Techfak',
                'FAU-Natfak',
                'FAU-Blog',
                'FAU-Jobs'
            ],
            'rrzethemes' => [
                'RRZE 2019',
            ],
        );
    
    
        return $known_themes;
    
    }

    public static function getKnownThemes() {
        return self::known_themes();
    
        }

    protected static function templates() {
        
        $testcontent_templates = array(
            "text" => array(
                "pure-text",
                "text-bq",
            ),
            "html-formatted" => array(
                "formatted-bq",
                "pure-formatted",
            ),
        );
        return $testcontent_templates;
    }

    public static function getTemplates() {
        return self::templates();
    }
}
