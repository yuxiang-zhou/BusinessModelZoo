<?php	
	$this->inc('elements/header.php');
	$c = Page::getCurrentPage();
?>

<div id="teaser" class="contact">
	<div class="container">
		<div class="col-md-12">
			<h1 class="center">Get in touch and share your thoughts</h1>
		</div>
		<div class="clear"></div>
	</div>
</div>

<br />
<br />

<div id="content" class="contact">
	<div class="container">
		
		<div class="col-md-2"></div>
		<div class="col-md-8">
			
			<?php 
				$a = new Area('Contact'); 
				$a->display($c); 
			?>
			
		</div>
		<div class="col-md-2"></div>
		<div class="clear"></div>
		
	</div>
</div>

<br />

<?php
	$this->inc('elements/footer.php');
?>