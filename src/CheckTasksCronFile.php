<?php
/**
 * Verify there's a newline at the end of tasks.cron file.
 */

namespace Geniem\Project;

/**
 * CheckTasksCronFile class.
 */
class CheckTasksCronFile {
    /**
     * The constructor.
     */
    public function __construct() {
        \add_action( 'init', [ $this, 'run_on_init' ] );
    }

    /**
     * Check if the last character on the tasks.cron file is a newline and let the user know if it's not.
     *
     * @return void
     */
    public function run_on_init() {
        if ( \file_exists( WP_CONTENT_DIR . '/../../tasks.cron' ) ) {
            $file = \fopen( WP_CONTENT_DIR . '/../../tasks.cron', 'r' );
            \fseek( $file, -1, SEEK_END );
            $char = \fgetc( $file );

            if ( $char !== "\n" ) {
                \Geniem\admin_notice(
                    'error',
                    'Projektin juuressa olevan tasks.cron tiedoston lopussa ei ole rivinvaihtoa. Käy lisäämässä se sinne.'
                );
            }
        }
    }
}
