<?php

return array(
	'email'             => array(

        /**
         * Enable emails
         *
         * @var bool
         */
        'enabled' => true,
        'default' => array(
            'address' => 'noreply@' . $_SERVER['SERVER_NAME'],
            'name'    => 'Business Model Zoo'
        ),
        'form_block' => array(
            'address' => false
        )
    ),
    'white_label'       => array(

        /**
         * Custom Logo source path relative to the public directory.
         *
         * @var bool|string The logo path
         */
        'logo'                 => '/application/themes/zoo/img/dashboard_icon.png'
     )
);