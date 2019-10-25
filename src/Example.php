<?php
/**
 * An example class for running a function on the WP init hook.
 */

namespace Geniem\Project;

/**
 * Example class.
 */
class Example {

    /**
     * The constructor.
     */
    public function __construct() {
        add_action( 'init', [ $this, 'run_on_init' ] );
    }

    /**
     * Do something on the WP init hook.
     *
     * @return void
     */
    public function run_on_init() {
        // I could do something, but not gonna for now..
    }

}
