<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div class="forgotPassword">
	<h1 class="center"><?php echo t('Unable to validate email') ?></h1>
	<br />
	<div class="help-block center">
		<?php echo t('The token you provided doesn\'t appear to be valid, please paste the url exactly as it appears in the email.') ?>
	</div>
	<br />
	<a href="<?php echo URL::to('/login/callback/concrete') ?>" class="btn width100">
		<?php echo t('Continue') ?>
	</a>
</div>
<br /><br /><br />

