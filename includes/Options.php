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
            "unicode" => array(
                "all-unicode",
            ),
            "test" => array(
                "musterinhalt",
            ),
            "table" => array(
                "table-core",
            ),
            "post" => array(
                "long-text-article-core",
                "long-text-article-2",
                "long-text-article-3",
                "long-text-article-4",
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
            "text-long" => array(
                "kriminalfall",
                "henry-d-thoreau",
                "marie-antoinette",
            ),
            "text-medium" => array(
                "darwin-entstehung-der-arten-1",
                "darwin-entstehung-der-arten-2",
                "darwin-entstehung-der-arten-3",
                "darwin-entstehung-der-arten-4",
                "darwin-entstehung-der-arten-5",
            ),
            "text-short" => array(
                "short-darwin-entstehung-der-arten-1",
                "short-darwin-entstehung-der-arten-2",
                "short-darwin-entstehung-der-arten-3",
                "short-darwin-entstehung-der-arten-4",
                "short-darwin-entstehung-der-arten-5",
            ),
        );
        return $testcontent_templates;
    }

    public static function getTemplates()
    {
        return self::templates();
    }
}
