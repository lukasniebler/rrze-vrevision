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

        $this->data->unicode = Rabbithole::getSpecialCharset('debug', '2');
        $this->data->unicodeStandard = Rabbithole::getSpecialCharset('default', "1");

        $this->data->elementaccordion = SupportedShortcodes::accordeon(10, '');
        $this->data->elementalert = SupportedShortcodes::alert(Rabbithole::getSentence(Rabbithole::getWords()));
        $this->data->elementlatex = SupportedShortcodes::latex();
        $this->data->table = $this->getTemplateParts('table');
        $this->data->longarticle = $this->getTemplateParts('long-text-article');
        $this->data->image = $this->getTemplateParts('image');
        $this->data->blockquote = $this->getTemplateParts('blockquote');

        $this->data->list = $this->getTemplateParts('list');
        $this->data->code = $this->getTemplateParts('code');
        $this->data->test = $this->getImgNames("Workflow1024");
        $this->data->imagunA = $this->getImgpath('1024','Workflow','Original');
       
        //$this->data->imagun1024 = $this->getImgpath('1024','Workflow','Original');
        $this->data->imagunB = $this->getImgpath('300','Workflow','Original');
        $this->data->imagunC = $this->getImgpath('150','Workflow','Original');
        $this->data->imagunO = $this->getImgpath('original','Workflow','Original');
        $this->data->imglalign = $this->getTemplateParts('img-lalign');
        $this->data->imgralign = $this->getTemplateParts('img-ralign');
        $this->data->imgcenter = $this->getTemplateParts('img-center');

        //$this->data->img1024 = $this->

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
            var_dump($content);
            return $content;
        } else {
            $msg = "<!-- No Entry found for Error " . $type . "-->";
            return $msg;
        }
    }
    /**
     * Returns an image-Filename out of the Workflow1024 Folder for reference.
     *
     * @return string
     */
    public function getImgNames($targetDir){
        $dir = plugin_dir_path( __DIR__ );
        $path = $dir."assets/img/".$targetDir;
        $files = array_diff(scandir($path), array('..', '.'));
        $randomNumber = rand(2, count($files));
        
        return $files[$randomNumber] ?? null;
    }

    /**
     * Returns a image path by setting the following parameters
     *
     * @param string $res Resolution | 1024, 300, 150 or original
     * @param string $foldername | prefix of Folder with different resolutions. f.e. imagefolder300 imagefolder1024 etc.
     * @param string $ref | Foldername of original-files
     * @return string returns a imagepath
     */
    public function getImgpath($res, $foldername, $ref){
        $resolution = '';
        switch($res) {
            case '1024':
                $resolution = $foldername.'1024';
                break;
            case '300':
                $resolution = $foldername.'300';
                break;
            case '150':
                $resolution = $foldername.'150';
                break;
            case 'original':
                $resolution = $ref;
                break;
        }
        $urlpartial = 'assets/img/'.$resolution.'/'.$this->getImgNames($resolution);
        $dir = untrailingslashit(plugins_url($urlpartial, $this->pluginFile));
        var_dump($dir);
        return $dir;
    }
    
}