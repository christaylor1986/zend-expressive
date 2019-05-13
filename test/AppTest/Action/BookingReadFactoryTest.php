<?php

namespace AppTest\Action;

use App\Action\BookingReadAction;
use App\Action\BookingReadFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;

class BookingReadFactoryTest extends TestCase
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
        $factory = new BookingReadFactory();
        $this->assertInstanceOf(BookingReadFactory::class, $factory);

        $bookingRead = $factory($this->container->reveal());
        $this->assertInstanceOf(BookingReadAction::class, $bookingRead);
    }
}
