<?php

namespace App\Controllers;


class RestaurantController extends Controller
{

    public function home()
    {

        return $this->render('home');
    }

    public function signin()
    {
        return $this->render('signin');
    }
}
