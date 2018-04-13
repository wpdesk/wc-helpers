<?php

namespace WPDesk\WP\Plugin;

class Builder implements SupportsAutoloading
{
    const PHP_EXTENSION = '.php';
    const HOOK_PLUGIN_CLASS = 'wpdesk_plugin_class';

    /** @var array */
    private static $instances = [];

    /** @var string */
    private $class;

    /** @var array */
    private $plugin_core_info;

    /**
     * @param string $class
     * @param array $plugin_core_info
     */
    public function __construct($class, $plugin_core_info)
    {
        $this->class = $class;
        $this->plugin_core_info = $plugin_core_info;
    }

    /**
     * Builds instance if needed and ensures there is only one instance.
     *
     * @return AbstractPlugin
     */
    public static function get_plugin_instance($class)
    {
        return self::$instances[$class];
    }

    /**
     * @return \DateTimeImmutable|\DateTimeInterface
     * @throws \Exception
     */
    public function get_release_date()
    {
        return new \DateTimeImmutable($this->plugin_core_info['release_date']);
    }

    /**
     * @return string
     */
    public function get_autoload_file()
    {
        return $this->plugin_core_info['composer.json'];
    }

    /**
     * Builds instance of plugin. If called more than once then more than one instance is created.
     *
     * @return AbstractPlugin
     */
    public function build_plugin()
    {
        $class_name = apply_filters(self::HOOK_PLUGIN_CLASS, $this->class);

        $plugin_dir = dirname(dirname(__FILE__));
        $plugin_file = trailingslashit($plugin_dir) . basename($plugin_dir) . self::PHP_EXTENSION;

        return new $class_name($plugin_file, $this->plugin_core_info);
    }
}