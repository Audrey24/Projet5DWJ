<?php

class Login extends Controller
{
    //Construction sur le model du parent qui est Controller.
    public function __construct()
    {
        parent::__construct();
    }

    //Fonction qui rend la view associé à la classe
    public function index()
    {
        $this->view->render('login');
    }

    public function signin()
    {
        $this->model->signin();
    }

    public function signup()
    {
        $this->model->signup();
    }

    public function disconnect()
    {
        $this->model->disconnect();
    }
}
