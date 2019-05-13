<?php

namespace App;

/**
 * The configuration provider for the App module
 *
 * @see https://docs.zendframework.com/zend-component-installer/
 */
class ConfigProvider
{
    /**
     * Returns the configuration array
     *
     * To add a bit of a structure, each section is defined in a separate
     * method which returns an array with its configuration.
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => $this->getDependencies(),
            'templates'    => $this->getTemplates(),
        ];
    }

    /**
     * Returns the container dependencies
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            'invokables' => [
                //Action\PingAction::class => Action\PingAction::class,
            ],
            'factories'  => [
                //Action\HomePageAction::class => Action\HomePageFactory::class,
                Action\BookingReadAction::class => Action\BookingReadFactory::class,
                Action\BookingUpdateAction::class => Action\BookingUpdateFactory::class,
                Action\BookingCreateAction::class => Action\BookingCreateFactory::class,
                Action\BookingDeleteAction::class => Action\BookingDeleteFactory::class,
                Action\BookingCreateFormAction::class => Action\BookingCreateFormFactory::class,
                Action\BookingUpdateFormAction::class => Action\BookingUpdateFormFactory::class,
                Action\BookingReadFormAction::class => Action\BookingReadFormFactory::class,
                Action\BookingDeleteFormAction::class => Action\BookingDeleteFormFactory::class,
            ],
        ];
    }

    /**
     * Returns the templates configuration
     *
     * @return array
     */
    public function getTemplates()
    {
        return [
            'paths' => [
                'app'    => [__DIR__ . '/../templates/app'],
                'error'  => [__DIR__ . '/../templates/error'],
                'layout' => [__DIR__ . '/../templates/layout'],
            ],
        ];
    }
}
