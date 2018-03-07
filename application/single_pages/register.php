<?php defined('C5_EXECUTE') or die("Access Denied.");

$token = \Core::make('Concrete\Core\Validation\CSRF\Token');
?>

<div class="col-md-3"></div>
<div class="col-md-6">
	<div class="row" id="registerCSS">

		<h1 class="center"><?php echo t('Site Registration')?></h1>
		

		<br />
		<?php Loader::element('system_errors', array('error' => $error)); ?>
		

		
		<?php
		$attribs = UserAttributeKey::getRegistrationList();
		
		if($registerSuccess) { ?>
		<!-- <div class="row">
		<div class="col-sm-10 col-sm-offset-1"> -->
		<?php	switch($registerSuccess) {
				case "registered":
					?>
					<p><strong><?php echo $successMsg ?></strong><br/><br/>
					<a href="<?php echo $view->url('/')?>"><?php echo t('Return to Home')?></a></p>
					<?php
				break;
				case "validate":
					?>
					<p><?php echo $successMsg[0] ?></p>
					<p><?php echo $successMsg[1] ?></p>
					<p><a href="<?php echo $view->url('/')?>"><?php echo t('Return to Home')?></a></p>
					<?php
				break;
				case "pending":
					?>
					<p><?php echo $successMsg ?></p>
					<p><a href="<?php echo $view->url('/')?>"><?php echo t('Return to Home')?></a></p>
		            <?php
				break;
			} ?>
		<!-- </div>
		</div> -->
		<?php
		} else { ?>
			<form method="post" action="<?php echo $view->url('/register', 'do_register')?>" class="form-stacked">
				<?php $token->output('register.do_register') ?>

				<fieldset>
					<?php
					if ($displayUserName) {
						?>
						<div class="form-group" style="display: none;">
							<?php echo $form->label('uName',t('Username'))?>
                            <?php echo $form->text('uName',uniqid())?>
						</div>
						<br />
						<?php
					}
					?>
                    <div class="form-group">
                        <?php echo $form->label('uEmail',t('Email Address'))?>
                        <?php echo $form->text('uEmail')?>
                    </div>
                    <br />
                    <div class="form-group">
						<?php echo $form->label('uPassword',t('Password'))?>
					    <?php echo $form->password('uPassword',array('autocomplete' => 'off'))?>
					</div>
					<br />
                    <div class="form-group">
						<?php echo $form->label('uPasswordConfirm',t('Confirm Password'))?>
						<?php echo $form->password('uPasswordConfirm',array('autocomplete' => 'off'))?>
					</div>
					<br />

				</fieldset>

				<?php
				if (count($attribs) > 0) {
					?>
					
					<?php
				}
				if (Config::get('concrete.user.registration.captcha')) {
					?>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 ">
		
							<div class="form-group">
								<?php
								$captcha = Loader::helper('validation/captcha');
								echo $captcha->label();
								?>
		                        <?php
		                        $captcha->showInput();
		                        $captcha->display();
		                        ?>
							</div>
						</div>
					</div>
		
				<?php } ?>
				
				<div class="form-actions">
					<?php echo $form->hidden('rcID', $rcID); ?>
					<?php echo $form->submit('register', t('Register'), array('class' => 'btn'))?>
				</div>
					
			</form>
		
			<?php
		}
		?>

	</div>
</div>
<div class="col-md-3"></div>
<div class="clear"></div>

<br />
<br />
<br />
