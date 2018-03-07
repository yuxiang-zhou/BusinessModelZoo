<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$collectionID = $c->getCollectionID();
?>


	
<?php if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Exemplar List Block.')?></div>
<?php } else { ?>
	
		
	
	<?php

	foreach ($pages as $page):
		
		$entryClasses = 'ccm-block-page-list-page-entry';
		$title = $th->entities($page->getCollectionName());
		$url = $nh->getLinkToCollection($page);
		
	?>
	<div class="<?php echo $entryClasses?> h2Recent">
		
		<a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
		
	</div>
	
	<?php endforeach; ?>

	
    <?php if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
    <?php endif;?>
	
	<?php if ($showPagination): ?>
    <?php echo $pagination;?>
	<?php endif; ?>
	<br />

<?php } ?>
