<?php
/**
 * Fix a date format bug in WP Stream database queries.
 * Original date format in plugin is not supported by our platform.
 */

namespace Geniem\Project;

/**
 * FixStreamDateFormat class
 */
class FixStreamDateFormat {

    /**
     * The constructor ads the hook.
     */
    public function __construct() {
        \add_action( 'wp_stream_record_array', [ $this, 'fix_stream_date_format' ], 10, 1 );
    }

    /**
     * Convert date field value for Stream plugin.
     *
     * @param array $data Data that Stream saves.
     *
     * @return array
     */
    public function fix_stream_date_format( $data ) {
        $data['created'] = date( 'Y-m-d H:i:s', strtotime( $data['created'] ) );

        return $data;
    }
}
