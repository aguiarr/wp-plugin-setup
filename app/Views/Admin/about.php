<?php
/**
 * Name: About Me
 * Package: View
 * Controller: WPPluginSetup\Controllers\About
 * Style File: 
 * Version: 1.0.0
 */
?>

<!DOCTYPE html>

<?php 
    $header = require __DIR__ . '/template-parts/header.php';
     __( $header, 'wp-plugin-setup' );
?>
<div>
    <div>
        <h1>Hello World!</h1>
        <p style="font-size:20px">This is a Wordpress plugin setup. You can use to initiate a Wordpress plugin!</p>
        <div>
            <p>What changes the environment is the point of view. Use <b>wisely</b>!</p>
        </div>
    </div>
</div>
