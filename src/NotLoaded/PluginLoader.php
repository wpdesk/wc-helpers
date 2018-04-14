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

    private static $loadables = [];
    private static $load_hook_added = false;

    public function register_plugin(SupportsAutoloading $loadable)
    {
        self::$loadables[] = [
            self::LOADABLE_KEY_OBJECT => $loadable,
            self::LOADABLE_KEY_LOADED => false,
            self::LOADABLE_KEY_BUILT => false
        ];
        $this->register_load_hook_if_needed();
    }

    private function register_load_hook_if_needed()
    {
        if (!self::$load_hook_added) {
            self::$load_hook_added = add_action(self::HOOK_TO_LOAD_LOADERS, [$this, 'load_build_all'], 1,
                self::LOADER_PRIORITY);
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
        foreach (self::$loadables as $loadable) {
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
        usort(self::$loadables, function ($a, $b) {
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