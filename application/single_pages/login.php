<?php
use Concrete\Core\Attribute\Key\Key;
use Concrete\Core\Http\ResponseAssetGroup;

defined('C5_EXECUTE') or die('Access denied.');

$r = ResponseAssetGroup::get();
$r->requireAsset('javascript', 'underscore');
$r->requireAsset('javascript', 'core/events');

$form = Loader::helper('form');

if (isset($authType) && $authType) {
    $active = $authType;
    $activeAuths = array($authType);
} else {
    $active = null;
    $activeAuths = AuthenticationType::getList(true, true);
}
if (!isset($authTypeElement)) {
    $authTypeElement = null;
}
$image = date('Ymd') . '.jpg';

/** @var Key[] $required_attributes */

$attribute_mode = (isset($required_attributes) && count($required_attributes));
?>
	<div class="col-md-3"></div>
	<div class="col-md-6">
		<div class="row">
			<?php Loader::element('system_errors', array('error' => $error)); ?>
		</div>
	</div>
	<div class="col-md-3"></div>
	<div class="clear"></div>
	
	<br />

    <?php
    if ($attribute_mode) {
        ?>
        <i class="fa fa-question"></i>
        <span><?php echo t('Attributes') ?></span>
    <?php
    } else if (count($activeAuths) > 1) {
        ?>
      

        <?php
    }
    ?>
            
    <?php
    if ($attribute_mode) {
        $attribute_helper = new Concrete\Core\Form\Service\Widget\Attribute();
        ?>
        <form action="<?php echo View::action('fill_attributes') ?>" method="POST">
            <div data-handle="required_attributes"
                 class="authentication-type authentication-type-required-attributes">
                <div class="ccm-required-attribute-form"
                     style="height:340px;overflow:auto;margin-bottom:20px;">
                    <?php
                    foreach ($required_attributes as $key) {
                        echo $attribute_helper->display($key, true);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary pull-right"><?php echo t('Submit') ?></button>
                </div>

            </div>
        </form>
        <?php
    } else {
        /** @var AuthenticationType[] $activeAuths */

        foreach ($activeAuths as $auth) {
            ?>
            <div data-handle="<?php echo $auth->getAuthenticationTypeHandle() ?>"
                 class="authentication-type authentication-type-<?php echo $auth->getAuthenticationTypeHandle() ?>">
                <?php $auth->renderForm($authTypeElement ?: 'form', $authTypeParams ?: array()) ?>
            </div>
        <?php
        }
    }
    ?>
    
<script>
	$(function(){
		
		//First disable Button
		$( ".acceptTaC" ).prop( "disabled", true );
		$( ".valueTC" ).prop('checked', false);
		//Next Alert Message
		$( ".acceptTaC-upper" ).click(function(){
			if($(this).find('.acceptTaC[disabled]').is(':disabled')){
				alert("Please accept Terms and Conditions, Confidentiality and Copyright!");
			}
		});
		//Make it again active
		$('input.valueTC').change(function(){
		      
		    if( $('input.valueTC:checked').length == $('input.valueTC').length ){
		    	$( ".acceptTaC" ).prop( "disabled", false );
		    }
		    else{
		    	$( ".acceptTaC" ).prop( "disabled", true );
		    }
		 
	    });
		
	});
</script>