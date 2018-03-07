<?php	
	$this->inc('elements/header.php');
?>

<div id="teaser" class="teaserNews">
	<div class="container">
		<div class="col-md-12">
			<h1 class="center">News and latest research</h1>
		</div>
		<div class="clear"></div>
	</div>
</div>

<br />
<br />

<div id="content" class="news">
	<div class="container">
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
		
			<div class="col-md-12">
				<h1 class="teaserblue">
				<? echo $c->getCollectionName(); ?>
				</h1>
				<span class="date"><?php echo strftime("%e. %B, %Y", strtotime($c->getCollectionDatePublic(),false)); ?></span>
				
				<br />
				<br />
				
				<?php
				$ih = Loader::helper('image');
				$img = $c->getAttribute('newsimage');
				if(is_object($img)){
					$thumb = $ih->getThumbnail($img, 1000, 9999, true);
					echo '<img src="'.$thumb->src.'" alt="'.$c->getCollectionName().'" class="img-responsive" />';
					echo '<br /><br />';
				}
				?>
				
				<?php 
					$a = new Area('Newstext'); 
					$a->display($c); 
				?>
				
				<br />
				<br />
				
				<a href="/news" title="Back to news" class="btn bordered center width300">Back to news</a>
				
				<br />
				<br />
				
			</div>

			<div class="clear"></div>
		</div>
		<div class="col-md-2"></div>
		<div class="clear"></div>
		</div>
	</div>
</div>

<?php
	$this->inc('elements/footer.php');
?>