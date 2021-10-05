<?php
/**
 * Disable big image size threshold.
 */

namespace Geniem\Project;

/**
 * DisableBigImageSizeTreshold class.
 */
class DisableBigImageSizeTreshold {

    /**
     * The constructor.
     */
    public function __construct() {
        \add_filter( 'big_image_size_threshold', '__return_false' );
    }
}
