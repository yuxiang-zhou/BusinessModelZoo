<?php  defined("C5_EXECUTE") or die("Access Denied."); ?>

<div class="row">
	<div class="col-md-4 closure">
		<?php  if ($employee) { ?>
		    <?php 
		    $im = Core::make('helper/image');
		    if ($thumb = $im->getThumbnail($employee, 350, 350, true)) {
		        ?><img src="<?php  echo $thumb->src; ?>" alt="<?php  echo $employee->getTitle(); ?>" class="img-responsive fllt"/><?php 
		    } ?>
		<?php  } ?>
	</div>
	<div class="col-md-8 closure">
		<?php  if (isset($info) && trim($info) != "") { ?>
		    <?php  echo $info; ?><?php  } ?>
	</div>
	<div class="clear"></div>
</div>