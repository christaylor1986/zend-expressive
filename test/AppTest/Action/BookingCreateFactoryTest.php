<?php

namespace AppTest\Action;

use App\Action\BookingCreateAction;
use App\Action\BookingCreateFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

class BookingCreateFactoryTest extends TestCase
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
        $factory = new BookingCreateFactory();
        $this->assertInstanceOf(BookingCreateFactory::class, $factory);

        $bookingCreate = $factory($this->container->reveal());
        $this->assertInstanceOf(BookingCreateAction::class, $bookingCreate);
    }
}
