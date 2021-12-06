<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

/**
 * Rabbithole creates Word & Sentence-Structures while Alice.php provides the necessary words & terms.
 */
class Rabbithole
{
    public static function getWords()
    {
        $main = Alice::getMainWords();
        $keywords = Alice::getDifficultWords();
        $polyfill = Alice::getFillerWords();

        $words = array_merge($main, $keywords, $polyfill);
        shuffle($words);

        return $words;
    }

    /**
     * Creates a new Sentence out of an array of words
     *
     * @param array of strings $input
     * @return string
     */

    public static function getSentence($input)
    {
        shuffle($input);
        $words = $input;
        $randomNumber = rand(6, 10);
        $sentence = '';

        $words[0] = ucfirst($words[0]);

        if (count($words) > 0) {
            for ($i = 0; $i < $randomNumber; $i++) {
                $sentence .= $words[$i] . " ";
            }
            $sentence = rtrim($sentence) . ".";
        }
        return $sentence;
    }

    /**
     * Creates a Paragraph out of a array of words. Surrounds the result with html paragraph-Tag
     *
     * @param array of strings $input
     * @return string
     */
    public static function getParagraph($input)
    {
        $randomNumber = rand(3, 5);
        $paragraph = '';
        $output = '';
        for ($j = 0; $j < $randomNumber; $j++) {
            $paragraph .= Rabbithole::getSentence($input) . " ";
        }
        $output .= "<p>" . $paragraph . "</p>";

        return $output;
    }

    /**
     * Creates Unicode-Characters as String with html paragraph-tag
     *
     * @param string $type debug shows the number of each unicode symbole in square brackets. type default shows no numbers.
     * @param string $modus 1 creates a list of common symbols - 2 generates all unicode-Symbols
     * @return string
     */
    public static function getSpecialCharset($type = 'default', $modus = '1')
    { //Debug
        if ($modus == 1) {
            $standard = "— – ­ “ & ˆ ¡ ¦ ¨ ¯ ´ ¸ ¿ ˜ ‘ ’ ‚ “ ” „ ‹ › < > ± « » × ÷ ¢ £ ¤ ¥ § © ¬ ® ° µ ¶ · † ‡ ‰ € ¼ ½ ¾ ¹ ² ³ á Á â Â à À å Å ã Ã ä Ä ª æ Æ ç Ç ð Ð é É ê Ê è È ë Ë ƒ í Í î Î ì Ì ï Ï ñ Ñ ó Ó ô Ô ò Ò º ø Ø õ Õ ö Ö œ Œ š Š ß þ Þ ú Ú û Û ù Ù ü Ü ý Ý ÿ Ÿ";
            $paragraph = '<p>' . $standard . '</p>';
        } else if ($modus == 2) {
            $unicode = "";
            for ($i = 0; $i < 10626; $i++) {
                if ($type == 'debug') {
                    $unicode .= '&#' . $i . ";" . " [$i] |";
                } else if ($type == 'default') {
                    $unicode .= '&#' . $i . ";" . " ";
                };
            }
            $paragraph = '<p>' . $unicode . '</p>';
        }

        return $paragraph;
    }

    /**
     * Creates an array of words with all common html formatting options. Returns array of words with html-tags.
     *
     * @param array of strings $input
     * @return array of strings
     */
    public static function getHtmlFormatting($input)
    {
        $elements = array(
            'b',
            'strong',
            'i',
            'em',
            'mark',
            'small',
            'del',
            'ins',
            'sub',
            'sup',
            'big',
            'u',
        );

        $convert = array();

        foreach ($elements as $value) {
            foreach ($input as $value2) {
                $convert[] = "<" . $value . ">" . $value2 . "</" . $value . ">";
            }
        }

        $words = Rabbithole::getWords();
        $mix = array_merge($convert, $words);
        shuffle($mix);
        //$output = implode(' ', $mix);

        return $mix;
    }

    /**
     * Creates a Sentence with words containing html-Formatting.
     *
     * @return string
     */
    public static function getHtmlSentence()
    {
        $output = Rabbithole::getSentence(Rabbithole::getHtmlFormatting(Rabbithole::getWords()));
        return $output;
    }

    /**
     * Creates a Paragraph with words which contain common html-Formatting
     *
     * @return string;
     */
    public static function getParagraphWithFormatting()
    {
        $output = Rabbithole::getParagraph(Rabbithole::getHtmlFormatting(Rabbithole::getWords()));
        return $output;
    }

    public static function getImageNames()
    {
        $fileNames = [];
        $imgDir = dirname(__FILE__, 2) . "/assets/img";

        $dir = new \DirectoryIterator($imgDir);
        foreach ($dir as $fileinfo) {
            if (!$fileinfo->isDot()) {
                $fileNames[] = ($fileinfo->getFilename());
            }
        }

        return $fileNames;
    }

    public static function getRandomImage()
    {
        $imgArray = Rabbithole::getImageNames();
        $random = rand(1, count($imgArray));

        return $imgArray[$random];
    }
}
