<?php

namespace AppTest\Action;

use App\Action\BookingDeleteAction;
use Interop\Http\ServerMiddleware\DelegateInterface;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Db\Adapter\AdapterInterface;

class BookingDeleteActionTest extends TestCase
{
    protected $adapter;

    protected function setUp()
    {
        $this->adapter = $this->prophesize(AdapterInterface::class);
    }

    public function testReturnsJsonResponse()
    {
        $booking = new BookingDeleteAction($this->adapter->reveal());
        $response = $booking->process(
            $this->prophesize(ServerRequestInterface::class)->reveal(),
            $this->prophesize(DelegateInterface::class)->reveal()
        );

        $this->assertInstanceOf(JsonResponse::class, $response);
    }
}
