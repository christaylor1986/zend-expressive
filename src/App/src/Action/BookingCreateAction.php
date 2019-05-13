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
use Zend\Db\RowGateway\RowGateway;
use Zend\Db\TableGateway\TableGateway;

class BookingCreateAction implements ServerMiddlewareInterface
{
    private $adapter;

    public function __construct(AdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
      $requestBody = $request->getParsedBody();

      $notEmpty = new \Zend\Validator\NotEmpty();
      $isDateTime = $validator = new \Zend\Validator\Date(['format' => 'Y-m-d H:i:s']);

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

      $newRow = new RowGateway('id', 'bookings', $this->adapter);
      $newRow->username = $username;
      $newRow->reason = $reason;
      $newRow->startdate = $startDate;
      $newRow->enddate = $endDate;
      $newRow->save();

      return new JsonResponse($newRow->toArray(), 200);
    }
}
