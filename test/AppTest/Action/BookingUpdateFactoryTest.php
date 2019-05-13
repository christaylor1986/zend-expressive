<?php

namespace AppTest\Action;

use App\Action\BookingUpdateAction;
use App\Action\BookingUpdateFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

class BookingUpdateFactoryTest extends TestCase
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
        $factory = new BookingUpdateFactory();
        $this->assertInstanceOf(BookingUpdateFactory::class, $factory);

        $bookingUpdate = $factory($this->container->reveal());
        $this->assertInstanceOf(BookingUpdateAction::class, $bookingUpdate);
    }
}
