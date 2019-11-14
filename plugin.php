<?php
/**
 * Plugin Name: Geniem WP Project Bells & Whistles
 * Plugin URI: https://github.com/devgeniem/wp-plugin-boilerplate
 * Description: A collection of various configurations and fixes for Geniem WordPress projects.
 * Version: 1.1.0
 * Author: Geniem Oy
 * Author URI: https://geniem.com
 * License: GPL3
 */

use Geniem\Project;

// Check if Composer has been initialized in this directory.
// Otherwise we just use global composer autoloading.
if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

/**
 * Check if a class should not be executed.
 *
 * @param string $class_name The class name.
 * @return boolean
 */
function is_disabled_class( $class_name ) {
    $disable  = defined( 'GENIEM_DISABLE_BELLS_AND_WHISTLES' ) ? GENIEM_DISABLE_BELLS_AND_WHISTLES : [];
    $disabled = in_array( $class_name, $disable );

    return $disabled;
}

// Add your feature classes here.
$classes = [
    Project\DisableAdminEmailVerification::class,
];

// Run constructors for all defined feature classes.
array_walk( $classes, function( $class_name ) {
    if ( class_exists( $class_name ) && ! is_disabled_class( $class_name ) ) {
        new $class_name();
    }
} );
