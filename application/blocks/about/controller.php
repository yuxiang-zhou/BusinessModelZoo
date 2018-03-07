<?php  namespace Application\Block\About;

defined("C5_EXECUTE") or die("Access Denied.");

use Concrete\Core\Block\BlockController;
use Core;
use Loader;
use \File;
use Page;
use URL;
use \Concrete\Core\Editor\Snippet;
use Sunra\PhpSimple\HtmlDomParser;
use \Concrete\Core\Editor\LinkAbstractor;

class Controller extends BlockController
{
    public $helpers = array (
  0 => 'form',
);
    public $btFieldsRequired = array (
  0 => 'employee',
  1 => 'info',
);
    protected $btExportFileColumns = array (
  0 => 'employee',
);
    protected $btTable = 'btAbout';
    protected $btInterfaceWidth = 400;
    protected $btInterfaceHeight = 500;
    protected $btCacheBlockRecord = true;
    protected $btCacheBlockOutput = true;
    protected $btCacheBlockOutputOnPost = true;
    protected $btCacheBlockOutputForRegisteredUsers = true;
    protected $btCacheBlockOutputLifetime = 0;
    protected $pkg = false;
    
    public function getBlockTypeDescription()
    {
        return t("");
    }

    public function getBlockTypeName()
    {
        return t("About people");
    }

    public function getSearchableContent()
    {
        $content = array();
        $content[] = $this->info;
        return implode(" ", $content);
    }

    public function on_start()
    {
        $al = \Concrete\Core\Asset\AssetList::getInstance();
        $this->requireAsset('core/file-manager');
    }

    public function view()
    {
        $db = \Database::get();
        
        if ($this->employee && ($f = \File::getByID($this->employee)) && is_object($f)) {
            $this->set("employee", $f);
        }
        else {
            $this->set("employee", false);
        }
        $this->set('info', LinkAbstractor::translateFrom($this->info));
    }

    public function add()
    {
        $this->requireAsset('redactor');
        $this->requireAsset('core/file-manager');
        $this->set('btFieldsRequired', $this->btFieldsRequired);
    }

    public function edit()
    {
        $db = \Database::get();
        $this->requireAsset('redactor');
        $this->requireAsset('core/file-manager');
        $this->set('info', LinkAbstractor::translateFromEditMode($this->info));
        $this->set('btFieldsRequired', $this->btFieldsRequired);
    }

    public function save($args)
    {
        $db = \Database::get();
        $args['info'] = LinkAbstractor::translateTo($args['info']);
        parent::save($args);
    }

    public function validate($args)
    {
        $e = Core::make("helper/validation/error");
        if (in_array("employee", $this->btFieldsRequired) && (trim($args["employee"]) == "" || !is_object(\File::getByID($args["employee"])))){
            $e->add(t("The %s field is required.", "Employee"));
        }
        if (in_array("info", $this->btFieldsRequired) && (trim($args["info"]) == "")) {
            $e->add(t("The %s field is required.", "Info about employee"));
        }
        return $e;
    }

    public function composer()
    {
        if (file_exists('application/blocks/about/auto.js')) {
            $al = \Concrete\Core\Asset\AssetList::getInstance();
            $al->register('javascript', 'auto-js-about', 'blocks/about/auto.js', array(), $this->pkg);
            $this->requireAsset('javascript', 'auto-js-about');
        }
        $this->edit();
    }

    
}