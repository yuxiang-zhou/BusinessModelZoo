<?php  namespace RamonLeenders\BlockDesigner\FieldType\ImageFieldType;

defined('C5_EXECUTE') or die(_("Access Denied."));

use Concrete\Core\Asset\AssetList;
use RamonLeenders\BlockDesigner\FieldType\FieldType;

class ImageFieldType extends FieldType
{
    protected $ftHandle = 'image';
    protected $dbType = 'I';
    protected $uses = array('\File', 'Page');
    protected $btExportFileColumn = true;
    protected $canRepeat = true;

    public function getFieldDescription()
    {
        return t("An image selector");
    }

    public function validate()
    {
        $errors = array();
        if (isset($this->data['thumbnail']) && $this->data['thumbnail'] == '1') {
            $values = array(
                'height' => t('height'),
                'width'  => t('width'),
            );
            foreach ($values as $key => $value) {
                if (isset($this->data[$key]) && trim($this->data[$key]) != '') {
                    $integer = (int)$this->data[$key];
                    if ($integer <= 0) {
                        $errors[] = t('The %s for the image on row #%s has to be higher than 0.', $value, $this->data['row_id']);
                    } else {
                        if (!ctype_digit($this->data[$key])) {
                            $errors[] = t('The %s for the image on row #%s has to be a numeric value (floating numbers disallowed).', $value, $this->data['row_id']);
                        }
                    }
                } else {
                    $errors[] = t('No %s for the image on row #%s has been entered.', $value, $this->data['row_id']);
                }
            }
        }
        return empty($errors) ? true : implode('<br/>', $errors);
    }

