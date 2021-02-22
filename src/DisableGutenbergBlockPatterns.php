<?php
/**
 * Disable Gutenberg block patterns
 */

namespace Geniem\Project;

/**
 * DisableGutenbergBlockPatterns class.
 */
class DisableGutenbergBlockPatterns {

    /**
     * The constructor.
     */
    public function __construct() {
        add_action( 'after_setup_theme', [ $this, 'disable_gutenberg_block_patterns' ] );
    }

    /**
     * Remove theme support for core-block-patterns
     *
     * @return void
     */
    public function disable_gutenberg_block_patterns() {
        remove_theme_support( 'core-block-patterns' );
    }
}
