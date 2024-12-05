<?php

$router->get('/', 'HomeController@index');
$router->get('/listings', 'ListingController@index');
$router->post('/listings', 'ListingController@store');

$router->get('/listings/edit/{id}', 'ListingController@edit');

$router->put('/listings/{id}', 'ListingController@update');

$router->get('/listings/create', 'ListingController@create');
$router->get('/listings/{id}', 'ListingController@show');

$router->delete('/listings/{id}', 'ListingController@destroy');


