<?php

namespace ContactOptionBuilder\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class ConfigurationHook extends BaseHook
{
    /**
     * Add module configuration content
     *
     * @param HookRenderEvent $hookRenderEvent
     */
    public function onModuleConfiguration(HookRenderEvent $hookRenderEvent)
    {
        $hookRenderEvent->add(
            $this->render(
                'module_configuration.html',
                [
                    'kernelEnvironment' => $this->environment
                ]
            )
        );
    }
}
