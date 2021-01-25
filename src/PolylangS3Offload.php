<?php
/**
 * A fix for Polylang and S3 Offload compatibility problem
 *
 * @see https://github.com/polylang/polylang/issues/421
 */

namespace Geniem\Project;

use \DeliciousBrains\WP_Offload_Media\Items\Media_Library_Item;

/**
 * PolylangS3Offload class.
 */
class PolylangS3Offload {

    /**
     * The constructor.
     */
    public function __construct() {
        add_action(
            'pll_translate_media',
            \Closure::fromCallable( [ $this, 'media_translated' ] ),
            10,
            3
        );

        add_action(
            'as3cf_post_upload_attachment',
            \Closure::fromCallable( [ $this, 'offload_duplicate_items' ] ),
            10,
            2
        );
    }

    /**
     * Fires after Polylang translates a media attachment, and attempts to update new child as offloaded.
     *
     * @param int    $post_id post id of the source media
     * @param int    $tr_id   post id of the new media translation
     * @param string $slug    language code of the new translation
     */
    public function media_translated ( $post_id, $tr_id, $slug ) {
        if ( $post_id &&
            method_exists (
                'DeliciousBrains\WP_Offload_Media\Items\Media_Library_Item',
                'get_by_source_id'
            )
        ) {
            $parent = Media_Library_Item::get_by_source_id( $post_id );

            if ( is_object( $parent ) ) {
                $parent->offload_duplicate_items();
            }
        }
    }

    /**
     * When an item finishes offloading, make sure any duplicates are set as offloaded too.
     *
     * @param int $attachment_id
     * @param Media_Library_Item $as3cf_item
     */
    public function offload_duplicate_items( $attachment_id, $as3cf_item ) {
        if ( is_object( $as3cf_item ) ) {
            $as3cf_item->offload_duplicate_items();
        }
    }

}
