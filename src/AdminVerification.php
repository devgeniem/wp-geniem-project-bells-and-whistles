<?php
/**
 * Disable WordPress periodical admin email verification
 */

namespace Geniem\Project;

/**
 * DisableAdminEmailVerification class.
 */
class DisableAdminEmailVerification {

    /**
     * The constructor.
     */
    public function __construct() {
        add_filter( 'admin_email_check_interval', '__return_false' );
    }
}
