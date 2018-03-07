<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div id="passwordchange">
	<h1 class="center"><?php echo t('Reset Password') ?></h1>
	<br />
	
	<?php Loader::element('system_errors', array('error' => $error)); ?>
	
	<div class="help-block"><?php echo t('Enter your new password below.') ?></div>
	<br />
	<div class="change-password">
		<form method="post" action="<?php echo URL::to('/login', 'callback', $authType->getAuthenticationTypeHandle(), 'change_password', $uHash) ?>">
			<div class="form-group">
				<label class="control-label" for="uPassword"><?php echo t('New Password') ?></label>
				<input type="password" name="uPassword" id="uPassword" class="form-control" autocomplete="off"/>
			</div>
			<br />
			<div class="form-group">
				<label class="control-label" for="uPassword"><?php echo t('Confirm New Password') ?></label>
				<input type="password" name="uPasswordConfirm" id="uPasswordConfirm" class="form-control" autocomplete="off"/>
			</div>
			<br />
			<div class="form-group">
				<button class="btn width100"><?php echo t('Change password and sign in') ?></button>
			</div>
		</form>
	</div>
</div>

<br /><br /><br />
