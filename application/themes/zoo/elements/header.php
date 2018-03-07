<!DOCTYPE HTML>
<html>
<head>

	<?php Loader::element('header_required'); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/css/reset.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/css/normalize.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/less" href="<?php echo $this->getThemePath()?>/css/main.less" />
	<link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/css/responsive.css" />
  <link rel="stylesheet" type="text/css" href="<?php echo $this->getThemePath()?>/css/animation.css" />

	<?php
	  $u = new User();
	  if(!$u->isSuperUser()) {  ?>

	<script type="text/javascript" src="<?php echo $this->getThemePath()?>/js/jquery.min.js"></script>

	<?php } ?>

	<script type="text/javascript" src="<?php echo $this->getThemePath()?>/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->getThemePath()?>/js/less.min.js"></script>
	<script type="text/javascript" src="<?php echo $this->getThemePath()?>/js/modernizer.js"></script>

</head>
<body>

	<div class="<?php echo $c->getPageWrapperClass()?>" id="wrapper">
		<div class="container">

			<div id="adjustSame">

				<div id="logo">
					<a href="/" title="Businessmodelzoo">
						<img src="<?php echo $this->getThemePath()?>/img/businessmodelzoo-logo.png" alt="Businessmodelzoo" />
					</a>
				</div>

				<button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle collapsed menubutton" type="button">
		            <span class="menu-bar-info">Menu</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		        </button>

				<div id="main-navigation">
					<?php
						$nav = BlockType::getByHandle('autonav');
						$nav->controller->orderBy = 'display_asc';
						$nav->controller->displayPages = 'top';
						$nav->controller->displaySubPages = 'all';
						$nav->controller->displaySubPageLevels = 'custom';
						$nav->controller->displaySubPageLevelsNum = 1;
						$nav->render('templates/mainNavigation');
					?>

					<div class="clear"></div>
				</div>
				<div class="clear"></div>

				<div id="login" class="hidden-xs">

					<?php
						$a = new GlobalArea('Login and Logout');
	   					$a->display($c);
					?>

				</div>

			</div>

		</div>
