<?php
	$this->inc('elements/header.php');
	$page = Page::getCurrentPage();
?>
<div>
	<div id="teaser" class="textaligncenter businessmodels subpages <?php
	if($page->getCollectionID() == 157) echo "t-yellow";
	if($page->getCollectionID() == 158) echo "t-orange";
	if($page->getCollectionID() == 159) echo "t-blue";
	if($page->getCollectionID() == 160) echo "t-green";
	?>">
		<div class="container">
			<div class="col-md-12">
				<h1 class="center removePadding">
					<?php
						if($page->getCollectionID() == 157) echo "01. ";
						if($page->getCollectionID() == 158) echo "02. ";
						if($page->getCollectionID() == 159) echo "03. ";
						if($page->getCollectionID() == 160) echo "04. ";
						echo $page->getCollectionName();
					?>
				</h1>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<div class="<?php
					if($page->getCollectionID() == 157) echo "s-yellow";
					if($page->getCollectionID() == 158) echo "s-orange";
					if($page->getCollectionID() == 159) echo "s-blue";
					if($page->getCollectionID() == 160) echo "s-green";
					?>">
		<div class="container">
			<div id="shift" class="backgroundtblue">
				<?php
					$this->inc('elements/overview-businessmodels.php');
				?>

				<br />

				<h2 class="fs18">
					<center>This is how it works:</center>
				</h2>

				<br />

				<div class="howItWorksIllu">
					<div class="col-md-2"></div>
					<div class="col-md-8">
						<?php
							$a = new Area('How it works Image');
							$a->display($c);
						?>
					</div>
					<div class="col-md-2"></div>
					<div class="clear"></div>
					<br />
					<br />
				</div>

				<br />

			</div>
		</div>
	</div>

</div>

<br />
<br />

<div id="content">

	<div id="more-content">

		<div class="introductionOfBusinessmodels">
			<div class="container">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<?php
						$a = new Area('Introduction of Businessmodel');
						$a->display($c);
					?>
				</div>
				<div class="col-md-2"></div>
				<div class="clear"></div>
			</div>
		</div>

		<br />



		<div class="examplesLibrary">
			<div class="container">
				<div class="col-md-2"></div>
				<div class="col-md-8">

					<div class="row">
						<div class="col-md-6">


							<h2>Typical examples:</h2>
							<?php
								$a = new GlobalArea('Typical Examples Text');
								$a->display($c);
							?>
							<script>
								$(function(){
									$('.typ-ex li a.tclick').click(function(event){
										event.preventDefault();
										$(this).find('span').slideToggle();
										$(this).next('p').slideToggle();
									});
								});
							</script>

							<?php

								$dPlst = BlockType::getByHandle('page_list');
							    $dPlst->controller->selectCTID = 153; //ID of page type (Value is found in Option List *** View Source in edit mode of block to see ***)
							    $dPlst->controller->cParentID = 153; //Set for pages beneath a specific page if not set as 1
							    $dPlst->controller->orderBy = 'alpha_asc'; //Options ('display_asc', 'chrono_desc', 'chrono_asc', 'alpha_asc', 'alpha_desc')
							    $dPlst->controller->paginate = '0'; //Options ('1', '0')
							    $dPlst->render('templates/businessModels');

							?>

							<br />
							</div>
							<div class="col-md-6">
								<div class="textleft">
									<h2>Examplars libary:</h2>
									<?php
										$a = new GlobalArea('Introduction Text');
										$a->display($c);
									?>
									<div class="clear"></div>
									<a href="/exemplars" title="View exemplars" class="btn center">View exemplars</a>
								</div>
							</div>
							<div class="clear"></div>
						</div>

						<br />

					</div>

					<div class="col-md-2"></div>
					<div class="clear"></div>
			</div>
		</div>



	</div>
</div>

<br />
<br />

<?php
	$this->inc('elements/footer_subBM.php');
	$this->inc('elements/footer.php');
?>
