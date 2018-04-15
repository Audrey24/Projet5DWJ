<?php

class EventInvitation extends Controller
{
    //Construction sur le model du parent qui est Controller.
    public function __construct()
    {
        parent::__construct();
    }

    //Fonction qui rend la view associé à la classe
    public function index()
    {
        $this->view->render('event/eventInvitation');
    }

    public function invite($idEvent)
    {
        $inv = $this->model->invite($idEvent);
        print_r($inv);
        $this->view->addData($inv);
        $this->view->render('event/eventInvitation');
    }
}
