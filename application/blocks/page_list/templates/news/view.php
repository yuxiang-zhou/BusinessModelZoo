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
		$date = strftime("%e. %B, %Y", strtotime($page->getCollectionDatePublic(),false));
		
		$img = $page->getAttribute('newsimage');
		if (is_object($img)) {
			$img_src = $img->getRelativePath();
		}
		$description = $page->getCollectionDescription();
		
	?>
	<div class="<?php echo $entryClasses?>">
		<h1>
			<a href="<?php echo $url; ?>" title="<?php echo $title; ?>"><?php echo $title; ?></a>
		</h1>
		<span class="date"><?php echo $date; ?></span>
		
		<br />
		<br />
		
		<p><?php echo $description;  ?> </p>
		<a href="<?php echo $url; ?>" title="Read more" class="readMore">› Read more</a>
		
		<br />
		<br />
		
		<?php 
		if (is_object($img)) {
		?>
		<div class="grid">
			<figure class="effect-apollo">
				<img src="<?php echo $img_src ?>" alt="" class="img-responsive" />
				<figcaption>
					<a href="<?php echo $url; ?>" title="Read more">› Read more</a>
				</figcaption>
			</figure>
		</div>
		
		<br />
		<br />
		
		<?php } ?>
		
		<hr />
		
		<br />
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
