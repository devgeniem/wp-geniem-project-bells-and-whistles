<?php
/**
 * Plugin Name: Geniem WP Project Bells & Whistles
 * Plugin URI: https://github.com/devgeniem/wp-plugin-boilerplate
 * Description: A collection of various configurations and fixes for Geniem WordPress projects.
 * Version: 1.2.0
 * Author: Geniem Oy
 * Author URI: https://geniem.com
 * License: GPL3
 */

namespace Geniem;

use Geniem\Project;

// Check if Composer has been initialized in this directory.
// Otherwise we just use global composer autoloading.
if ( file_exists(__DIR__ . '/vendor/autoload.php' ) ) {
    require_once __DIR__ . '/vendor/autoload.php';
}

// Add your production feature classes here.
$classes = [
    Project\DisableAdminEmailVerification::class,
    Project\Add404Headers::class,
    Project\FixStreamDateFormat::class,
    Project\DisableBigImageSizeTreshold::class,
    Project\DisableFloc::class,
    Project\DisableGutenbergAutoFullscreen::class,
    Project\DisableGutenbergBlockPatterns::class,
    Project\DisableGutenbergDevicePreviewOptions::class,
    Project\DisableSiteHealthChecks::class,
];

// Add your development feature classes here.
if ( WP_ENV === 'development' ) {
    $development_classes = [
        Project\CheckTasksCronFile::class,
    ];
}

// Run constructors for all defined feature classes.
array_walk( $classes, function ( $class_name ) {
    if ( class_exists( $class_name ) && !is_disabled_class( $class_name ) ) {
        new $class_name();
    }
});

if ( WP_ENV === 'development' ) {
    array_walk( $development_classes, function ( $class_name ) {
        if (class_exists( $class_name ) && !is_disabled_class( $class_name ) ) {
            new $class_name();
        }
    });
}

/**
 * Check if a class should not be executed.
 *
 * @param string $class_name The class name without the namespace.
 * @return boolean
 */
function is_disabled_class( $class_name ) {
    // Get the class short name.
    try {
        $short_name = ( new \ReflectionClass( $class_name ) )->getShortName();
    }
    catch( \ReflectionException $e ) {
        // No class found.
        error_log( $e->getMessage() ); // phpcs:ignore
        return true;
    }

    $disable  = defined( 'GENIEM_DISABLE_BELLS_AND_WHISTLES' ) ? GENIEM_DISABLE_BELLS_AND_WHISTLES : [];
    $disabled = in_array( $short_name, $disable, true );

    return $disabled;
}

/**
 * Common notice function so all notices made by this plugin looks the same.
 *
 * @param string $type Type of the error. Usually 'error' or 'notice'.
 * @param string $message The message that is shown to the admin user.
 * @return void
 */
function admin_notice( $type, $message ) {
    add_action( 'admin_notices', function () use ( $type, $message ) {
        echo "<div class='notice notice-$type'><p>$message</p></div>";
    });
}
