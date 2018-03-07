<?php  namespace RamonLeenders\BlockDesigner\FieldType\MarkdownFieldType;

defined('C5_EXECUTE') or die(_("Access Denied."));

use RamonLeenders\BlockDesigner\FieldType\FieldType;

class MarkdownFieldType extends FieldType
{
    protected $ftHandle = 'markdown';
    protected $dbType = 'X';
    protected $canRepeat = true;

    public function getFieldDescription()
    {
        return t("A simple text area where you can use all markdown functionalities");
    }

    public function getSearchableContent()
    {
        $lines = array();
        if ($this->data['ft_count'] <= 0) {
            $lines[] = 'if(!class_exists(\'Parsedown\')){
            include_once(\'' . $this->data['btDirectory'] . 'libraries' . DIRECTORY_SEPARATOR . 'parsedown' . DIRECTORY_SEPARATOR . 'Parsedown.php' . '\');
        }';
        }
        $lines[] = '$content[] = (new Parsedown())->text($this->' . $this->data['slug'] . ');';
        return implode(PHP_EOL . '        ', $lines);
    }

    public function getViewContents()
    {
        $slug = $this->getRepeating() ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '"]' : $this->data['slug'];
        return '<?php  if (isset($' . $slug . ') && trim($' . $slug . ') != ""){ ?>' . $this->data['prefix'] . '<?php  echo (new Parsedown())->text($' . $slug . '); ?>' . $this->data['suffix'] . '<?php  } ?>';
    }

    public function getViewFunctionContents(){
        if ($this->data['ft_count'] <= 0) {
            return 'if (!class_exists(\'Parsedown\')){
            include_once(\'' . $this->data['btDirectory'] . 'libraries' . DIRECTORY_SEPARATOR . 'parsedown' . DIRECTORY_SEPARATOR . 'Parsedown.php' . '\');
        }';
        }
    }

    public function getValidateFunctionContents()
    {
        if ($this->getRepeating()) {
            return 'if (in_array("' . $this->data['slug'] . '", $this->btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']) && (!isset($' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\']) || trim($' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
                        }';
        }
        else {
            return 'if (in_array("' . $this->data['slug'] . '", $this->btFieldsRequired) && trim($args["' . $this->data['slug'] . '"]) == ""){
            $e->add(t("The %s field is required.", "' . h($this->data['label']) . '"));
        }';
        }
    }

    public function getSaveFunctionContents()
    {
        if ($this->getRepeating()) {
            return 'if (isset($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']) && trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']) != \'\') {
                    $data[\'' . $this->data['slug'] . '\'] = trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']);
                } else {
                    $data[\'' . $this->data['slug'] . '\'] = null;
                }';
        }
    }

    public function copyFiles()
    {
        $files = array();
        if ($this->data['ft_count'] <= 0) {
            $files[] = array(
                'source' => $this->ftDirectory . 'libraries' . DIRECTORY_SEPARATOR,
                'target' => $this->data['btDirectory'] . 'libraries' . DIRECTORY_SEPARATOR,
            );
        }
        return $files;
    }

    public function getFormContents()
    {
        $fieldAttributes = array('rows' => 5);
        $repeating = $this->getRepeating();
        $btFieldsRequired = $repeating ? '$btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']' : '$btFieldsRequired';
        return '<div class="form-group">
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label']), $repeating) . '
    ' . parent::generateFormContent('required', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'array' => $btFieldsRequired), $repeating) . '
    ' . parent::generateFormContent('textarea', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'attributes' => $fieldAttributes), $repeating) . '
</div>';
    }

    public function getDbFields()
    {
        return array(
            array(
                'name' => $this->data['slug'],
                'type' => $this->getDbType(),
            )
        );
    }
}