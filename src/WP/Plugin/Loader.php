<?php

namespace WPDesk\WP\Plugin;

class Loader
{
    private static $loadables = [];
    private static $load_hook_added = false;

    const LOADER_PRIORITY = 80;
    const HOOK_TO_LOAD_LOADERS = 'plugins_loaded';

    public function register_plugin(SupportsAutoloading $loadable)
    {
        self::$loadables[] = ['object' => $loadable, 'loaded' => false];
        $this->register_load_hook_if_needed();
    }

    private function register_load_hook_if_needed()
    {
        if (!self::$load_hook_added) {
            self::$load_hook_added = add_action(self::HOOK_TO_LOAD_LOADERS, [$this, 'load_autoloaders'], 1,
                self::LOADER_PRIORITY);
        }
    }

    private function sortLoadables()
    {
        usort(self::$loadables, function ($a, $b) {
            /** @var SupportsAutoloading $objectA */
            $objectA = $a['object'];
            /** @var SupportsAutoloading $objectB */
            $objectB = $b['object'];

            return $objectA->get_release_date()->getTimestamp() - $objectB->get_release_date()->getTimestamp();
        });
    }

    public function load_autoloaders()
    {
        $this->sortLoadables();
        foreach (self::$loadables as $loadable) {
            if (!$loadable['loaded']) {
                /** @var SupportsAutoloading $object */
                $object = $loadable['object'];

                /** @var SupportsAutoloading $loadable */
                require_once($object->get_autoload_file());

                $loadable['loaded'] = true;
            }
        }
    }
}