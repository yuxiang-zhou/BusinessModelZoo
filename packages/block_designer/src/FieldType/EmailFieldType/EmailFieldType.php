<?php  namespace RamonLeenders\BlockDesigner\FieldType\EmailFieldType;

defined('C5_EXECUTE') or die(_("Access Denied."));

use RamonLeenders\BlockDesigner\FieldType\FieldType;
use Concrete\Core\File\Service\File;

class EmailFieldType extends FieldType
{
    protected $ftHandle = 'email';
    protected $dbType = 'C';
    protected $canRepeat = true;

    public function getFieldDescription()
    {
        return t("An email field");
    }

    public function getSearchableContent()
    {
        return '$content[] = $this->' . $this->data['slug'] . ';';
    }

    public function getViewContents()
    {
        $slug = $this->getRepeating() ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '"]' : $this->data['slug'];
        if (isset($this->data['anchor_field']) && $this->data['anchor_field'] == '1') {
            return '<?php  if (isset($' . $slug . ') && trim($' . $slug . ') != ""){ ?>' . $this->data['prefix'] . '<a href="mailto:<?php  echo $' . $slug . '; ?>' . (isset($this->data['subject']) && trim($this->data['subject']) != '' ? '?subject=' . h($this->data['subject']) : null) . '"' . (isset($this->data['class']) && is_string($this->data['class']) && trim($this->data['class']) != '' ? ' class="' . h($this->data['class']) . '"' : null) . '><?php  echo $' . $slug . '; ?></a>' . $this->data['suffix'] . '<?php  } ?>';
        } else {
            return '<?php  if (isset($' . $slug . ') && trim($' . $slug . ') != ""){ ?>' . $this->data['prefix'] . '<?php  echo h($' . $slug . '); ?>' . $this->data['suffix'] . '<?php  } ?>';
        }
    }

    public function getExtraFunctionsContents()
    {
        if ($this->data['ft_count'] > 0) {
            return;
        }
        $fileService = new File();
        return $fileService->getContents($this->ftDirectory . 'elements' . DIRECTORY_SEPARATOR . 'extra_functions.txt');
    }

    public function getValidateFunctionContents()
    {
        if($this->getRepeating()){
            return 'if (in_array("' . $this->data['slug'] . '", $this->btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']) && (!isset($' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\']) || trim($' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\']) == "")) {
                            $e->add(t("The %s field is required (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
                        }
        elseif(trim($' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\']) != \'\' && !$this->isValidEmail($' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\'])){
            $e->add(t("The %s field is an invalid email address (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
        }';
        }
        else {
            return 'if(in_array("' . $this->data['slug'] . '", $this->btFieldsRequired) && trim($args["' . $this->data['slug'] . '"]) == "") {
            $e->add(t("The %s field is required.", "' . h($this->data['label']) . '"));
        }
        elseif(trim($args["' . $this->data['slug'] . '"]) != \'\' && !$this->isValidEmail($args["' . $this->data['slug'] . '"])) {
            $e->add(t("The %s field is an invalid email address.", "' . h($this->data['label']) . '"));
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

    public function getFieldOptions()
    {
        return parent::view('field_options.php');
    }

    public function getFormContents()
    {
        $repeating = $this->getRepeating();
        $btFieldsRequired = $repeating ? '$btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']' : '$btFieldsRequired';
        return '<div class="form-group">
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label']), $repeating) . '
    ' . parent::generateFormContent('required', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'array' => $btFieldsRequired), $repeating) . '
    ' . parent::generateFormContent('text', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'attributes' => array('maxlength' => 255)), $repeating) . '
</div>';
    }

    public function getDbFields()
    {
        return array(
            array(
                'name' => $this->data['slug'],
                'type' => $this->getDbType(),
                'size' => 255,
            )
        );
    }
}