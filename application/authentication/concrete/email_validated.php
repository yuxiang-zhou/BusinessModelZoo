<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div class="forgotPassword">
	<h1 class="center"><?php echo t('Email Validated') ?></h1>
	
	<br />
	<br />
	
	<div class="help-block center">
		<?php echo t('This email address has been validated! You may now access the features of this site.') ?>
	</div>
	
	<br />
	
	<a href="<?php echo URL::to('/login') ?>" class="btn">
		<?php echo t('Log in') ?>
	</a>
</div>

<br />
<br />
<br />
