<?php
if (isset($error)) {
    ?>
    <div class="alert alert-danger"><?php echo $error ?></div>
<?php
}
if (isset($message)) {
    ?>
    <div class="alert alert-success"><?php echo $message ?></div>
<?php
}

$user = new User;

if ($user->isLoggedIn()) {
    ?>
    <div class="form-group">
        <span>
            <?php echo t('Attach a %s account', t('LinkedIn')) ?>
        </span>
        <hr>
    </div>
    <div class="form-group">
        <a href="<?php echo \URL::to('/ccm/system/authentication/oauth2/linkedin/attempt_attach'); ?>" class="btn btn-primary btn-linkedin btn-block">
            <i class="fa fa-linkedin"></i>
            <?php echo t('Attach a %s account', t('LinkedIn')) ?>
        </a>
    </div>
<?php
} else {
    ?>
    <div class="form-group">
        <span>
            <?php echo t('Sign in with %s', t('LinkedIn')) ?>
        </span>
        <hr>
    </div>
    <div class="form-group">
        <a href="<?php echo \URL::to('/ccm/system/authentication/oauth2/linkedin/attempt_auth'); ?>" class="btn btn-primary btn-linkedin btn-block">
            <i class="fa fa-linkedin"></i>
            <?php echo t('Log in with %s', 'LinkedIn') ?>
        </a>
    </div>
<?php
}
?>
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
