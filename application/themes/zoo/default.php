<?php
	$this->inc('elements/header.php');
?>

<div id="teaser">
	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<h1 class="center">
                    <?php
                        $a = new Area('Home Headinig');
                        $a->display($c);
                    ?>
                </h1>
			</div>
			<div class="clear"></div>

			<ul id="teaser-icons">
				<li>
					<div class="yellow">
						<a href="/business-models/product-model" title="Product Model">
							<span class="icon-product_icon_b"></span>
						</a>
					</div>
				</li>
				<li>
					<div class="orange">
						<a href="/business-models/solutions-model" title="Solutions Model">
							<span class="icon-solutions_icon_b"></span>
						</a>
					</div>
				</li>
				<li>
					<div class="blue">
						<a href="/business-models/matchmaking-model" title="Matchmaking Model">
							<span class="icon-matchmaking_icon_b"></span>
						</a>
					</div>
				</li>
				<li class="last">
					<div class="green">
						<a href="/business-models/multi-sided-model" title="Multi-sided Model">
							<span class="icon-multisided_icon_b"></span>
						</a>
					</div>
				</li>
			</ul>

			<div class="clear"></div>
			<div class="container">
				<div class="col-md-12">
					<a href="/business-models" title="Find out more" class="btn transparent center width300">Find out more</a>
				</div>
				<div class="clear"></div>
			</div>
			<br />

			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="col-md-12">

					<?php
						$a = new Area('Teasertext');
						$a->display($c);
					?>



				</div>
			</div>
			<div class="col-md-2"></div>
			<div class="clear"></div>
		</div>

	</div>
</div>


<br />
<br />

<div id="content">

	<div class="container">
		<h2 class="center">The 4 Business Model Categories</h2>
		<br />

		<?php
			$this->inc('elements/overview-businessmodels.php');
		?>
	</div>

	<div id="more-content">
		<div class="container">
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

			<!-- more here -->
			<div class="container">
				<div class="col-md-12">
					<?php
						$a = new GlobalArea('Introduction Text 2');
						$a->display($c);
					?>
				</div>
				<div class="clear"></div>
				<br />

				<?php
					$this->inc('elements/overview-businessmodels-custom.php');
				?>
			</div>

			<div class="section-1">
				<div class="col-md-2"></div>
				<div class="col-md-4 closure">
					<?php
						$a = new Area('Section Text');
						$a->display($c);
					?>
				</div>
				<div class="col-md-4">
					<?php
						$a = new Area('Section Image');
						$a->display($c);
					?>
				</div>
				<div class="col-md-2"></div>
				<div class="clear"></div>
			</div>
		</div>


		<div class="section-2 grey">
			<div class="container">
				<div class="col-md-2"></div>
				<div class="col-md-4 closure">
					<?php
						$a = new Area('Section 2 Image');
						$a->display($c);
					?>
				</div>
				<div class="col-md-4">
					<?php
						$a = new Area('Section 2 Text');
						$a->display($c);
					?>
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
	$this->inc('elements/footer.php');
?>
