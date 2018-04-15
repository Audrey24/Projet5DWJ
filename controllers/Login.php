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

    public function indexEventInvitation()
    {
        $this->view->render('login', true);
    }

    public function signin()
    {
        $this->model->signin();
    }

    public function signup($id_event = null)
    {
        $id_user = $this->model->signup();
        if ($id_event != null) {
            $this->model->linkCreator($id_user);
        }
    }

    public function disconnect()
    {
        $this->model->disconnect();
    }

    public function accept()
    {
        $this->model->accept();
    }
}
