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
use Zend\Validator;
use Zend\Db\TableGateway\Feature\RowGatewayFeature;
use Zend\Db\TableGateway\TableGateway;

class BookingUpdateAction implements ServerMiddlewareInterface
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
      $requestBody = $request->getParsedBody();

      $id = $request->getAttribute('id', false);

      if($id === false) {
        $id = $requestBody['id'];
      }

      $notEmpty = new \Zend\Validator\NotEmpty();
      $isDateTime = $validator = new \Zend\Validator\Date(['format' => 'Y-m-d H:i:s']);

      if (!isset($id)) {
        return new JsonResponse(array('error' => 'invalid id'), 400);
      }

      $username = $requestBody['username'];
      $reason = $requestBody['reason'];
      $startDate = $requestBody['start_date'];
      $endDate = $requestBody['end_date'];

      if (!$notEmpty->isValid($username)) {
        return new JsonResponse(array('error' => 'Username is not valid'), 400);
      }

      if (!$notEmpty->isValid($reason)) {
        return new JsonResponse(array('error' => 'Reason is not valid'), 400);
      }

      if (!$notEmpty->isValid($startDate) || !$isDateTime->isValid($endDate)) {
        return new JsonResponse(array('error' => 'Start Date is not valid'), 400);
      }

      if (!$notEmpty->isValid($endDate) || !$isDateTime->isValid($endDate)) {
        return new JsonResponse(array('error' => 'End Date is not valid'), 400);
      }

      $table = new TableGateway('bookings', $this->adapter, new RowGatewayFeature('id'));
      $results = $table->select(['id' => $id]);

      $booking = $results->current();

      if(empty($booking)) {
        return new JsonResponse(array('error' => 'unable to find record'), 400);
      }

      $booking->id = $id;
      $booking->username = $username;
      $booking->reason = $reason;
      $booking->startdate = $startDate;
      $booking->enddate = $endDate;             
      $booking->save();

      return new JsonResponse($booking->toArray(), 200);
    }
}
