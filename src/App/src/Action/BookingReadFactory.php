<?php

namespace App\Action;

use App\Action\BookingReadAction;
use App\Action\BookingReadFactory;
use Psr\Container\ContainerInterface;
use Zend\Expressive\Router\RouterInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
use Zend\Db\Adapter\AdapterInterface;

class BookingReadFactory
{
    public function __invoke(ContainerInterface $container)
    {
        $adapter = $container->get(AdapterInterface::class);

        return new BookingReadAction($adapter);
    }
}
