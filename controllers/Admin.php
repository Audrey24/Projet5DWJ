<?php

class Admin extends Controller
{
    //Construction sur le model du parent qui est Controller.
    public function __construct()
    {
        parent::__construct();
        Session::init();
        if (Session::get('role') != 1) {
            header('location: home');
        }
    }

    //Fonction qui rend la view associé à la classe
    public function index()
    {
        $this->view->render('admin/admin');
    }
}
