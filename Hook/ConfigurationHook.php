<?php

namespace ContactOptionBuilder\Hook;

use Thelia\Core\Event\Hook\HookRenderEvent;
use Thelia\Core\Hook\BaseHook;

class ConfigurationHook extends BaseHook
{
    protected $kernelEnvironment;

    /**
     * ConfigurationHook constructor.
     * @param $kernelEnvironment
     */
    public function __construct($kernelEnvironment)
    {
        $this->kernelEnvironment = $kernelEnvironment;
    }

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
                    'kernelEnvironment' => $this->kernelEnvironment
                ]
            )
        );
    }
}
