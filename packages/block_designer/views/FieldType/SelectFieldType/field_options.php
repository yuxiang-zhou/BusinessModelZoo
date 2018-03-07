<?php  defined('C5_EXECUTE') or die(_("Access Denied.")); ?>

<div class="content-field-options">
    <div class="form-group">
        <label for="fields[{{id}}][select_options]" class="control-label">
            <?php  echo t('Select choices (one per line)'); ?>
            <small><?php  echo t('Set your own array key for values, by using 2 colons (" :: ") on each line - extra spaces required'); ?></small>
        </label>

        <div class="alert alert-info">
            <b>concrete5_old</b> :: Concrete5 CMS 5.6<br/>
            <b>concrete5</b> :: Concrete5 CMS 5.7<br/>
            <b>wordpress</b> :: WordPress<br/>
            <?php  echo t('Value without a key, this will be assigned by the field type'); ?>
        </div>

        <textarea
            rows="3"
            data-validation="required"
            name="fields[{{id}}][select_options]"
            id="fields[{{id}}][select_options]"
            class="form-control">{{select_options}}</textarea>
    </div>

    <div class="form-group">
        <label for="fields[{{id}}][view_output]" class="control-label">
            <?php  echo t('View output'); ?>
        </label>

        <select name="fields[{{id}}][view_output]" class="form-control" id="fields[{{id}}][view_output]">
            {{#select view_output}}
            <option value=""><?php  echo t('Build PHP switch, I will code the rest myself'); ?></option>
            <option value="1"><?php  echo t('Echo the selected key, i.e. %s', 'concrete5_old'); ?></option>
            <option value="2"><?php  echo t('Echo the selected value, i.e. %s', 'Concrete5 CMS 5.6'); ?></option>
            {{/select}}
        </select>
    </div>
</div>