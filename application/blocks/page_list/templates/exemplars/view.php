<?php
defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
$collectionID = $c->getCollectionID();
$u = new User();
?>

<script type="text/javascript" src="<?php echo $this->getThemePath()?>/addons/hyphenator/Hyphenator.js"></script>
<script>
	Hyphenator.config({
		useCSS3hyphenation: true,
		displaytogglebox : false,
		defaultlanguage: 'en-gb'
	});
    Hyphenator.run();
</script>



<div id="teaser" class="exemplars">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1 class="center bottomless">Search our library of exemplars</h1>
				<p class="center">
					<strong>Select one or multiple categories below:</strong>
				</p>

			</div>
			<div class="clear"></div>

			<br />

			<div id="exemplarsChoose">

				<div class="col-md-2"></div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-xs-6">
							<dl class="plus-yellow <?php if($collectionID == 168) echo 'active' ?>">
								<dt>
									<a href="/exemplars/product-model" title="Product Model" class="yellow-h">
										<span class="icon-product_icon_b"></span>
									</a>
								</dt>
								<dd>
									<h2>
										<a href="/exemplars/product-model" class="yellow-a">Product Model</a>
									</h2>
								</dd>
							</dl>
						</div>
						<div class="col-xs-6">
							<dl class="plus-orange <?php if($collectionID == 169) echo 'active' ?>">
								<dt>
									<a href="/exemplars/solutions-model" title="Solutions Model" class="orange-h">
										<span class="icon-solutions_icon_b"></span>
									</a>
								</dt>
								<dd>
									<h2>
										<a href="/exemplars/solutions-model" class="orange-a">Solutions Model</a>
									</h2>
								</dd>
							</dl>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-xs-6">
							<dl class="plus-blue <?php if($collectionID == 170) echo 'active' ?>">
								<dt>
									<a href="/exemplars/matchmaking-model" title="Matchmaking Model" class="blue-h">
										<span class="icon-matchmaking_icon_b"></span>
									</a>
								</dt>
								<dd>
									<h2>
										<a href="/exemplars/matchmaking-model" class="blue-a">Matchmaking Model</a>
									</h2>
								</dd>
							</dl>
						</div>
						<div class="col-xs-6">
							<dl class="plus-green <?php if($collectionID == 171) echo 'active' ?>">
								<dt>
									<a href="/exemplars/multi-sided-model" title="Multi-sided Model" class="green-h">
										<span class="icon-multisided_icon_b"></span>
									</a>
								</dt>
								<dd>
									<h2>
										<a href="/exemplars/multi-sided-model" class="green-a">Multi-sided Model</a>
									</h2>
								</dd>
							</dl>
						</div>
						<div class="clear"></div>
					</div>
				</div>
				<div class="col-md-2"></div>
				<div class="clear"></div>

			</div>

		</div>

	</div>


	<div id="filterRules" class="bgColor-<?php if($collectionID == 168) echo 'yellow';
											   if($collectionID == 169) echo 'orange';
											   if($collectionID == 170) echo 'blue';
											   if($collectionID == 171) echo 'green';
	?>">
		<div class="container">

			<div class="col-md-12">
		 		<input type="text" id="searchName" placeholder="Search by name" class="width300" />
		 	</div>
		 	<div class="clear"></div>

		 	<div class="col-md-2"></div>
		 	<div class="col-md-8">
		 		<div class="row">

		 			<div class="col-sm-4">
		 				<h2>Headquarters</h2>
		 				<select id="select-headquarters" data-filter-group="headquarters" class="width300">
		 					<option value="">All</option>
		 					<?php
							$CountryArrayNormal = array();
							$CountryArraylowerCase = array();

							foreach ($pages as $page):

								 $selectedCountries = $page->getCollectionAttributeValue('headquarters');

								 if (is_object($selectedCountries)) {
								 	foreach ($selectedCountries as $country) {

								 		array_push($CountryArrayNormal,  (string)$country);
								 		array_push($CountryArraylowerCase, strtolower(str_replace(" ", "", $country)));
								 	}
								  }
							?>
							<?php endforeach; ?>
							<?php

							$CountryArrayNormal = array_keys(array_flip($CountryArrayNormal));
							$CountryArraylowerCase = array_keys(array_flip($CountryArraylowerCase));

							for ($i = 0; $i < count($CountryArraylowerCase); ++$i) {

									echo '<option value=".'.$CountryArraylowerCase[$i].'">'.$CountryArrayNormal[$i].'</option>';
						    }

							?>
		 				</select>
		 			</div>
		 			<div class="col-sm-4">
		 				<h2>Industry context</h2>
		 				<select id="select-industry" data-filter-group="industry" class="width300">
		 					<option value="">All</option>
		 					<?php
							$IndustryArrayNormal = array();
							$IndustryArraylowerCase = array();

							foreach ($pages as $page):

								 $selectedIndustries = $page->getCollectionAttributeValue('industry');

								 if (is_object($selectedIndustries)) {
								 	foreach ($selectedIndustries as $industry) {

								 		array_push($IndustryArrayNormal,  (string)$industry);
										$replacements = array(" ","&");
								 		array_push($IndustryArraylowerCase, strtolower(str_replace($replacements, "", $industry)));
								 	}
								  }
							?>
							<?php endforeach; ?>
							<?php

							$IndustryArrayNormal = array_keys(array_flip($IndustryArrayNormal));
							$IndustryArraylowerCase = array_keys(array_flip($IndustryArraylowerCase));

							for ($i = 0; $i < count($IndustryArraylowerCase); ++$i) {

									echo '<option value=".'.$IndustryArraylowerCase[$i].'">'.$IndustryArrayNormal[$i].'</option>';
						    }

							?>
		 				</select>
		 			</div>
		 			<div class="col-sm-4">
		 				<h2>Group</h2>
		 				<select id="select-group" data-filter-group="group" class="width300">
		 					<option value="">All</option>
		 					<?php
							$groupArrayNormal = array();
							$groupArraylowerCase = array();

							foreach ($pages as $page):

								 $selectedgroups = $page->getCollectionAttributeValue('group');

								 if (is_object($selectedgroups)) {
								 	foreach ($selectedgroups as $group) {

								 		array_push($groupArrayNormal,  (string)$group);
										$replacements = array(" ","&");
								 		array_push($groupArraylowerCase, strtolower(str_replace($replacements, "", $group)));
								 	}
								  }
							?>
							<?php endforeach; ?>
							<?php

							$groupArrayNormal = array_keys(array_flip($groupArrayNormal));
							$groupArraylowerCase = array_keys(array_flip($groupArraylowerCase));

							for ($i = 0; $i < count($groupArraylowerCase); ++$i) {

									echo '<option value=".'.$groupArraylowerCase[$i].'">'.$groupArrayNormal[$i].'</option>';
						    }

							?>
		 				</select>
		 			</div>
		 			<div class="clear"></div>
		 		</div>
		 	</div>

		 	<div class="col-md-2"></div>
		 	<div class="clear"></div>


		 </div>
	 </div>

