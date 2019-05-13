<?php

namespace AppTest\Action;

use App\Action\BookingUpdateAction;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Db\Adapter\AdapterInterface;

class BookingUpdateActionTest extends TestCase
{
    protected $adapter;

    protected function setUp()
    {
        $this->adapter = $this->prophesize(AdapterInterface::class);
    }

    public function testReturnsJsonResponse()
    {
        $booking = new BookingUpdateAction($this->adapter->reveal());
        $response = $booking->process(
            $this->prophesize(ServerRequestInterface::class)->reveal(),
            $this->prophesize(DelegateInterface::class)->reveal()
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
