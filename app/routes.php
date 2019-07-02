<?php




$router->get('', 'PagesController@regform');
$router->get('dashboard', 'PagesController@dashboard');


$router->post('store_user', 'UsersController@store_user');
$router->post('login', 'UsersController@login');


$router->post('update_name', 'UsersController@update_name');
$router->post('update_email', 'UsersController@update_email');
$router->post('update_password', 'UsersController@update_password');
$router->post('update_photo', 'UsersController@update_photo');

$router->get('logout', 'UsersController@logout');


