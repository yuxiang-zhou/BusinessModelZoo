

	<footer>
		<div class="container">
			<div class="col-md-6 closure">
				<div id="logo">
					<a href="/" title="Businessmodelzoo">
						<img src="<?php echo $this->getThemePath()?>/img/businessmodelzoo-logo.png" alt="Businessmodelzoo" />
					</a>
				</div>
				<div class="clear"></div>
				<br />
				Funded by Cass-LSE-Grenoble -Glasgow-Wharton,<br />
				© <?php echo date("Y"); ?>, web design by <a href="http://ertl-design.co.uk" title="ertl-design.co.uk" target="_blank">ertl-design.co.uk</a>
			</div>
			<div class="col-md-3 closure">
				<div id="footerNavigation">
					<?php
						$nav = BlockType::getByHandle('autonav');
						$nav->controller->orderBy = 'display_asc';
						$nav->controller->displayPages = 'top';
						$nav->controller->displaySubPages = 'none';
						$nav->render('templates/mainNavigation');
					?>
				</div>
			</div>
			<div class="col-md-3">
				<ul class="exemplarList">
					<li class="yellow">
						<a href="/business-models/product-model" title="Product Model">
							<span class="icon-product_icon_b"></span>
						</a>
					</li>
					<li class="orange">
						<a href="/business-models/solutions-model" title="Solutions Model">
							<span class="icon-solutions_icon_b"></span>
						</a>
					</li>
					<li class="blue">
						<a href="/business-models/matchmaking-model" title="Matchmaking Model">
							<span class="icon-matchmaking_icon_b"></span>
						</a>
					</li>
					<li class="green last">
						<a href="/business-models/multi-sided-model" title="Multi-sided Model">
							<span class="icon-multisided_icon_b"></span>
						</a>
					</li>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</footer>

</div>

	<?php
		require(DIR_FILES_ELEMENTS_CORE . '/footer_required.php');
	?>
<script>
    $('svg').click(function(event){
		event.preventDefault;
        $('g').each(function(index,elem){
            var cls = elem.classList[0];
			console.log(cls);
			console.log(elem);
            elem.classList.remove(cls);
            void elem.offsetWidth;
            elem.classList.add(cls);
        });
    });

</script>
</body>
</html>
