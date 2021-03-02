<?php
/**
 * Remove the Site Health widget from the dashboard.
 */

namespace Geniem\Project;

/**
 * RemoveSiteHealthWidget class.
 */
class RemoveSiteHealthWidget {

    /**
     * The constructor.
     */
    public function __construct() {
        add_action( 'wp_dashboard_setup', [ $this, 'wp_dashboard_setup' ] );
    }

    /**
     * Remove the Site Health widget from the dashboard
     *
     * @return void
     */
    public function wp_dashboard_setup() {
        \remove_meta_box( 'dashboard_site_health', 'dashboard', 'normal' );
    }

}
