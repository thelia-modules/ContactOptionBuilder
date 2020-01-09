<?php

namespace ContactOptionBuilder\Hook;

use ContactOptionBuilder\ContactOptionBuilder;

use Thelia\Core\Event\Hook\HookRenderBlockEvent;
use Thelia\Core\Hook\BaseHook;
use Thelia\Core\Security\AccessManager;
use Thelia\Core\Security\SecurityContext;
use Thelia\Tools\URL;

/**
 * Class AdminInterfaceHook
 */
class AdminInterfaceHook extends BaseHook
{
    protected $securityContext;

    public function __construct(SecurityContext $securityContext)
    {
        $this->securityContext = $securityContext;
    }

    public function onMainTopMenuTools(HookRenderBlockEvent $event)
    {
        $isGranted = $this->securityContext->isGranted(
            ["ADMIN"],
            [],
            [ContactOptionBuilder::getModuleCode()],
            [AccessManager::VIEW]
        );

        if ($isGranted) {

            $event->add(
                [
                    'id' => 'tools_menu_contact_builder',
                    'class' => '',
                    'url' => URL::getInstance()->absoluteUrl('/admin/module/ContactOptionBuilder'),
                    'title' => $this->trans('Contact Form Builder', [], ContactOptionBuilder::DOMAIN_NAME)
                ]
            );
            //$event->add($this->render("menu-hook.html", $event->getArguments()));
        }
    }
}
