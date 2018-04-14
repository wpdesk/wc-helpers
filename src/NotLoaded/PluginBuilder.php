<?php

namespace WPDesk;

class PluginBuilder implements SupportsAutoloading
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
     * Returns instance if it were built
     * @param string $class Plugin class name
     *
     * @return \WPDesk\WP\Plugin\AbstractPlugin
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
     * Builds instance of plugin
     *
     * @return \WPDesk\WP\Plugin\AbstractPlugin
     */
    public function build_plugin()
    {
        $class_name = apply_filters(self::HOOK_PLUGIN_CLASS, $this->class);

        $plugin = new $class_name($this->plugin_core_info['plugin_dir'], $this->plugin_core_info);
        self::$instances[$this->class] = $plugin;
        return $plugin;
    }
}