    private function generateImage($field_data = array())
    {
        if (isset($this->data['output_src_only']) && $this->data['output_src_only'] == '1') {
            return $field_data['src'];
        } else {
            $field_data = array_filter($field_data);
            $attributes = implode(' ', array_map(function ($v, $k) {
                return sprintf('%s="%s"', $k, $v);
            }, $field_data, array_keys($field_data)));

            return '<img ' . $attributes . '/>';
        }
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

    private function generateLink($inner = '')
    {
        $html = null;
        $slugPage = $this->getRepeating() ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '_page"]' : $this->data['slug'] . '_page';
        $slugLink = $this->getRepeating() ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '_link"]' : $this->data['slug'] . '_link';
        $slugUrl = $this->getRepeating() ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '_url"]' : $this->data['slug'] . '_url';
        $newWindow = isset($this->data['url_target']) && is_string($this->data['url_target']) && $this->data['url_target'] == '1' ? true : false;
        switch ($this->data['link']) {
            case '1':
                $html = '<?php 
        $' . $slugPage . ' = false;
        if (!empty($' . $slugLink . ') && (($page = Page::getByID($' . $slugLink . ')) && $page->error === false)) {
            $' . $slugPage . ' = $page;
        }
        if ($' . $slugPage . ') {
            $linkURL = $' . $slugPage . '->getCollectionLink();
            echo \'<a href="\' . $linkURL . \'"' . ($newWindow ? ' target="_blank"' : null) . (isset($this->data['link_class']) && is_string($this->data['link_class']) && trim($this->data['link_class']) != '' ? ' class="' . $this->data['link_class'] . '"' : null) . '>\';
        } ?>
        ' . $inner . '<?php 
        if ($' . $slugPage . ') {
            echo \'</a>\';
        } ?>';
                break;
            case '2':
                $html = '<?php 
        if (trim($' . $slugUrl . ') != "") {
            echo \'<a href="\' . $' . $slugUrl . ' . \'"' . ($newWindow ? ' target="_blank"' : null) . (isset($this->data['link_class']) && is_string($this->data['link_class']) && trim($this->data['link_class']) != '' ? ' class="' . $this->data['link_class'] . '"' : null) . '>\';
        } ?>
        ' . $inner . '<?php 
        if (trim($' . $slugUrl . ') != "") {
            echo \'</a>\';
        } ?>';
                break;
        }
        return $html;
    }

    public function getViewContents()
    {
        $slug = $this->getRepeating() ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '"]' : $this->data['slug'];
        $field_data = array(
            'src'   => '<?php  echo $' . $slug . '->getURL(); ?>',
            'alt'   => '<?php  echo $' . $slug . '->getTitle(); ?>',
            'class' => isset($this->data['class']) && is_string($this->data['class']) && trim($this->data['class']) != '' ? htmlentities(preg_replace('!\s+!', ' ', $this->data['class'])) : null,
        );
        if (isset($this->data['thumbnail']) && $this->data['thumbnail'] == '1') {
            $width = (int)$this->data['width'];
            $height = (int)$this->data['height'];
            $crop = isset($this->data['crop']) && $this->data['crop'] == '1' ? true : false;
            $field_data['src'] = '<?php  echo $thumb->src; ?>';
            $img = $this->generateImage($field_data);
            if (isset($this->data['link']) && in_array($this->data['link'], array(1, 2))) {
                $img = $this->generateLink($img);
            }
            return '<?php  if ($' . $slug . ') { ?>' . $this->data['prefix'] . '<?php 
    $im = Core::make(\'helper/image\');
    if ($thumb = $im->getThumbnail($' . $slug . ', ' . $width . ', ' . $height . ', ' . var_export($crop, true) . ')) {
        ?>' . $img . '<?php 
    } ?>' . $this->data['suffix'] . '
<?php  } ?>';
        } else {
            $img = $this->generateImage($field_data);
            if (isset($this->data['link']) && in_array($this->data['link'], array(1, 2))) {
                $img = $this->generateLink($img);
            }
            return '<?php  if ($' . $slug . '){ ?>' . $this->data['prefix'] . $img . $this->data['suffix'] . '<?php  } ?>';
        }
    }

    public function getViewFunctionContents()
    {
        if ($this->getRepeating()) {
            return '
        if (isset($' . $this->data['parent']['slug'] . '_item_v[\'' . $this->data['slug'] . '\']) && trim($' . $this->data['parent']['slug'] . '_item_v[\'' . $this->data['slug'] . '\']) != "" && ($f = \File::getByID($' . $this->data['parent']['slug'] . '_item_v[\'' . $this->data['slug'] . '\'])) && is_object($f)) {
            $' . $this->data['parent']['slug'] . '_item_v[\'' . $this->data['slug'] . '\'] = $f;
        }
        else {
            $' . $this->data['parent']['slug'] . '_item_v[\'' . $this->data['slug'] . '\'] = false;
        }';
        } else {
            return '
        if ($this->' . $this->data['slug'] . ' && ($f = \File::getByID($this->' . $this->data['slug'] . ')) && is_object($f)) {
            $this->set("' . $this->data['slug'] . '", $f);
        }
        else {
            $this->set("' . $this->data['slug'] . '", false);
        }';
        }
    }

    public function getRepeatableUpdateItemJS()
    {
        $slug = 'ftImage' . ucFirst($this->data['slug']);
        $slugPage = 'pageSelector' . ucFirst($this->data['slug']);
        return 'var ' . $slug . ' = $(newField).find(\'.ft-image-' . $this->data['slug'] . '-file-selector\');
            if($(' . $slug . ').length > 0){
                $(' . $slug . ').concreteFileSelector({\'inputName\': $(' . $slug . ').attr(\'data-file-selector-input-name\'), \'filters\': [], \'fID\' : $(' . $slug . ').attr(\'data-file-selector-f-id\') });
            }
            var ' . $slugPage . ' = $(newField).find(\'.ft-image-' . $this->data['slug'] . '-page-selector\');
            if ($(' . $slugPage . ').length > 0) {
                $(' . $slugPage . ').concretePageSelector({\'inputName\': $(' . $slugPage . ').attr(\'data-input-name\'), \'cID\' : $(' . $slugPage . ').attr(\'data-cID\')});
            }';
    }

    public function getValidateFunctionContents()
    {
        $repeating = $this->getRepeating();
        if ($repeating) {
            $slug = '$' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '\']';
            $slugUrl = '$' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '_url\']';
            $slugLink = '$' . $this->data['parent']['slug'] . '_v[\'' . $this->data['slug'] . '_link\']';
            $validation = 'if (in_array("' . $this->data['slug'] . '", $this->btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']) && (!isset(' . $slug . ') || trim(' . $slug . ') == "" || !is_object(\File::getByID(' . $slug . ')))){
           $e->add(t("The %s field is required (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
        }';
            if (isset($this->data['link']) && in_array($this->data['link'], array(1, 2))) {
                switch ($this->data['link']) {
                    case '1':
                        $validation .= ' elseif (!isset(' . $slugLink . ') || trim(' . $slugLink . ') == "" || (is_object(\File::getByID(' . $slug . ')) && (($page = Page::getByID(' . $slugLink . ')) && $page->error !== false))){
              $e->add(t("The %s link field is required (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
        }';
                        break;
                    case '2':
                        $validation .= 'elseif (is_object(\File::getByID(' . $slug . ')) && (trim(' . $slugUrl . ') == "" || !filter_var(' . $slugUrl . ', FILTER_VALIDATE_URL))){
              $e->add(t("The %s URL field does not have a valid URL (%s, row #%s).", "' . h($this->data['label']) . '", "' . h($this->data['parent']['label']) . '", $' . $this->data['parent']['slug'] . '_k));
        }';
                        break;
                }
            }
            return $validation;
        } else {
            $validation = 'if (in_array("' . $this->data['slug'] . '", $this->btFieldsRequired) && (trim($args["' . $this->data['slug'] . '"]) == "" || !is_object(\File::getByID($args["' . $this->data['slug'] . '"])))){
            $e->add(t("The %s field is required.", "' . h($this->data['label']) . '"));
        }';
            if (isset($this->data['link']) && in_array($this->data['link'], array(1, 2))) {
                switch ($this->data['link']) {
                    case '1':
                        $validation .= ' elseif (is_object(\File::getByID($args["' . $this->data['slug'] . '"])) && (($page = Page::getByID($args["' . $this->data['slug'] . '_link"])) && $page->error !== false)){
              $e->add(t("The %s link field is required.", "' . h($this->data['label']) . '"));
        }';
                        break;
                    case '2':
                        $validation .= 'elseif (is_object(\File::getByID($args["' . $this->data['slug'] . '"])) && (trim($args["' . $this->data['slug'] . '_url"]) == "" || !filter_var($args["' . $this->data['slug'] . '_url"], FILTER_VALIDATE_URL))){
              $e->add(t("The %s URL field does not have a valid URL.", "' . h($this->data['label']) . '"));
        }';
                        break;
                }
            }
            return $validation;
        }
    }

    public function getOnStartFunctionContents()
    {
        if ($this->data['ft_count'] > 0) {
            return;
        }
        return '$this->requireAsset(\'core/file-manager\');';
    }

    public function getFormContents()
    {
        $html = '';
        $repeating = $this->getRepeating();
        $btFieldsRequired = $repeating ? '$btFieldsRequired[\'' . $this->data['parent']['slug'] . '\']' : '$btFieldsRequired';
        if ($repeating) {
            $html .= '<div class="form-group">
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label']), $repeating) . '
    ' . parent::generateFormContent('required', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'array' => $btFieldsRequired), $repeating) . '
    ' . parent::generateFormContent('file', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'attributes' => array('class' => 'ccm-file-selector ft-image-' . $this->data['slug'] . '-file-selector')), $repeating) . '
</div>';
        } else {
            $slug = $repeating ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '"]' : $this->data['slug'];
            $slugO = $repeating ? $this->data['parent']['slug'] . '_item["' . $this->data['slug'] . '_o"]' : $this->data['slug'] . '_o';
            $html .= '<div class="form-group">
    <?php 
    if (isset($' . $slug . ') && $' . $slug . ' > 0) {
        $' . $slugO . ' = File::getByID($' . $this->data['slug'] . ');
        if ($' . $slugO . '->isError()) {
            unset($' . $slugO . ');
        }
    } ?>
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label']), $repeating) . '
    ' . parent::generateFormContent('required', array('slug' => $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'array' => $btFieldsRequired), $repeating) . '
    ' . parent::generateFormContent('file', array('slug' => 'ccm-b-file-' . $this->data['slug'], 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'postName' => $this->data['slug'], 'bf' => '$' . $this->data['slug'] . '_o'), $repeating) . '
</div>';
        }
        if (isset($this->data['link']) && in_array($this->data['link'], array(1, 2))) {
            switch ($this->data['link']) {
                case '1':
                    $html .= PHP_EOL . '<div class="form-group">
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'] . '_link', 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label'], 'suffix' => ' . " " . t("link")'), $repeating) . '
    ' . parent::generateFormContent('page_selector', array('slug' => $this->data['slug'] . '_link', 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'attributes' => array('class' => 'ft-image-' . $this->data['slug'] . '-page-selector')), $repeating) . '
</div>';
                    break;
                case '2':
                    $html .= PHP_EOL . '<div class="form-group">
    ' . parent::generateFormContent('label', array('slug' => $this->data['slug'] . '_url', 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'label' => $this->data['label'], 'suffix' => ' . " " . t("url")'), $repeating) . '
    ' . parent::generateFormContent('required', array(), $repeating) . '
    ' . parent::generateFormContent('text', array('slug' => $this->data['slug'] . '_url', 'parent' => isset($this->data['parent']) ? $this->data['parent'] : null, 'attributes' => array('maxlength' => 255)), $repeating) . '
</div>';
                    break;
            }
        }
        return $html;
    }

    public function getSaveFunctionContents()
    {
        if ($this->getRepeating()) {
            $lines = array();
            $lines[] = 'if (isset($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']) && trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']) != \'\') {
                    $data[\'' . $this->data['slug'] . '\'] = trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '\']);
                } else {
                    $data[\'' . $this->data['slug'] . '\'] = null;
                }';
            if (isset($this->data['link']) && in_array($this->data['link'], array(1, 2))) {
                switch ($this->data['link']) {
                    case '1':
                        $lines[] = 'if (isset($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_link\']) && trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_link\']) != \'\') {
                    $data[\'' . $this->data['slug'] . '_link\'] = trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_link\']);
                } else {
                    $data[\'' . $this->data['slug'] . '_link\'] = null;
                }';
                        break;
                    case '2':
                        $lines[] = 'if (isset($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_url\']) && trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_url\']) != \'\') {
                    $data[\'' . $this->data['slug'] . '_url\'] = trim($' . $this->data['parent']['slug'] . '_item[\'' . $this->data['slug'] . '_url\']);
                } else {
                    $data[\'' . $this->data['slug'] . '_url\'] = null;
                }';
                        break;
                }
            }
            return implode(PHP_EOL, $lines);
        }
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
        if (isset($this->data['link']) && in_array($this->data['link'], array(1, 2))) {
            switch ($this->data['link']) {
                case '1':
                    $dbFields[] = array(
                        'name' => $this->data['slug'] . '_link',
                        'type' => 'I',
                    );
                    break;
                case '2':
                    $dbFields[] = array(
                        'name' => $this->data['slug'] . '_url',
                        'type' => 'C',
                    );
                    break;
            }
        }
        return $dbFields;
    }
}