</div>

<br />
<br />

<script type="text/javascript" src="<?php echo $this->getThemePath()?>/addons/isotope/isotope.pkgd.min.js"></script>
<script>
	$(function(){
		//Filtering Option

		// store filter for each group
  		var filters = {};
  		var allFilter = "";

		var $container = $('#table .row-contents').isotope({
			// options
		  itemSelector: '.row-content',
		  layoutMode: 'fitRows',
		  // transitionDuration: 0,
		  filter: function() {
		      var searchResult = qsRegex ? $(this).find('.names a').text().match( qsRegex ) : true;
		      var allResult = allFilter ? $(this).is( allFilter ) : true;
      		  return searchResult && allResult;
		  },
		  getSortData: {
		  	name: '.sortnames'
		  },
		  sortBy: 'name'

		});

		//NO RESULT
		$container.isotope( 'on', 'layoutComplete', function() {
		  var iso = $container.data('isotope');
		  console.log(iso.filteredItems);
		  if ( iso.filteredItems.length == 0 ) {
			  $('.noresult').show();
			}
			else{
				$('.noresult').hide();
			}
		});

		//SEARCH OPTION -----------------------------------------
		// quick search regex
		var qsRegex;
		// use value of search field to filter
		var $quicksearch = $('#searchName').keyup( debounce( function() {
		    qsRegex = new RegExp( $quicksearch.val(), 'gi' );
		    $container.isotope();
		    console.log(allFilter);
		}, 200 ) );

		//SELECT OPTION -----------------------------------------

		$('#select-headquarters').on( 'change', function() {
		    // get filter value from option value
		    var filterValue = this.value;
		    var group = $(this).attr('data-filter-group');

			filters[ group ] =filterValue;

			var isoFilters = [];
			for ( var prop in filters ) {
                isoFilters.push( filters[ prop ] )
          	}
          	allFilter = isoFilters.join('').replace(/\,/g, '');
          	$container.isotope();
          	console.log(allFilter);
		});

		$('#select-industry').on( 'change', function() {
		    // get filter value from option value
		    var filterValue = this.value;
		    var group = $(this).attr('data-filter-group');

			filters[ group ] =filterValue;

			var isoFilters = [];
			for ( var prop in filters ) {
                isoFilters.push( filters[ prop ] )
          	}
          	allFilter = isoFilters.join('').replace(/\,/g, '');
          	$container.isotope();
          	console.log(allFilter);
		});

		$('#select-group').on( 'change', function() {
		    // get filter value from option value
		    var filterValue = this.value;
		    var group = $(this).attr('data-filter-group');

			filters[ group ] =filterValue;

			var isoFilters = [];
			for ( var prop in filters ) {
                isoFilters.push( filters[ prop ] )
          	}
          	allFilter = isoFilters.join('').replace(/\,/g, '');
          	$container.isotope();
          	console.log(allFilter);
		});

	});

	// debounce so filtering doesn't happen every millisecond
	function debounce( fn, threshold ) {
	  var timeout;
	  return function debounced() {
	    if ( timeout ) {
	      clearTimeout( timeout );
	    }
	    function delayed() {
	      fn();
	      timeout = null;
	    }
	    timeout = setTimeout( delayed, threshold || 100 );
	  }
	}
