<?php

namespace App\Controllers;

class UsersController extends Controller
{
    public function index()
    {
        $this->render('users/index');
    }
}