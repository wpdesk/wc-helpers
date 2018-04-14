<?php

namespace WPDesk\WP\Plugin;

interface SupportsAutoloading {

    /** @return \DateTimeInterface */
    public function get_release_date();

    /** @return \SplFileInfo */
    public function get_autoload_file();

    /** @return AbstractPlugin */
    public function build_plugin();
}