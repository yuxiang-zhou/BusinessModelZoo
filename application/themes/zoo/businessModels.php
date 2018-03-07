<?php	
	$this->inc('elements/header.php');
?>
<div class="shrinkCF">
	<div id="teaser" class="businessmodels">
		<div class="container">
			<div class="col-md-12">
				<h1 class="center">There are 4 business models categories.<br />Click on one of the models to find out more:</h1>
			</div>
			<div class="clear"></div>
		</div>
		
	</div>
	<div class="container">
		<div id="shift">
			<?php	
				$this->inc('elements/overview-businessmodels.php');
			?>
		</div>
	</div>
	
</div>

<div id="content">
	<div class="container">
		<div id="more-content">
			
			<div class="businessmodelText">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<br />
				<?php 
					$a = new Area('Businessmodel Text'); 
					$a->display($c); 
				?>
				</div>
				<div class="col-md-2"></div>
				<div class="clear"></div>
			</div>
			
			<div class="introductionText">
				<div class="col-md-4"></div>
				<div class="col-md-4">
					<?php 
						$a = new GlobalArea('Introduction Text'); 
						$a->display($c); 
					?>
				</div>
				<div class="col-md-4"></div>
				<div class="clear"></div>
				
				<div class="col-md-12">
					<a href="/exemplars" title="View exemplars" class="btn center width300">View exemplars</a>
				</div>
				<div class="clear"></div>
			</div>
			
		</div>
	</div>	
</div>

<?php
	$this->inc('elements/footer.php');
?>