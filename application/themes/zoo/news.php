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
		
		
			<div class="col-md-8">
				<?php
					// $collectionID = $c->getCollectionID();
				    $dPlst = BlockType::getByHandle('page_list');
				    $dPlst->controller->selectCTID = 181; //ID of page type (Value is found in Option List *** View Source in edit mode of block to see ***)
				    $dPlst->controller->cParentID = 181; //Set for pages beneath a specific page if not set as 1
				    $dPlst->controller->orderBy = 'chrono_desc'; //Options ('display_asc', 'chrono_desc', 'chrono_asc', 'alpha_asc', 'alpha_desc')
				    $dPlst->controller->paginate = '1'; //Options ('1', '0')
				    $dPlst->controller->num = '10'; //Number of Pages in to display in block
				    $dPlst->render('templates/news');
				?>
			</div>
			
			<div class="col-md-4">
				<h1 class="teaserblue smallM">Recent posts</h1>
				
				<?php
					// $collectionID = $c->getCollectionID();
				    $dPlst = BlockType::getByHandle('page_list');
				    $dPlst->controller->selectCTID = 181; //ID of page type (Value is found in Option List *** View Source in edit mode of block to see ***)
				    $dPlst->controller->cParentID = 181; //Set for pages beneath a specific page if not set as 1
				    $dPlst->controller->orderBy = 'chrono_desc'; //Options ('display_asc', 'chrono_desc', 'chrono_asc', 'alpha_asc', 'alpha_desc')
				    $dPlst->controller->paginate = '1'; //Options ('1', '0')
				    $dPlst->controller->num = '10'; //Number of Pages in to display in block
				    $dPlst->render('templates/newsPosts');
				?>
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