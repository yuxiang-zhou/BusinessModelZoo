<?php	
	$this->inc('elements/header.php');

	// $collectionID = $c->getCollectionID();
    $dPlst = BlockType::getByHandle('page_list');
    $dPlst->controller->selectCTID = 153; //ID of page type (Value is found in Option List *** View Source in edit mode of block to see ***)
    $dPlst->controller->cParentID = 153; //Set for pages beneath a specific page if not set as 1
    $dPlst->controller->orderBy = 'alpha_asc'; //Options ('display_asc', 'chrono_desc', 'chrono_asc', 'alpha_asc', 'alpha_desc')
    $dPlst->controller->paginate = '0'; //Options ('1', '0')
    $dPlst->render('templates/exemplars');

	$this->inc('elements/footer.php');
?>