<?php
	  if( !Page::getCurrentPage()->isEditMode() ) {  ?>
		<script src="<?php echo $this->getThemePath()?>/addons/matchHeight/jquery.matchHeight.js" type="text/javascript"></script>
		<script>
			$(function() {
			    $('.colored').matchHeight({
			    	property: 'height'
			    });
			});
		</script>
<?php } ?>
<div id="overview-Businessmodels">

	<div class="row">
		<div class="relative">
			
			<div class="col-md-6">
				<div class="row">
					<div class="relative">
						<div class="col-xs-6">
							<div class="relative_z-1 yellow colored">
								<div class="icons">
									<a href="/business-models/product-model">
										<span class="icon-product_icon_b"></span>
									</a>
								</div>
								<div class="text-headline">
									<span class="number-headline">
										<a href="/business-models/product-model">01.</a>
									</span>
									<h2>
										<a href="/business-models/product-model">
											PRODUCT<br />MODEL
										</a>
									</h2>
									<div class="text-common">
										<?php 
											$a = new GlobalArea('Product model categorie text'); 
											$a->display($c); 
										?>
									</div>
								</div>
								<div class="col-md-12 bottom">
									<a href="/business-models/product-model" title="Find out more" class="btn transparent center margin20">Find out more</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						
						<div class="col-xs-6">
							<div class="relative_z-1 orange colored">
								<div class="icons">
									<a href="/business-models/solutions-model">
										<span class="icon-solutions_icon_b"></span>
									</a>
								</div>
								<div class="text-headline">
									<span class="number-headline">
										<a href="/business-models/solutions-model">02.</a>
									</span>
									<h2>
										<a href="/business-models/solutions-model">
											SOLUTIONS<br />MODEL
										</a>
									</h2>
									<div class="text-common">
										<?php 
											$a = new GlobalArea('Solutions model categorie text'); 
											$a->display($c); 
										?>
									</div>
								</div>
								<div class="col-md-12 bottom">
									<a href="/business-models/solutions-model" title="Find out more" class="btn transparent center margin20">Find out more</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>	
				
				
			<div class="col-md-6">
				<div class="row">
					<div class="relative">
						<div class="col-xs-6">
							<div class="relative_z-1 blue colored">
								<div class="icons">
									<a href="/business-models/matchmaking-model">
										<span class="icon-matchmaking_icon_b"></span>
									</a>
								</div>
								<div class="text-headline">
									<span class="number-headline">
										<a href="/business-models/matchmaking-model">03.</a>
									</span>
									<h2>
										<a href="/business-models/matchmaking-model">
											MATCHMAKING<br />MODEL
										</a>
									</h2>
									<div class="text-common">
										<?php 
											$a = new GlobalArea('Matchmaking categorie text'); 
											$a->display($c); 
										?>
									</div>
								</div>
								<div class="col-md-12 bottom">
									<a href="/business-models/matchmaking-model" title="Find out more" class="btn transparent center margin20">Find out more</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
						
						<div class="col-xs-6">
							<div class="relative_z-1 green colored">
								<div class="icons">
									<a href="/business-models/multi-sided-model">
										<span class="icon-multisided_icon_b"></span>
									</a>
								</div>
								<div class="text-headline">
									<span class="number-headline">
										<a href="/business-models/multi-sided-model">04.</a>
									</span>
									<h2>
										<a href="/business-models/multi-sided-model">
											MULTI-SIDED<br />MODEL
										</a>
									</h2>
									
									<div class="text-common">
										<?php 
											$a = new GlobalArea('Multi-sided categorie text'); 
											$a->display($c); 
										?>
									</div>
								</div>
								<div class="col-md-12 bottom">
									<a href="/business-models/multi-sided-model" title="Find out more" class="btn transparent center margin20">Find out more</a>
								</div>
								<div class="clear"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			
			<div class="clear"></div>
		</div>
	</div>

</div>