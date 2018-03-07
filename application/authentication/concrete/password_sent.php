<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div class="col-md-2"></div>
<div class="col-md-8">
	<div class="row">

			<div class="forgotPassword">
				<h1 class="center"><?php echo t('Forgot Your Password?') ?></h1>
				<br />
				<div class="ccm-message"><?php echo isset($intro_msg) ? $intro_msg : '' ?></div>
				<br />
				<div class="help-block center">
					<?php echo t('If there is an account associated with this email, instructions for resetting your password have been sent.') ?>
				</div>
				<br />
				<a href="<?php echo URL::to('/login') ?>" class="btn">
					<?php echo t('Go Back') ?>
				</a>
			</div>
			</div>
</div>
<div class="col-md-2"></div>
<div class="clear"></div>

<br />
<br />
<br />
