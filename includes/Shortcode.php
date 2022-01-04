<?php

namespace RRZE\vRevision;

defined('ABSPATH') || exit;

/**
 * Shortcode
 */
class Shortcode
{
    protected $pluginFile;
    private $pluginname = '';
    private $data;
    private $generator = new Generator;

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
            'type'                  => 'test',
        ), $atts);

        $contenttype = $shortcode_attr['type'];

        $html = $this->get_testcontent($contenttype);
        return $html;
    }

    public function get_testcontent($type = 'other', $style = '')
    {
        $testcontent_templates = Options::getTemplates();

        $contentnum = $type;
        if (!isset($testcontent_templates[$type])) {
            $type = 'other';
        }
        if (!isset($this->data))
            $this->data = new \stdClass();

        $this->data->contenttype = $type;
        $this->data->contentnum = $contentnum;
        $this->data->imgpath = trailingslashit(plugins_url('', $this->pluginFile));

        $this->data->unicode = $this->generator->getSpecialCharset('debug', '2');
        $this->data->unicodeStandard = $this->generator->getSpecialCharset('default', "1");

        $this->data->table = $this->getTemplateParts('table');
        $this->data->longarticle = $this->getTemplateParts('long-text-article');
        $this->data->image = $this->getTemplateParts('image');
        $this->data->blockquote = $this->getTemplateParts('blockquote');

        $this->data->list = $this->getTemplateParts('list');
        $this->data->code = $this->getTemplateParts('code');
        $this->data->test = $this->generator->getImgNames("Workflow1024");
        $this->data->imagunA = $this->generator->getImgpath('1024','Workflow','Original');
       
        //$this->data->imagun1024 = $this->getImgpath('1024','Workflow','Original');
        $this->data->imagunB = $this->generator->getImgpath('300','Workflow','Original');
        $this->data->imagunC = $this->generator->getImgpath('150','Workflow','Original');
        $this->data->imagunO = $this->generator->getImgpath('original','Workflow','Original');
        $this->data->imglalign = $this->getTemplateParts('img-lalign');
        $this->data->imgralign = $this->getTemplateParts('img-ralign');
        $this->data->imgcenter = $this->getTemplateParts('img-center');

        //$this->data->img1024 = $this->

        /**
         * Following Arrays are getting 10 stacks of their elements to create individual content-placeholders.
         */

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

        $contentnum = $type;
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