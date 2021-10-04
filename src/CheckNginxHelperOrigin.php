<?php
/**
 * Verify there's a newline at the end of tasks.cron file.
 */

namespace Geniem\Project;

/**
 * CheckNginxHelperOrigin class.
 */
class CheckNginxHelperOrigin {
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
        if ( \file_exists( WP_CONTENT_DIR . '/../../composer.json' ) ) {
            $contents = \file_get_contents( WP_CONTENT_DIR . '/../../composer.json' );

            if ( \stristr( $contents, 'rtcamp/nginx-helper' ) !== false ) {
                if ( \stristr( $contents, 'git@github.com:devgeniem/nginx-helper.git' ) === false ) {
                    \Geniem\admin_notice(
                        'error',
                        'Paketti "rtcamp/nginx-helper" haetaan packagistista, eikä meidän omasta reposta<br><br>
                        Lisää alla oleva koodi composer.json tiedostoon.<br><br>
                        {<br>
                            "type": "git",<br>
                            "url": "git@github.com:devgeniem/nginx-helper.git"<br>
                        }'
                    );
                }
            }
        }
    }
}
