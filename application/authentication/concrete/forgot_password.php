<?php defined('C5_EXECUTE') or die('Access denied.'); ?>

<div class="col-md-2"></div>
<div class="col-md-8">
	<div class="row">
		<div class="forgotPassword">
			<form method="post" action="<?php echo URL::to('/login', 'callback', $authType->getAuthenticationTypeHandle(), 'forgot_password') ?>">
				<h1 class="center"><?php echo t('Forgot Your Password?') ?></h1>
				<br />
				<br />
				<div class="ccm-message"><?php echo isset($intro_msg) ? $intro_msg : '' ?></div>
				
				<div class='help-block center'>
					<?php echo t('Enter your email address below. We will send you instructions to reset your password.') ?>
				</div>
				
				<br />
				<div class="form-group">
					<input name="uEmail" type="email" placeholder="<?php echo t('Email Address') ?>" class="form-control" />
				</div>
				<br />
				<button name="resetPassword" class="btn width100"><?php echo t('Reset and Email Password') ?></button>
			</form>
		</div>
	</div>
</div>
<div class="col-md-2"></div>
<div class="clear"></div>

<br />
<br />