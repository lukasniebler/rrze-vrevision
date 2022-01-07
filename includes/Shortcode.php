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
            'type'                  => 'test',
        ), $atts);

        $contenttype = $shortcode_attr['type'];

        $html = $this->get_testcontent($contenttype);
        return $html;
    }

    public function get_testcontent($type = 'other', $style = '')
    {
        $generator = new Generator($this->pluginFile);
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
        
        $this->data->test = $generator->getImgNames("Workflow1024");
        $this->data->imagunA = $generator->getImgpath('1024','Workflow','Original');
        $this->data->imagunB = $generator->getImgpath('300','Workflow','Original');
        $this->data->imagunC = $generator->getImgpath('150','Workflow','Original');
        $this->data->imagunO = $generator->getImgpath('original','Workflow','Original');
        
        $this->data->elementaccordion = SupportedShortcodes::accordeon(10, '');
        $this->data->elementalert = SupportedShortcodes::alert('Content missing');
        $this->data->elementlatex = SupportedShortcodes::latex();

        /**
         * Load all the relevant Templates which rely on variables above
         */
        $this->data->table = $this->getTemplateParts('table');
        $this->data->longarticle = $this->getTemplateParts('long-text-article');
        $this->data->blockquote = $this->getTemplateParts('blockquote');

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