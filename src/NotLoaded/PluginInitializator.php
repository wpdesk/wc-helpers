<?php

namespace WPDesk;

class PluginInitializator implements SupportsAutoloading
{
    const HOOK_PLUGIN_CLASS = 'wpdesk_plugin_class';
	const HOOK_BEFORE_PLUGIN_INIT = 'wpdesk_before_plugin_init';
	const HOOK_AFTER_PLUGIN_INIT = 'wpdesk_before_afterinit';

    /** @var array */
    private static $instances = [];

    /** @var string */
    private $class;

    /** @var array */
    private $plugin_info;

    /**
     * @param string $class
     * @param \WPDesk_PluginInfo $plugin_info
     */
    public function __construct($class, $plugin_info)
    {
        $this->class       = $class;
        $this->plugin_info = $plugin_info;
    }

    /**
     * Returns instance if it were built
     *
     * @param string $class Plugin class name. Must supports initialization
     *
     * @return SupportsInitialization
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
        return new \DateTimeImmutable($this->plugin_info->release_date);
    }

    /**
     * @return \SplFileInfo
     */
    public function get_autoload_file()
    {
    	return new \SplFileInfo($this->plugin_info->autoloader);
    }

    /**
     * Builds instance of plugin
     *
     * @return SupportsInitialization
     */
    public function build_plugin()
    {
        $class_name = apply_filters(self::HOOK_PLUGIN_CLASS, $this->class);

        /** @var SupportsInitialization $plugin */
        $plugin = new $class_name($this->plugin_info);
        self::$instances[$this->class] = $plugin;
        do_action(self::HOOK_BEFORE_PLUGIN_INIT, $plugin);
	    $plugin->init();
	    do_action(self::HOOK_AFTER_PLUGIN_INIT, $plugin);
        return $plugin;
    }
}