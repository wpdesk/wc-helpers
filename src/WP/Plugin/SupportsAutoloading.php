<?php

namespace WPDesk\WP\Plugin;

interface SupportsAutoloading {

    /** @return \DateTime */
    public function get_release_date();

    /** @return string */
    public function get_autoload_file();
}