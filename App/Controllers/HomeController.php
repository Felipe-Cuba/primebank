<?php

namespace App\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        $this->render('home/index');
    }

    public function loadIndex() {
        $this->redirect('/home/index');
    }
}