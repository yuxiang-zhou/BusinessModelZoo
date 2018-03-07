<?php defined('C5_EXECUTE') or die('Access denied.');
$form = Core::make('helper/form');
/** @var Concrete\Core\Form\Service\Form $form */
?>

<div class="col-md-3"></div>
<div class="col-md-6">
	<div class="row">
		<form method="post" action="<?php echo URL::to('/login', 'authenticate', $this->getAuthenticationTypeHandle()) ?>">
		
		<h1 class="center">To get full access please login or <a href="<?php echo URL::to('/register')?>" title="register here">register here:</a></h1>
		
			<br />
			<br />
		
			<div class="form-group">
				<input name="uName" class="form-control col-sm-12" placeholder="<?php echo Config::get('concrete.user.registration.email_registration') ? t('Email Address') : t('Username')?>" autofocus="autofocus" />
			</div>
			<div class="clear"></div>
			
			<br />
			
			<div class="form-group">
				<input name="uPassword" class="form-control" type="password" placeholder="<?php echo t('Password')?>" />
			</div>
			
			<br />
		
			<!-- <div class="checkbox">
				<label style="font-weight:normal">
					<input type="checkbox" name="uMaintainLogin" value="1">
					<?php echo t('Stay signed in for two weeks') ?>
				</label>
			</div> -->
		
			<?php if (isset($locales) && is_array($locales) && count($locales) > 0) { ?>
				<div class="form-group">
					<label for="USER_LOCALE" class="control-label"><?php echo t('Language') ?></label>
					<?php echo $form->select('USER_LOCALE', $locales) ?>
				</div>
			<?php } ?>
			
			<label class="label-valueTC"><input type="checkbox" name="checkbox" class="valueTC">&nbsp;&nbsp;I agree to the <a href="/contact" title="terms and conditions">terms and conditions</a><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;and I am over 18 years old.</label>
			
			<br />
			
			<div class="form-group">
				<button class="btn width100 acceptTaC"><?php echo t('Log in') ?></button>
			</div>
			
			<br />
			
			<a href="<?php echo URL::to('/login', 'concrete', 'forgot_password')?>" class=""><?php echo t('Forgot Password') ?></a>
		
			<?php Core::make('helper/validation/token')->output('login_' . $this->getAuthenticationTypeHandle()); ?>
		
			<?php if (Config::get('concrete.user.registration.enabled')) { ?>
				
				<!-- <a href="<?php echo URL::to('/register')?>" class="btn btn-block btn-success"><?php echo t('Not a member? Register')?></a> -->
			<?php } ?>
			
			<br />
			<br />
			<br />
			
		</form>
	</div>
</div>
<div class="col-md-3"></div>
<div class="clear"></div>
