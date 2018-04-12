<?php

class Comments extends Controller
{
    //Construction sur le model du parent qui est Controller.
    public function __construct()
    {
        parent::__construct();
    }

    //Fonction qui rend la view associé à la classe
    public function index()
    {
        $this->view->addData($this->model->getComments());
        $this->view->render('comments');
    }
}
