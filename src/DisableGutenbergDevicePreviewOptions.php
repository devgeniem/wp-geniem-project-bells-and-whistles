<?php
/**
 * Disable Gutenberg device preview options (Mobile, Tablet)
 */

namespace Geniem\Project;

/**
 * DisableGutenbergDevicePreviewOptions class.
 */
class DisableGutenbergDevicePreviewOptions {

    /**
     * The constructor.
     */
    public function __construct() {
        add_action( 'enqueue_block_editor_assets', [ $this, 'disable_gutenberg_device_preview_options' ] );
    }

    /**
     * Register inline styles hiding the options from Gutenberg device preview dropdown
     *
     * @return void
     */
    public function disable_gutenberg_device_preview_options() {
        $style = '
.edit-post-post-preview-dropdown .components-dropdown-menu__menu .components-menu-group + .components-menu-group {
    border-top: none;
}

.block-editor-post-preview__button-resize {
    display: none;
}';

        wp_add_inline_style( 'wp-block-library', $style );
    }
}
