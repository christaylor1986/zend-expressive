<?php

namespace App\Action;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface as ServerMiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Router;
use Zend\Expressive\Template;
use Zend\Expressive\Plates\PlatesRenderer;
use Zend\Expressive\Twig\TwigRenderer;
use Zend\Expressive\ZendView\ZendViewRenderer;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;

class BookingDeleteAction implements ServerMiddlewareInterface
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
      $id = $request->getAttribute('id', false);

      if($id === false) {
        $requestBody = $request->getParsedBody();
        $id = $requestBody['id'];
      }

      if(!isset($id)) {
        return new JsonResponse(array('error' => 'no record id provided'), 400);
      }

      $table = new TableGateway('bookings', $this->adapter, new RowGatewayFeature('id'));
      $results = $table->select(['id' => $id]);

      $booking = $results->current();

      if(empty($booking)) {
        return new JsonResponse(array('error' => 'unable to find record'), 400);
      }

      $booking->delete();

      return new JsonResponse('deleted booking '.$id, 200);
    }
}
