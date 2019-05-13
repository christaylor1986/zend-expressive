<?php
/**
 * Setup routes with a single request method:
 *
 * $app->get('/', App\Action\HomePageAction::class, 'home');
 * $app->post('/album', App\Action\AlbumCreateAction::class, 'album.create');
 * $app->put('/album/:id', App\Action\AlbumUpdateAction::class, 'album.put');
 * $app->patch('/album/:id', App\Action\AlbumUpdateAction::class, 'album.patch');
 * $app->delete('/album/:id', App\Action\AlbumDeleteAction::class, 'album.delete');
 *
 * Or with multiple request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class, ['GET', 'POST', ...], 'contact');
 *
 * Or handling all request methods:
 *
 * $app->route('/contact', App\Action\ContactAction::class)->setName('contact');
 *
 * or:
 *
 * $app->route(
 *     '/contact',
 *     App\Action\ContactAction::class,
 *     Zend\Expressive\Router\Route::HTTP_METHOD_ANY,
 *     'contact'
 * );
 */

/** @var \Zend\Expressive\Application $app */

$app->get('/booking/create', App\Action\BookingCreateFormAction::class, 'booking.create');
$app->get('/booking/update', App\Action\BookingUpdateFormAction::class, 'booking.update');
$app->get('/booking/get', App\Action\BookingReadFormAction::class, 'booking.read');
$app->get('/booking/delete', App\Action\BookingDeleteFormAction::class, 'booking.delete');

$app->get('/api/booking/get[/{id:\d+}]', App\Action\BookingReadAction::class, 'booking.api.read');
$app->route('/api/booking/delete[/{id:\d+}]', App\Action\BookingDeleteAction::class, ['DELETE', 'POST'], 'booking.api.delete');
$app->route('/api/booking/update[/{id:\d+}]', App\Action\BookingUpdateAction::class, ['PATCH', 'POST'], 'booking.api.update');
$app->post('/api/booking/create', App\Action\BookingCreateAction::class, 'booking.api.create');
