<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class Rabbithole {
    public static function getWords() {
        $main = Alice::getMainWords();
        $keywords = Alice::getDifficultWords();
        $polyfill = Alice::getFillerWords();

        $words = array_merge($main, $keywords, $polyfill);
        shuffle($words);

        return $words;
    }

    public static function getSentence() {
        $words = Rabbithole::getWords();
        $randomNumber = rand(6, 10);
        $sentence = '';

        $words[0] = ucfirst($words[0]);

        if (count($words) > 0) {
            for ($i = 0; $i < $randomNumber; $i++) {
                $sentence .= $words[$i]." ";
            }
            $sentence = rtrim($sentence).".";
        }
        return $sentence;
    }

    public static function getParagraph() {
        $randomNumber = rand(3, 5);
        $paragraph = '';
        $output = '';
            for ($j = 0; $j < $randomNumber; $j++) {
                $paragraph .= Rabbithole::getSentence()." ";
            }
            $output .= "<p>".$paragraph."</p>";

        return $output;
    }

    public static function getSpecialCharset($type = 'default', $modus = '1') { //Debug
        if ($modus == 1){
            $standard = "— – ­ “ & ˆ ¡ ¦ ¨ ¯ ´ ¸ ¿ ˜ ‘ ’ ‚ “ ” „ ‹ › < > ± « » × ÷ ¢ £ ¤ ¥ § © ¬ ® ° µ ¶ · † ‡ ‰ € ¼ ½ ¾ ¹ ² ³ á Á â Â à À å Å ã Ã ä Ä ª æ Æ ç Ç ð Ð é É ê Ê è È ë Ë ƒ í Í î Î ì Ì ï Ï ñ Ñ ó Ó ô Ô ò Ò º ø Ø õ Õ ö Ö œ Œ š Š ß þ Þ ú Ú û Û ù Ù ü Ü ý Ý ÿ Ÿ";
            $paragraph = '<p>'.$standard.'</p>';
        } else if ($modus == 2){
            $unicode = "";
                for ($i = 0; $i<10626; $i++){
                    if($type == 'debug'){
                    $unicode .= '&#'.$i.";"." [$i] |";
                    } else if($type == 'default'){
                    $unicode .= '&#'.$i.";"." ";
                    };
                }   
            $paragraph = '<p>'.$unicode.'</p>';
            }

        return $paragraph;

    }
}