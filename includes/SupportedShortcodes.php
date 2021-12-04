<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class SupportedShortcodes{
    /**
     * Creates a RRZE Elements Accordeon. Count controls the number of individual slides.
     *
     * @param int $count - Controls number of accordeon-slides
     * @param string $color - nat | phil | rw | med | tf
     * @return string
     */
    public static function accordeon($count, $color){
        $extend = '';
        for ($i = 1; $i <= $count; $i++) {
            $extend .= '[collapse color="'.$color.'" title="'.Rabbithole::getSentence(Rabbithole::getWords()).'"]'.Rabbithole::getParagraphWithFormatting().'[/collapse]';
        };
        
        $output = do_shortcode('[collapsibles]'.$extend.'[/collapsibles]');
        return $output;
    }
}