<?php

namespace AppTest\Action;

use App\Action\BookingDeleteAction;
use App\Action\BookingDeleteFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

class BookingDeleteFactoryTest extends TestCase
{
    protected $container;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $adapter = $this->prophesize(AdapterInterface::class);

        $this->container->get(AdapterInterface::class)->willReturn($adapter);
    }

    public function testFactory()
    {
        $factory = new BookingDeleteFactory();
        $this->assertInstanceOf(BookingDeleteFactory::class, $factory);

        $bookingDelete = $factory($this->container->reveal());
        $this->assertInstanceOf(BookingDeleteAction::class, $bookingDelete);
    }
}