</script>

<div id="content">

	<div class="container">
		<div class="smallonsmall">
			<h2 class="center">Select the brand below to find out more:</h2>

			<?php if($collectionID != 153){ ?>

				<br />

				<a href="/exemplars" title="Back to overview" class="btn bordered center width300">Back to overview</a>

				<?php } ?>

			<br />
			<br />

			<?php if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
			    <div class="ccm-edit-mode-disabled-item"><?php echo t('Empty Exemplar List Block.')?></div>
			<?php } else { ?>

			<div class="ccm-block-page-list-wrapper" id="exemplars_details">

				<div id="table" lang="en">

					<div class="row-headlines">
						<div class="row-headline">
							<div class="col-xs-2 hcol name">Name</div>
							<div class="col-xs-1 hcol type hyphenate" lang="en-gb">Type of business model</div>
							<div class="col-xs-3 hcol overview">Overview</div>
							<div class="col-xs-2 hcol country">headquarters</div>
							<div class="col-xs-2 hcol industry">Industry Context</div>
							<div class="col-xs-2 hcol group last">Group</div>
							<div class="clear"></div>
						</div>
					</div>


					<div class="row-contents">

						<?php
						if ($collectionID == 153) $checkModel = ['product', 'solutions', 'matchmaking', 'multisided'];
						if ($collectionID == 168) $checkModel = ['product'];
						if ($collectionID == 169) $checkModel = ['solutions'];
						if ($collectionID == 170) $checkModel = ['matchmaking'];
						if ($collectionID == 171) $checkModel = ['multisided'];

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
							$overviewTruncated = substr($overview, 0,128);

							$selectedCountries = $page->getCollectionAttributeValue('headquarters');
							$selectedCountriesVariable = strtolower(str_replace(" ", "", $selectedCountries));

							$selectedindustry = $page->getCollectionAttributeValue('industry');
							$replacements = array(" ","&amp;");
							$selectedindustryVariable = strtolower(str_replace($replacements, "", $selectedindustry));

							$selectedgroup = $page->getCollectionAttributeValue('group');
							$replacementsgroup = array(" ","&amp;");
							$selectedgroupVariable = strtolower(str_replace($replacementsgroup, "", $selectedgroup));

							// echo $typeofbusinessmodel;
							// echo ' - ';
							// echo $collectionID;
							// echo ' - ';
							// echo $checkModel;
							// echo ' / ';

							if (in_array($typeofbusinessmodel,$checkModel)) {

						?>

						<div class="row-content values <?php echo $typeofbusinessmodel ?> <?php echo $selectedCountriesVariable ?> <?php echo $selectedindustryVariable ?> <?php echo $selectedgroupVariable ?>">

								<div class="col-xs-2 bcol names">
									<a href="<?php echo $url; ?>" title="<?php echo $title; ?>" class="sortnames hyphenate" lang="en-gb">› <?php echo strtolower($title)?></a>
								</div>

								<div class="col-xs-1 bcol exemplars">
									<?php
										echo '<a href="'.$url.'" title="'.$typeofbusinessmodel.'" class="'.$typeofbusinessmodel.'">';
										echo '<span class="icon-'.$typeofbusinessmodel.'_icon_b"></span>';
										echo '</a>';

									?>
									<div class="clear"></div>
								</div>

								<div class="col-xs-3 bcol overviews">
									<p><?php echo $overviewTruncated ?>...</p>
								</div>

								<div class="col-md-2 bcol countries">
									<?php


									 if (is_object($selectedCountries)) {
									    foreach ($selectedCountries as $country) {
										echo '<label>'.$country.'</label>';
									    }
									  }

									?>
								</div>
								<div class="col-xs-2 bcol industries">
									<?php

									if (is_object($selectedindustry)) {
									    foreach ($selectedindustry as $industry) {
										echo '<label>'.$industry.'</label>';
									    }
									  }

									?>
								</div>
								<div class="col-xs-2 bcol group last">
									<?php

									if (is_object($selectedgroup)) {
									    foreach ($selectedgroup as $group) {
										echo '<label>'.$group.'</label>';
									    }
									  }

									?>
								</div>
								<div class="clear"></div>
						</div>
						<?php } endforeach; ?>
					</div>


					<div class="noresult">Sorry, no result!</div>


				</div>

			    <?php if (count($pages) == 0): ?>
			        <div class="ccm-block-page-list-no-pages"><?php echo h($noResultsMessage)?></div>
			    <?php endif;?>

			</div><!-- end .ccm-block-page-list -->
		</div>
	</div><!-- END CONTAINER -->

</div>

<br />
<br />


<?php if ($showPagination): ?>
    <?php echo $pagination;?>
<?php endif; ?>

<?php } ?>
