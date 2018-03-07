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
		
		$title = $th->entities($page->getCollectionName());
		$url = $nh->getLinkToCollection($page);
		$description = $page->getCollectionDescription();
		
	?>

		<a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="sum-notdu">
			<strong><?php echo $title; ?></strong>
		</a>
		
		<p class="margin20bot"><?php echo $description; ?></p>
		
		<a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="btn bordered center width300">Read more</a>
		
		<br />
		
		<hr />
		
		<br />
		
		
	
	<?php endforeach; ?>

	
    <?php if (count($pages) == 0): ?>
        <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
    <?php endif;?>
	
	<?php if ($showPagination): ?>
    <?php echo $pagination;?>
	<?php endif; ?>
	<br />

<?php } ?>
