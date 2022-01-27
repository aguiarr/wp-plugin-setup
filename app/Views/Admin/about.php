<!DOCTYPE html>

<?php 
    $header = require __DIR__ . '/template-parts/header.php';
     __( $header );
?>
<div>
    <div>
        <h1><?php echo __( "Hello World!", WP_PLUGIN_SLUG ); ?></h1>
        <p><?php echo __( "This is a Wordpress plugin setup. You can use to initiate a Wordpress plugin!", WP_PLUGIN_SLUG ); ?></p>
        <div>
            <p><?php echo __( "What changes the environment is the point of view. Use wisely!", WP_PLUGIN_SLUG ); ?></p>
        </div>
    </div>
</div>
