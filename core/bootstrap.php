<?php

use App\Core\App;

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(

    Connection::make(App::get('config')['database'])

));

function view($name, $data = [])
{
    extract($data);// make variable like ['users' => $users] -->  $users = 'users';
    //header("Location: /{$path}");
    return require "app/views/{$name}.view.php";

}

function redirect($path)
{
    return header("Location: /{$path}");
}
