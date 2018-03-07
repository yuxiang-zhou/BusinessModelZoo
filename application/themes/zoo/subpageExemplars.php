<?php	
	$this->inc('elements/header.php');
	$c = Page::getCurrentPage();
	$typeofbusinessmodel = strtolower($c->getAttribute('typeofbusinessmodel'));
?>

<div id="teaser" class="subpages subteaser-<?php echo $typeofbusinessmodel; ?>">
	<div class="container">
		<div class="col-md-12">
			<h1 class="center removePadding teaserblue">
				<? echo $c->getCollectionName(); ?>
			</h1>
			<h3 class="center white">
				<?php
					if($typeofbusinessmodel == 'product') echo 'Product Model';
					if($typeofbusinessmodel == 'solutions') echo 'Solutions Model';
					if($typeofbusinessmodel == 'matchmaking') echo 'Matchmaking Model';
					if($typeofbusinessmodel == 'multisided') echo 'Multi-sided Model';
				?>
			</h3>
			</div>
			<div class="clear"></div>
			
			<br />
			<br />
			
			<div class="col-md-12">
				<a href="/exemplars" title="Back to overview" class="btn transparent center width300">Back to overview</a>
			</div>
			<div class="clear"></div>
			
			<br />
		
	</div>
	
</div>

<br />
<br />

<div id="content">
	<div class="container">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<?php
			  $u = new User();
			  if( $u->isLoggedIn() ){
			     $a = new Area('Modeltext'); 
				 $a->display($c);  
			  }
			else{
				echo "<ul class='ccm-system-errors ccm-error errorHandlingRestrictions'>
				<li class='center'>This page is restricted! Please <a href='".URL::to('login/forward/'.$c->getCollectionID())."' title='Log in'>Log in</a> to view the page!</li>
			</ul>";
			}
			?>
			
			
		</div>
		<div class="col-md-2"></div>
		<div class="clear"></div>
	</div>
</div>

<br />
<br />

<div class="col-md-12">
	<a href="/exemplars" title="Back to overview" class="btn bordered center width300">Back to overview</a>
</div>
<div class="clear"></div>

<br />
<br />

<?php
	$this->inc('elements/footer.php');
?>