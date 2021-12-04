<?php
namespace RRZE\vRevision;

defined('ABSPATH') || exit;

/**
 * Shortcode
 */
class Shortcode {
    protected $pluginFile;
    private $pluginname = '';
    private $data;

    public function __construct($pluginFile) {
        $this->pluginFile = $pluginFile;
    }

    public function onLoaded() {
        add_shortcode('rrze_mustercontent', [$this, 'shortcodeOutput'], 10, 2);
    }

    /**
     * Generieren Sie die Shortcode-Ausgabe
     * @param array $atts Shortcode-Attribute
     * @param string $content Beiligender Inhalt
     * @return string Gib den Inhalt zurück
     */
    public function shortcodeOutput( $atts ){
        //merge given attributes with default ones
        $shortcode_attr = shortcode_atts( array(
            'type'                  => 'text',
        ), $atts );

        $contenttype = $shortcode_attr['type'];
        
        $html = $this->get_testcontent($contenttype);
        return $html;
    }

    public function get_testcontent($type = 'other', $style = '') {
        $testcontent_templates = Options::getTemplates();

        $contentnum = $type;
        if (!isset($testcontent_templates[$type])) {
            $type = 'other';
        }
        if (!isset($this->data))
            $this->data = new \stdClass();
        
        $this->data->contenttype = $type;
        $this->data->contentnum = $contentnum;
        $this->data->imgpath = trailingslashit( plugins_url('', $this->pluginFile ) );

        /**
         * Creates Variables for Parser on Template-Sites
         */
        $contentTypeParagraph = array(
            'paragraph',
            'citate',
        );

        $contentTypeSentence = array(
            'h',
            'citate',
        );

        $contentTypeWord = array(
            'word',
            'author',
        );
        
        for ($i = 1; $i <= 10; $i++) {
            foreach ($contentTypeParagraph as $value) {
                $this->data->{$value . $i} = Rabbithole::getParagraph();
            } 
            foreach ($contentTypeSentence as $value) {
                $this->data->{$value . $i} = Rabbithole::getSentence();
            }
            foreach ($contentTypeWord as $value) {
                $this->data->{$value . $i} = Rabbithole::getWords();
            } 
        }

        if (!empty($name)) {
            $template = $type.'/'.$name;
        } else {
            $rand_key = array_rand($testcontent_templates[$type], 1);
            $template = $type.'/'.$testcontent_templates[$type][$rand_key];
        }
        $content = Template::getContent($template, $this->data);
        if (!empty($content)){
            return $content;
        } else {
            $msg = "<!-- No Entry found for Error ".$type."-->";
            return $msg;
        }
    }
}