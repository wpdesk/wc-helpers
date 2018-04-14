<?php

namespace WPDesk;

interface SupportsAutoloading {

    /** @return \DateTimeInterface */
    public function get_release_date();

    /** @return \SplFileInfo */
    public function get_autoload_file();

    /** @return \WPDesk\WP\Plugin\AbstractPlugin */
    public function build_plugin();
}