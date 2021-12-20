<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class Options
{
    protected static function known_themes()
    {
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

    public static function getKnownThemes()
    {
        return self::known_themes();
    }

    protected static function templates()
    {

        $testcontent_templates = array(
            "dynamic-text" => array(
                "pure-text",
                "text-bq",
                "standard",
            ),
            "dynamic-html-text" => array(
                "formatted-bq",
                "pure-formatted",
            ),
            "dynamic-table" => array(
                "dynamic-table-core",
            ),
            "unicode" => array(
                "all-unicode",
            ),
            "test" => array(
                "musterinhalt",
            ),
            "table" => array(
                "table-core",
            ),
            "long-text-article" => array(
                "long-text-article-core",
            ),
            "image" => array(
                "default-image",
            ),
            "img-lalign" => array(
                "leftalign-image",
            ),
            "img-ralign" => array(
                "rightalign-image",
            ),
            "img-center" => array(
                "imgcenter-image",
            ),
            "blockquote" => array(
                "default-blockquote",
            ),
            "list" => array(
                "standardlists",
            ),
            "code" => array(
                "standardcode",
            ),
        );
        return $testcontent_templates;
    }

    public static function getTemplates()
    {
        return self::templates();
    }
}
