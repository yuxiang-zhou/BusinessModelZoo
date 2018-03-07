<?php
	$this->inc('elements/header.php');
	$c = Page::getCurrentPage();
?>

<div id="teaser" class="about">
	<div class="container">
		<div class="col-md-12">
			<h1 class="center"><? echo $c->getCollectionName(); ?></h1>
		</div>
		<div class="clear"></div>
	</div>
</div>

<br />
<br />

<div id="content" class="about">
	<div class="section-1">

		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<div class="col-md-12">

						<?php
							$a = new Area('About Section One');
							$a->display($c);
						?>

					</div>
					<div class="col-md-6">
						<?php
							$a = new Area('About Row One');
							$a->display($c);
						?>
					</div>
					<div class="col-md-6">
						<?php
							$a = new Area('About Row Two');
							$a->display($c);
						?>
					</div>
					<div class="clear"></div>
				</div>
				<div class="col-md-2"></div>
				<div class="clear"></div>
			</div>
		</div>

		<br />
		<br />

		<div class="section-2 grey">
			<div class="container">

				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-10">
						<div class="col-md-12">

							<?php
								$a = new Area('About Section Two');
								$a->display($c);
							?>

						</div>
						<div class="col-md-6 closure">
							<?php
								$a = new Area('About Row One Section Two');
								$a->display($c);
							?>
						</div>
						<div class="col-md-6">
							<?php
								$a = new Area('About Row Two Section Two');
								$a->display($c);
							?>
						</div>
						<div class="clear"></div>
					</div>
					<div class="clear"></div>
				</div>

			</div>
		</div>

		<br />
		<br />

	</div>
</div>

<?php
	$this->inc('elements/footer.php');
?>
