<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class SupportedShortcodes
{
    /**
     * Creates a RRZE Elements Accordeon. Count controls the number of individual slides.
     *
     * @param int $count - Controls number of accordeon-slides
     * @param string $color - nat | phil | rw | med | tf
     * @return string
     */
    public static function accordeon($count, $color)
    {
        $extend = '';
        for ($i = 1; $i <= $count; $i++) {
            $extend .= '[collapse color="' . $color . '" title="' . Text::getHeadline() . '"]' . "Missing logic" . '[/collapse]';
        };

        $output = do_shortcode('[collapsibles]' . $extend . '[/collapsibles]');
        return $output;
    }

    /**
     * Creates a RRZE Elements Alert with a String-Content passed into the function.
     *
     * @param string $content
     * @return string
     */
    public static function alert($content)
    {
        $output = do_shortcode('[alert]' . $content . '[/alert]');
        return $output;
    }

    public static function latex()
    {
        $output = do_shortcode('[latex]
        f(x) = \int_{-\infty}^\infty
        \hat f(\xi)\,e^{2 \pi i \xi x}
        \,d\xi
        [/latex]');
        return $output;
    }
}
