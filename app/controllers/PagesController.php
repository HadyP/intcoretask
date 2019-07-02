<?php

namespace App\Controllers;
use App\Core\App;

class PagesController
{
    public function regform()
    {

        return view('regform');

    }

    public function dashboard()
    {

        return view('dashboard');

    }
}