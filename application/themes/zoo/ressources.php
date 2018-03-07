<?php	
	$this->inc('elements/header.php');
	$c = Page::getCurrentPage();
?>

<div id="teaser" class="resources">
	<div class="container">
		<div class="col-md-12">
			<h1 class="center"><? echo $c->getCollectionName(); ?></h1>
		</div>
		<div class="clear"></div>
	</div>
</div>

<br />
<br />

<div id="content" class="resources">
	<div class="container">
		<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<div class="col-md-12">
				
				<?php 
					$a = new Area('Resources'); 
					$a->display($c); 
				?>
				
				<?php
					if($c->getCollectionID() == 154){
					    $dPlst = BlockType::getByHandle('page_list');
					    $dPlst->controller->selectCTID = 154; //ID of page type (Value is found in Option List *** View Source in edit mode of block to see ***)
					    $dPlst->controller->cParentID = 154; //Set for pages beneath a specific page if not set as 1
					    $dPlst->controller->orderBy = 'chrono_asc'; //Options ('display_asc', 'chrono_desc', 'chrono_asc', 'alpha_asc', 'alpha_desc')
					    $dPlst->controller->paginate = '1'; //Options ('1', '0')
					    $dPlst->controller->num = '10'; //Number of Pages in to display in block
					    $dPlst->render('templates/resources');
					}else{
						?>
						<a href="/resources" title="Back to resources" class="btn bordered center width300">Back to resources</a>
						<br />
						<?php
					}
				?>
				
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