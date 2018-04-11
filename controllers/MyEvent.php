<?php

class MyEvent extends Controller
{
    //Construction sur le model du parent qui est Controller.
    public function __construct()
    {
        parent::__construct();
        Session::init();
        if (empty(Session::get('pseudo'))) {
            header('location: home');
        }
    }

    //Fonction qui rend la view associé à la classe
    public function index()
    {
        /*$res = $this->model->events();
        $this->view->addData($res);*/
        $this->view->addData($this->model->events());
        $this->view->render('myEvent');
    }
}
