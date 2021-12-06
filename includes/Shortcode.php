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

    public function __construct($pluginFile)
    {
        $this->pluginFile = $pluginFile;
    }

    public function onLoaded()
    {
        add_shortcode('rrze_mustercontent', [$this, 'shortcodeOutput'], 10, 2);
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
            'type'                  => 'text',
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

        $this->data->unicode = Rabbithole::getSpecialCharset('debug', '2');
        $this->data->unicodeStandard = Rabbithole::getSpecialCharset('default', "1");

        $this->data->elementaccordion = SupportedShortcodes::accordeon(10, '');
        $this->data->elementalert = SupportedShortcodes::alert(Rabbithole::getSentence(Rabbithole::getWords()));
        $this->data->elementlatex = SupportedShortcodes::latex();

        /**
         * Following Arrays are getting 10 stacks of their elements to create individual content-placeholders.
         */
        $contentTypeParagraph = array(
            'paragraph',
            'citate',
        );

        $contentTypeSentence = array(
            'h',
            'citate',
            'caption',
            'list',
        );

        for ($i = 1; $i <= 10; $i++) {
            foreach ($contentTypeParagraph as $value) {
                $this->data->{$value . $i} = Rabbithole::getParagraph(Rabbithole::getWords());
            }
            foreach ($contentTypeSentence as $value) {
                $this->data->{$value . $i} = Rabbithole::getSentence(Rabbithole::getWords());
            }
            $this->data->{'htmlparagraph' . $i} = Rabbithole::getParagraphWithFormatting();
            $this->data->{'imgname' . $i} = Rabbithole::getRandomImage();
        }

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
