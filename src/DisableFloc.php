<?php
/**
 * Treat FLoC as a security concern.
 *
 * TL;DR: FLoC places people in groups based on their browsing habits to target advertising.
 *
 * Why is this bad?
 * As the Electronic Frontier Foundation explains in their post
 * “Google’s FLoC is a terrible idea“[1], placing people in groups based on their browsing
 * habits is likely to facilitate employment, housing and other types of discrimination,
 * as well as predatory targeting of unsophisticated consumers.
 *
 * This is in addition to the privacy concerns of tracking people and sharing their data,
 * seemingly without informed consent – and making it more difficult for legislators and
 * regulators to protect people.
 *
 * [1]: https://www.eff.org/deeplinks/2021/03/googles-floc-terrible-idea
 * Source: https://make.wordpress.org/core/2021/04/18/proposal-treat-floc-as-a-security-concern/
 */

namespace Geniem\Project;

/**
 * DisableFloc class.
 */
class DisableFloc {

    /**
     * The constructor.
     */
    public function __construct() {
        add_action( 'init', [ $this, 'run_on_init' ] );
    }

    /**
     * Add wp_headers filter.
     *
     * @return void
     */
    public function run_on_init() {
        add_filter( 'wp_headers', [ $this, 'disable_floc' ] );
    }

    /**
     * Add `interest-cohort=()` as `Permissions-Policy` header.
     *
     * @param array $headers WP_Headers array.
     *
     * @return array
     */
    public function disable_floc( $headers = [] ) {
        $headers['Permissions-Policy'] = 'interest-cohort=()';

        return $headers;
    }
}
