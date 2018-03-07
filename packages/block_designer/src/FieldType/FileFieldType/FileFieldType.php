<?php  namespace RamonLeenders\BlockDesigner\FieldType\FileFieldType;

defined('C5_EXECUTE') or die(_("Access Denied."));

use RamonLeenders\BlockDesigner\FieldType\FieldType;

class FileFieldType extends FieldType
{
    protected $ftHandle = 'file';
    protected $dbType = 'I';
    protected $uses = array('\File', 'Page', 'View', 'Permissions');
    protected $btExportFileColumn = true;
    protected $canRepeat = true;

    public function getFieldDescription()
    {
        return t("A file field");
    }

    public function getViewContents()
    {
        $repeating = $this->getRepeating();
        $slug = $repeating ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '"]' : $this->data['slug'];
        $slugTitle = $repeating ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '_title"]' : $this->data['slug'] . '_title';
        $href = '<?php  echo $' . $slug . '->urls["relative"]; ?>';
        if (isset($this->data['download']) && $this->data['download'] == '1') {
            $href = '<?php  echo isset($' . $slug . '->urls["download"]) ? $' . $slug . '->urls["download"] : $' . $slug . '->urls["relative"]; ?>';
        }
        $newWindow = isset($this->data['url_target']) && is_string($this->data['url_target']) && $this->data['url_target'] == '1' ? true : false;
        return '<?php  if(isset($' . $slug . ') && $' . $slug . ' !== false){ ?>' . $this->data['prefix'] . '<a href="' . $href . '"' . ($newWindow ? ' target="_blank"' : null) . (isset($this->data['link_class']) && is_string($this->data['link_class']) && trim($this->data['link_class']) != '' ? ' class="' . $this->data['link_class'] . '"' : null) . '>
            <?php  echo isset($' . $slugTitle . ') && trim($' . $slugTitle . ') != "" ? h($' . $slugTitle . ') : $' . $slug . '->getTitle(); ?>
        </a>' . $this->data['suffix'] . '<?php  } ?>';
    }

    public function getViewFunctionContents()
    {
        $repeating = $this->getRepeating();
        $slug = $repeating ? $this->data['parent']['slug'] . '_item_v["' . $this->data['slug'] . '"]' : $this->data['slug'];
        $slugID = $repeating ? $this->data['parent']['slug'] . '_item_v["' . $this->data['slug'] . '_id"]' : $this->data['slug'] . '_id';
        $slugFile = $repeating ? $this->data['parent']['slug'] . '_item_v["' . $this->data['slug'] . '_file"]' : $this->data['slug'] . '_file';
        $slugTitle = $repeating ? $this->data['parent']['slug'] . '_item_v["' . $this->data['slug'] . '_title"]' : $this->data['slug'] . '_title';
        if ($repeating) {
            $code = '$' . $slugID . ' = isset($' . $slug . ') && trim($' . $slug . ') != "" ? (int)$' . $slug . ' : false;
        $' . $slug . ' = false;
        if ($' . $slugID . ' > 0){
            $' . $slugFile . ' = File::getByID($' . $slugID . ');
            $fp = new Permissions($' . $slugFile . ');
	        if ($fp->canViewFile()) {
	            $urls = array(
	                \'relative\' => $' . $slugFile . '->getRelativePath()
	            );
		        $c = Page::getCurrentPage();
		        if ($c instanceof Page) {
			        $cID = $c->getCollectionID();
			        $urls[\'download\'] = View::url(\'/download_file\', $' . $slugID . ', $cID);
		        }
		        $' . $slugFile . '->urls = $urls;
		        $' . $slug . ' = $' . $slugFile . ';
            }
        }';
            if (isset($this->data['title_field']) && $this->data['title_field'] == '1' && (!isset($this->data['title_field_required']) || $this->data['title_field_required'] != '1') && isset($this->data['title_field_fallback_value']) && trim($this->data['title_field_fallback_value']) != '') {
                $code .= '
        if (!isset($' . $slugTitle . ') || trim($' . $slugTitle . ') == "") {
            $' . $slugTitle . '" = \'' . $this->data['title_field_fallback_value'] . '\';
        }';
            }
            return $code;
        } else {
            $code = '$' . $this->data['slug'] . '_id = (int)$this->' . $this->data['slug'] . ';
        $this->' . $this->data['slug'] . ' = false;
        if ($' . $this->data['slug'] . '_id > 0){
            $' . $this->data['slug'] . '_file = File::getByID($' . $this->data['slug'] . '_id);
            $fp = new Permissions($' . $this->data['slug'] . '_file);
	        if ($fp->canViewFile()) {
	            $urls = array(
	                \'relative\' => $' . $this->data['slug'] . '_file->getRelativePath()
	            );
		        $c = Page::getCurrentPage();
		        if ($c instanceof Page) {
			        $cID = $c->getCollectionID();
			        $urls[\'download\'] = View::url(\'/download_file\', $' . $this->data['slug'] . '_id, $cID);
		        }
		        $' . $this->data['slug'] . '_file->urls = $urls;
		        $this->' . $this->data['slug'] . ' = $' . $this->data['slug'] . '_file;
            }
        }
        $this->set("' . $this->data['slug'] . '", $this->' . $this->data['slug'] . ');';
            if (isset($this->data['title_field']) && $this->data['title_field'] == '1' && (!isset($this->data['title_field_required']) || $this->data['title_field_required'] != '1') && isset($this->data['title_field_fallback_value']) && trim($this->data['title_field_fallback_value']) != '') {
                $code .= '
        if (!isset($this->' . $this->data['slug'] . '_title) || trim($this->' . $this->data['slug'] . '_title) == "") {
            $this->set("' . $this->data['slug'] . '_title", \'' . $this->data['title_field_fallback_value'] . '\');
        }';
            }
            return $code;
        }
    }

    public function getValidateFunctionContents()
    {
        $repeating = $this->getRepeating();
        $btFieldsRequired = $repeating ? '$this->btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']' : '$this->btFieldsRequired';
        $slug = $repeating ? '$' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\']' : '$args["' . $this->data['slug'] . '"]';
        $slugTitle = $repeating ? '$' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '_title\']' : '$args["' . $this->data['slug'] . '_title"]';
        if ($repeating) {
            $validation = 'if(in_array("' . $this->data['slug'] . '", ' . $btFieldsRequired . ') && (!isset(' . $slug . ') || trim(' . $slug . ') == "" || !is_object(\File::getByID(' . $slug . ')))) {
            $e->add(t("The %s field is required (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
        }';
            if (isset($this->data['title_field']) && $this->data['title_field'] == '1' && isset($this->data['title_field_required']) && $this->data['title_field_required'] == '1') {
                $validation .= '
            if(!isset(' . $slugTitle . ') || trim(' . $slugTitle . ') == "") {
            $e->add(t("The %s title field is required (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
        }';
            }
            return $validation;
        } else {
            $validation = 'if(in_array("' . $this->data['slug'] . '", ' . $btFieldsRequired . ') && (!isset(' . $slug . ') || trim(' . $slug . ') == "" || !is_object(\File::getByID(' . $slug . ')))) {
            $e->add(t("The %s field is required.", "' . h($this->data['label']) . '"));
        }';
            if (isset($this->data['title_field']) && $this->data['title_field'] == '1' && isset($this->data['title_field_required']) && $this->data['title_field_required'] == '1') {
                $validation .= '
            if(!isset(' . $slugTitle . ') || trim(' . $slugTitle . ') == "") {
            $e->add(t("The %s title field is required.", "' . h($this->data['label']) . '"));
        }';
            }
            return $validation;
        }
    }

    public function getFormContents()
    {
        $repeating = $this->getRepeating();
        $btFieldsRequired = $repeating ? '$btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']' : '$btFieldsRequired';
        $html = null;
        if (!$repeating) {
            $html .= '<?php  $' . $this->data['slug'] . '_o = null;
if ($' . $this->data['slug'] . ' > 0) {
    $' . $this->data['slug'] . '_o = File::getByID($' . $this->data['slug'] . ');
} ?>';
        }
        $slugFile = $repeating ? $this->data['slug'] : 'ccm-b-file-' . $this->data['slug'];
        $attributes = array();
        if ($repeating) {
            $attributes['class'] = 'ccm-file-selector ft-file-file-selector';
        }
        $html .= '
<div class="form-group">
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label']), $repeating) . '
    ' . parent::generateFormContent('required', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'array' => $btFieldsRequired), $repeating) . '
    ' . parent::generateFormContent('file', array('slug' => $slugFile, 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'attributes' => $attributes, 'postName' => $this->data['slug'], 'bf' => '$' . $this->data['slug'] . '_o'), $repeating) . '
</div>';
        if (isset($this->data['title_field']) && $this->data['title_field'] == '1') {
            $html .= '
<div class="form-group">
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'] . '_title', 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label'], 'suffix' => ' . " " . t("Title")'), $repeating) . '
    ' . parent::generateFormContent('text', array('slug' => $this->data['slug'] . '_title', 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'attributes' => array('maxlength' => 255, 'placeholder' => isset($this->data['title_field_placeholder']) && trim($this->data['title_field_placeholder']) != '' ? h($this->data['title_field_placeholder']) : null)), $repeating) . '
</div>';
        }
        return $html;
    }

    public function getEditFunctionContents()
    {
        if ($this->getRepeating()) {
            return 'foreach ($' . $this->data['parent']['slug'] . '_items as &$' . $this->data['parent']['slug'] . '_item) {
            if(!File::getByID($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\'])) {
                unset($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']);
            }
        }';
        }
    }

    public function getSaveFunctionContents()
    {
        if ($this->getRepeating()) {
            $lines = array('if (isset($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']) && trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']) != \'\') {
                    $data[\'' . $this->data['slug'] . '\'] = trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']);
                } else {
                    $data[\'' . $this->data['slug'] . '\'] = null;
                }');
            if (isset($this->data['title_field']) && $this->data['title_field'] == '1') {
                $lines[] = 'if (isset($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_title\']) && trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_title\']) != \'\') {
                    $data[\'' . $this->data['slug'] . '_title\'] = trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_title\']);
                } else {
                    $data[\'' . $this->data['slug'] . '_title\'] = null;
                }';
            }
            return implode(PHP_EOL, $lines);
        }
    }

    public function getOnStartFunctionContents()
    {
        if ($this->data['ft_count'] > 0) {
            return;
        }
        return '$this->requireAsset(\'core/file-manager\');';
    }

    public function getRepeatableUpdateItemJS()
    {
        return 'var fileSelector = $(newField).find(\'.ft-file-file-selector\');
        if ($(fileSelector).length > 0) {
            var fileSelectorID = $(fileSelector).attr(\'data-file-selector-f-id\');
            $(fileSelector).concreteFileSelector({inputName: $(fileSelector).attr(\'data-file-selector-input-name\'), fID : fileSelectorID != \'0\' ? fileSelectorID : \'\'});
        }';
    }

    public function getFieldOptions()
    {
        return parent::view('field_options.php');
    }

    public function getDbFields()
    {
        $dbFields = array(
            array(
                'name'       => $this->data['slug'],
                'type'       => $this->getDbType(),
                'attributes' => array(
                    'default' => '0',
                    'notnull' => true,
                ),
            )
        );
        if (isset($this->data['title_field']) && $this->data['title_field'] == '1') {
            $dbFields[] = array(
                'name' => $this->data['slug'] . '_title',
                'type' => 'C',
            );
        }
        return $dbFields;
    }
}