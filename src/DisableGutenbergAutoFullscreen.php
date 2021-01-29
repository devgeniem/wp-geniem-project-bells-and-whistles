<?php
/**
 * Disable Gutenberg automatic full-screen mode
 */

namespace Geniem\Project;

/**
 * DisableGutenbergAutoFullscreen class.
 */
class DisableGutenbergAutoFullscreen {

    /**
     * The constructor.
     */
    public function __construct() {
        add_action( 'enqueue_block_editor_assets', [ $this, 'disable_gutenberg_auto_fullscreen' ] );
    }

    /**
     * Register inline script disabling auto-fullscreen mode from Gutenberg
     *
     * @return void
     */
    public function disable_gutenberg_auto_fullscreen() {
        $script = "
window.onload = function() {
    if ( wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ) ) {
        wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' );
    }
}";

        wp_add_inline_script( 'wp-blocks', $script );
    }
}
