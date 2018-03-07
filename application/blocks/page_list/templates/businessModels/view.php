<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$collectionID = $c->getCollectionID();
$u = new User();
?>


	
<?php if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Exemplar List Block.')?></div>
<?php } else { ?>
			
	<ul class="typ-ex">
	
		<?php
		if ($collectionID == 157) $checkModel = ['product'];
		if ($collectionID == 158) $checkModel = ['solutions'];
		if ($collectionID == 159) $checkModel = ['matchmaking'];
		if ($collectionID == 160) $checkModel = ['multisided'];
	
		foreach ($pages as $page):
			
			$title = $th->entities($page->getCollectionName());
			
			if( $u->isLoggedIn()){
				$url = $nh->getLinkToCollection($page);
			}
			else {
				$url = URL::to('login/forward/'.$th->entities($page->getCollectionID()));
			}
			
			$typeofbusinessmodel = strtolower($th->entities($page->getAttribute('typeofbusinessmodel')));
			
			$overview = $th->entities($page->getAttribute('overview'));
			$overviewTruncated = substr($overview, 0,256);
	
			if (in_array($typeofbusinessmodel,$checkModel)) {
			
		?>
		
		<li>
			<a class="tclick" href="<?php echo $url; ?>" title="<?php echo $title; ?>">- <?php echo $title; ?> <span>(close)</span></a>
			<p><?php echo $overviewTruncated ?>... <a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="t-ext">› Read more</a><br /></p>
			
		</li>

		<?php } endforeach; ?>
	
	</ul>
	
    <?php if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
    <?php endif;?>


<?php } ?>
