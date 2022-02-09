<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

/**
 * Shortcode
 */
class Shortcode
{
    protected $pluginFile;
    private $data;

    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
    }

    public function onLoaded()
    {
        add_shortcode('rrze_vrevision', [$this, 'shortcodeOutput'], 10, 2);
    }

    /**
     * Generieren Sie die Shortcode-Ausgabe
     * @param array $atts Shortcode-Attribute
     * @param string $content Beiligender Inhalt
     * @return string Gib den Inhalt zurück
     */
    public function shortcodeOutput($atts)
    {
        //merge given attributes with default ones
        $shortcode_attr = shortcode_atts(array(
            'type'                  => get_option('vrevision_modus'),
            'color'                 => get_option('vrevision_color'),
            'imgcontent'            => get_option('vrevision_theme'),
            'imgformat'             => get_option('vrevision_imgformat')
        ), $atts);

        $contenttype = $shortcode_attr['type'];
        $contentcolor = $shortcode_attr['color'];
        $imgcontent = $shortcode_attr['imgcontent'];
        $imgformat = $shortcode_attr['imgformat'];

        $html = $this->get_testcontent($contenttype, $contentcolor, $imgcontent, $imgformat);
        return $html;
    }

    public function get_testcontent(
        $type = 'post',
        $color = '',
        $imgcontent = 'mint',
        $imgformat = 'jpeg'
    ) {
        $generator = new Generator($this->pluginFile);
        $textgenerator = new Text();
        $imgname1 = $generator->getImgNames($imgcontent, $imgformat);
        $imgname2 = $generator->getImgNames($imgcontent, $imgformat);
        $imgname3 = $generator->getImgNames($imgcontent, $imgformat);
        $imgname4 = $generator->getImgNames($imgcontent, $imgformat);
        $supShortcodeClass = new SupportedShortcodes($this->pluginFile);
        
        $quotearray = $textgenerator->getQuote();
        $testcontent_templates = Options::getTemplates();

        $contentnum = $type;
        if (!isset($testcontent_templates[$type])) {
            $type = 'other';
        }
        if (!isset($this->data))
            $this->data = new \stdClass();

        /**
         * Load all required variables first
         */
        $this->data->contenttype = $type;
        $this->data->contentnum = $contentnum;
        $this->data->imgpath = trailingslashit(plugins_url('', $this->pluginFile));

        $this->data->unicode = $generator->getSpecialCharset('debug', '2');
        $this->data->unicodeStandard = $generator->getSpecialCharset('default', "1");

        $this->data->gettext = $textgenerator->getQuote();

        $this->data->img1024_1 = $generator->getImgpath('1024', $imgformat, $imgcontent, $imgname1);
        $this->data->img300_1 = $generator->getImgpath('300', $imgformat, $imgcontent, $imgname1);
        $this->data->img150_1 = $generator->getImgpath('150', $imgformat, $imgcontent, $imgname1);
        $this->data->imgOriginal_1 = $generator->getImgpath('original', $imgformat, $imgcontent, $imgname1);

        $this->data->img1024_2 = $generator->getImgpath('1024', $imgformat, $imgcontent, $imgname2);
        $this->data->img300_2 = $generator->getImgpath('300', $imgformat, $imgcontent, $imgname2);
        $this->data->img150_2 = $generator->getImgpath('150', $imgformat, $imgcontent, $imgname2);
        $this->data->imgOriginal_2 = $generator->getImgpath('original', $imgformat, $imgcontent, $imgname2);

        $this->data->img1024_3 = $generator->getImgpath('1024', $imgformat, $imgcontent, $imgname3);
        $this->data->img300_3 = $generator->getImgpath('300', $imgformat, $imgcontent, $imgname3);
        $this->data->img150_3 = $generator->getImgpath('150', $imgformat, $imgcontent, $imgname3);
        $this->data->imgOriginal_3 = $generator->getImgpath('original', $imgformat, $imgcontent, $imgname3);

        $this->data->img1024_4 = $generator->getImgpath('1024', $imgformat, $imgcontent, $imgname4);
        $this->data->img300_4 = $generator->getImgpath('300', $imgformat, $imgcontent, $imgname4);
        $this->data->img150_4 = $generator->getImgpath('150', $imgformat, $imgcontent, $imgname4);
        $this->data->imgOriginal_4 = $generator->getImgpath('original', $imgformat, $imgcontent, $imgname4);

        $this->data->author = $quotearray[1];
        $this->data->citate = $quotearray[0];

        $this->data->elementaccordion = $supShortcodeClass->accordeon(5, $color);
        $this->data->elementalert = SupportedShortcodes::alert(Text::getSentence('gutenberg'));
        $this->data->elementlatex = SupportedShortcodes::latex();

        /**
         * Load all the relevant Templates which rely on variables above
         */
        $this->data->blockquote = $this->getTemplateParts('blockquote');
        $this->data->table = $this->getTemplateParts('table');
        $this->data->longarticle = $this->getTemplateParts('post');
        $this->data->textmedium = $this->getTemplateParts('text-medium');
        $this->data->textmedium2 = $this->getTemplateParts('text-medium');
        $this->data->textlong = $this->getTemplateParts('text-long');
        $this->data->textlong2 = $this->getTemplateParts('text-long');
        $this->data->textshort = $this->getTemplateParts('text-short');

        $this->data->list = $this->getTemplateParts('list');
        $this->data->code = $this->getTemplateParts('code');
        $this->data->imglalign = $this->getTemplateParts('img-lalign');
        $this->data->imgralign = $this->getTemplateParts('img-ralign');
        $this->data->imgcenter = $this->getTemplateParts('img-center');
        $this->data->image = $this->getTemplateParts('image');

        if (!empty($name)) {
            $template = $type . '/' . $name;
        } else {
            $rand_key = array_rand($testcontent_templates[$type], 1);
            $template = $type . '/' . $testcontent_templates[$type][$rand_key];
        }
        $content = Template::getContent($template, $this->data);
        if (!empty($content)) {
            return $content;
        } else {
            $msg = "<!-- No Entry found for Error " . $type . "-->";
            return $msg;
        }
    }

    public function getTemplateParts($type = '')
    {
        $testcontent_templates = Options::getTemplates();
        if (!isset($testcontent_templates[$type])) {
            $type = 'other';
        }
        if (!isset($this->data))
            $this->data = new \stdClass();

        if (!empty($name)) {
            $template = $type . '/' . $name;
        } else {
            $rand_key = array_rand($testcontent_templates[$type], 1);
            $template = $type . '/' . $testcontent_templates[$type][$rand_key];
        }
        $content = Template::getContent($template, $this->data);
        if (!empty($content)) {
            return $content;
        } else {
            $msg = "<!-- No Entry found for Error " . $type . "-->";
            return $msg;
        }
    }
}
