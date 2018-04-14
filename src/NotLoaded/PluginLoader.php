<?php

namespace WPDesk;

class PluginLoader
{
    const LOADER_PRIORITY = 80;

    const HOOK_TO_LOAD_LOADERS = 'plugins_loaded';
    const HOOK_AUTOLOADERS_LOADED = 'autoloaders_loaded';
    const HOOK_PLUGINS_BUILT = 'plugins_built';

    const LOADABLE_KEY_OBJECT = 'object';
    const LOADABLE_KEY_BUILT = 'built';
    const LOADABLE_KEY_LOADED = 'loaded';

    protected static $loadables = [];
	protected static $load_hook_added = false;

    public function register_plugin(SupportsAutoloading $loadable)
    {
        self::$loadables[] = [
            self::LOADABLE_KEY_OBJECT => $loadable,
            self::LOADABLE_KEY_LOADED => false,
            self::LOADABLE_KEY_BUILT => false
        ];
        $this->register_load_hook_if_needed();
    }

	public function register_load_hook_if_needed()
    {
        if (!static::$load_hook_added) {
	        static::$load_hook_added = add_action(self::HOOK_TO_LOAD_LOADERS, [$this, 'load_build_all'], 1,
                self::LOADER_PRIORITY);
        }
    }

    public function disable_loader_hook_permanently() {
		$this->remove_action_by_class(self::HOOK_TO_LOAD_LOADERS, [self::class => 'load_build_all'], self::LOADER_PRIORITY);
    }

	/**
	 * Remove action by class name
	 *
	 * @param string $hook_name
	 * @param array $class_and_function_list
	 * @param int $priority
	 * @see https://gist.github.com/scarstens/87cfdf482a2e6b412d84
	 */
    private function remove_action_by_class($hook_name, $class_and_function_list, $priority = 10) {
	    global $wp_filter;
	    // go through manually created class and function list
	    foreach($class_and_function_list as $class_search => $function_search){
		    //limit removals to matching action names (wildcard string matching)
		    foreach($wp_filter[$hook_name][$priority] as $instance => $action){
			    //limit removals again to matching class and function names (wildcard string matching)
			    if( stristr($instance,$function_search) && stristr(get_class($action['function'][0]),$class_search) ) {
				    //action found, removing action from filters
				    unset($wp_filter[$hook_name][10][$instance]);
			    }
		    }
	    }
    }

    public function load_build_all()
    {
        $this->loadAutoloaders();
        $this->buildPlugins();
    }

    private function loadAutoloaders()
    {
        $this->sortLoadables();
        foreach (static::$loadables as $loadable) {
            if (!$loadable[self::LOADABLE_KEY_LOADED]) {
                /** @var SupportsAutoloading $object */
                $object = $loadable[self::LOADABLE_KEY_OBJECT];

                /** @var SupportsAutoloading $loadable */
                require_once($object->get_autoload_file()->getPathname());

                $loadable[self::LOADABLE_KEY_LOADED] = true;
            }
        }
        do_action(self::HOOK_AUTOLOADERS_LOADED);
    }

    private function sortLoadables()
    {
        usort(static::$loadables, function ($a, $b) {
            /** @var SupportsAutoloading $objectA */
            $objectA = $a[self::LOADABLE_KEY_OBJECT];
            /** @var SupportsAutoloading $objectB */
            $objectB = $b[self::LOADABLE_KEY_OBJECT];

            return $objectA->get_release_date()->getTimestamp() - $objectB->get_release_date()->getTimestamp();
        });
    }

    private function buildPlugins()
    {
        $this->sortLoadables();
        foreach (self::$loadables as $loadable) {
            if (!$loadable[self::LOADABLE_KEY_BUILT]) {
                /** @var SupportsAutoloading $object */
                $object = $loadable[self::LOADABLE_KEY_OBJECT];

                /** @var SupportsAutoloading $loadable */
                $object->build_plugin();

                $loadable[self::LOADABLE_KEY_BUILT] = true;
            }
        }
        do_action(self::HOOK_PLUGINS_BUILT);
    }
}