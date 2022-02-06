<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

class Generator
{
    protected $pluginFile;

    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
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
     * Returns an image-Filename out of the Workflow1024 Folder for reference.
     *
     * @return string
     */
    public function getImgNames($foldername, $targetDir){
        $dir = plugin_dir_path( __DIR__ );
        $path = $dir."assets/img/".$foldername.'/'.$targetDir;
        $files = array_diff(preg_grep('/^([^.])/', scandir($path)), array('..', '.'));
        $arrlength = count($files)-1;
        $randomNumber = rand(0, $arrlength);
        $output = $files[$randomNumber] ?? 'Function getImgNames could not retrieve the filename.';
        return $output;
    }

    /**
     * Returns a image path by setting the following parameters
     *
     * @param string $res Resolution | 1024, 300, 150 or original
     * @param string $foldername | prefix of Folder with different resolutions. f.e. imagefolder300 imagefolder1024 etc.
     * @param string $imgformat | JPEG or SVG
     * @param string $imgcontent | Occasion of content. For example default | mint | psychology...
     * @return string returns a imagepath
     */
    public function getImgpath($res, $imgformat, $imgcontent){
        $resolution = '';
        if ($imgformat === 'svg'){
            $resolution = 'svg';
            $urlpartial = 'assets/img/istanbul/'.$resolution.'/'.$this->getImgNames('istanbul', $resolution);
        } else if ($imgformat === 'jpeg') {
            switch($res) {
                case '1024':
                    $resolution = $imgcontent.'1024';
                    break;
                case '300':
                    $resolution = $imgcontent.'300';
                    break;
                case '150':
                    $resolution = $imgcontent.'150';
                    break;
                case 'original':
                    $resolution = $imgcontent;
                    break;
            }
              $urlpartial = 'assets/img/'.$imgcontent.'/'.$resolution.'/'.$this->getImgNames($imgcontent, $resolution);
        } else { 
            return 'The selected image file format is not supported.';
        }
        
        $dir = untrailingslashit(plugins_url($urlpartial, $this->pluginFile));
        return $dir;
    }
}