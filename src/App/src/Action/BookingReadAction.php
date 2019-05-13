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

class BookingReadAction implements ServerMiddlewareInterface
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
        $table = new TableGateway('bookings', $this->adapter);
        $results = $table->select();

        return new JsonResponse($results->toArray(), 200);

      } else {
        if(!is_numeric($id)) {
          return new JsonResponse(['error' => 'Invalid id'], 400);
        }

        $table = new TableGateway('bookings', $this->adapter);
        $result = $table->select(['id' => $id]);

        if(count($result) != 1) {
          return new JsonResponse(['error' => 'Invalid record'], 400);
        }

        return new JsonResponse($result->current(), 200);
      }
    }
}
