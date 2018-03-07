<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="form-group">
    <?php 
    if (isset($employee) && $employee > 0) {
        $employee_o = File::getByID($employee);
        if ($employee_o->isError()) {
            unset($employee_o);
        }
    } ?>
    <?php  echo $form->label('employee', t("Employee")); ?>
    <?php  echo isset($btFieldsRequired) && in_array('employee', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo Core::make("helper/concrete/asset_library")->file($view->field('ccm-b-file-employee'), "employee", t("Choose File"), $employee_o); ?>
</div>

<div class="form-group">
    <?php  echo $form->label('info', t("Info about employee")); ?>
    <?php  echo isset($btFieldsRequired) && in_array('info', $btFieldsRequired) ? '<small class="required">' . t('Required') . '</small>' : null; ?>
    <?php  echo Core::make('editor')->outputBlockEditModeEditor($view->field('info'), $info); ?>
</div>