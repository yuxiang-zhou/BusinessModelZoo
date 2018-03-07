<?php
	$this->inc('elements/header.php');
?>

<div id="teaser" class="viewphp">
	<div class="container">

		<div class="col-md-12">
			<div class="">
				<?php
					$a = new GlobalArea('Logo');
					$a->display($c);
				?>
			</div>
		</div>
		<div class="clear"></div>

		<div class="col-md-12">
			<br />
			<br />
			<h1 class="center smallFontSize">This is a project by Cass Business School in conjunction with EPSRC</h1>
		</div>
		<div class="clear"></div>

	</div>
</div>

<br />
<br />

<div class="container" id="viewphp">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<?php
			print $innerContent;
		?>
	</div>
	<div class="col-md-2"></div>
	<div class="clear"></div>
</div>
<?php
	$this->inc('elements/footer.php');
?>
