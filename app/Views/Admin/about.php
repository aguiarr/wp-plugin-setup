<div class="wrap wpt-wrap">
    <?php

use WPT\Helpers\Config;

 $header = require __DIR__ . '/template-parts/header.php'; ?>
    
    <div class="wpt-container wpt-container-about">
        <div>
            <div class="title">
                <h1><?php echo __( "Hello World!", 'wp-plugin-template' ); ?></h1>
                <img src="<?php echo esc_url( Config::__images( 'cb-icon.png' ) ) ?>" alt="Code Backery Icon">
                <hr>
            </div>
            <div class="content">
                <div>
                    <p><?php echo __( "This is a Wordpress plugin setup. You can use to initiate a WordPress plugin!", 'wp-plugin-template' ); ?></p>
                </div>
                <div>
                    <p><?php echo __( "What changes the environment is the point of view. Use wisely!", 'wp-plugin-template' ); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>
