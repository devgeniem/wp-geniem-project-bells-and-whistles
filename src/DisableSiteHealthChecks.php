<?php
/**
 * Disable Site Health Checks that shouldn't be tested with our project configurations.
 */

namespace Geniem\Project;

/**
 * Disable Site Health Checks that shouldn't be tested with our project configurations.
 *
 * @see \WP_Site_Health::get_tests
 */
class DisableSiteHealthChecks {
    /**
     * The constructor.
     */
    public function __construct() {
        $tests_to_disable = apply_filters(
            'geniem/bells_and_whistles/disabled_site_health_checks',
            [
                'sql_server', // Uses removed mysql_get_server_info()
                'utf8mb4_support',  // Uses removed mysql_get_server_info()
                'plugin_theme_auto_updates', // We manage our own updates
                'background_updates', // We manage our own updates
            ]
        );

        if ( ! empty( $tests_to_disable ) ) {
            foreach ( $tests_to_disable as $test ) {
                // Run like: $this->__call( disable_test_[sql_server], [ \WP_Site_Health::get_tests() ] );
                add_filter( 'site_status_tests', [ $this, 'disable_test_' . $test ], 10000 );
            }
        }

        if ( defined( 'WP_ENV' ) && WP_ENV === 'development' ) {
            // $this->__call( disable_test_debug_enabled, [ \WP_Site_Health::get_tests() ] );
            add_filter( 'site_status_tests', [ $this, 'disable_test_debug_enabled' ], 10000 );
        }
    }

    /**
     * Magic method to enable dynamic rule disabling.
     *
     * Constructor uses it like this:
     * $this->__call( disable_test_sql_server, [ \WP_Site_Health::get_tests() ] );
     *
     * @param string $func      Function name with rule name after disable_test_.
     * @param array  $arguments Arguments. Array with WP_Site_Health tests to run on this site.
     */
    public function __call( $func, $arguments ) {
        $option = str_replace( 'disable_test_', '', $func );
        $tests  = array_shift( $arguments );

        return $this->disable_test( $option, $tests );
    }

    /**
     * Helper method to disable test without knowing or caring if it's direct, or async.
     *
     * @param string $key   Test to disable.
     * @param array  $tests \WP_Site_Health::get_tests() tests.
     *
     * @return array
     */
    public function disable_test( string $key = '', array $tests = [] ) : array {
        if ( empty( $tests ) ) {
            return $tests;
        }

        if ( ! array_key_exists( 'direct', $tests ) ) {
            $tests['direct'] = [];
        }

        if ( ! array_key_exists( 'async', $tests ) ) {
            $tests['async'] = [];
        }

        if ( array_key_exists( $key, $tests['direct'] ) ) {
            unset( $tests['direct'][ $key ] );
        }

        if ( array_key_exists( $key, $tests['async'] ) ) {
            unset( $tests['async'][ $key ] );
        }

        return $tests;
    }
}
