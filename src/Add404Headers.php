<?php
/**
 * Remove no-cache headers from 404 error pages.
 */

namespace Geniem\Project;

/**
 * DisableAdminEmailVerification class.
 */
class Add404Headers {

    /**
     * The constructor.
     */
    public function __construct() {
        add_filter( 'nocache_headers', function( $headers ) {
            if ( ! is_admin() ) {
                $headers = [];
            }

            return $headers;
        }, 1000, 1 );
    }
}
