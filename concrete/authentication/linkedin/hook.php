<?php defined('C5_EXECUTE') or die('Access Denied.'); ?>

<div class="form-group">
        <span>
            <?php echo t('Attach a %s account', t('LinkedIn')) ?>
        </span>
    <hr>
</div>
<div class="form-group">
    <a href="<?php echo \URL::to('/ccm/system/authentication/oauth2/linkedin/attempt_attach'); ?>" class="btn btn-primary btn-linkedin">
        <i class="fa fa-linkedin"></i>
        <?php echo t('Attach a %s account', t('LinkedIn')) ?>
    </a>
</div>

<style>
    .ccm-ui .btn-linkedin {
        border-width: 0px;
        background: #dd4b39;
    }
    .ccm-ui .btn-linkedin:focus {
        background: #dd4b39;
    }
    .ccm-ui .btn-linkedin:hover {
        background: #f04f3d;
    }
    .ccm-ui .btn-linkedin:active {
        background: #c74433;
    }

    .btn-linkedin .fa-linkedin {
        margin: 0 6px 0 3px;
    }
</style>
