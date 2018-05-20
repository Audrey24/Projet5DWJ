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
        $this->view->render('login/login');
    }

    public function indexEventInvitation()
    {
        $this->view->render('login/login', true);
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

    public function CGU()
    {
        $this->view->render('login/mentions');
    }

    //Fonction pour récupérer son Mdp
    public function recovery($hash)
    {
        $id_user = $this->model->recovery($hash);
        //$this->view->addData($id_user);

        if (!empty($id_user)) {
            $this->view->render('login/updateLog');
        } else {
            header('location:'. URL . 'home');
        }
    }

    public function generateLog()
    {
        $this->model->generateLog();
    }

    public function updateLog()
    {
        $this->model->updateLog();
    }

    public function getGlobalVar()
    {
        if (!empty(Session::get('pseudo'))) {
            $table = array(
              "id" => Session::get('id'),
              "pseudo" => Session::get('pseudo'),
              "idevent" => Session::get('event'),
              "titleEvent" => Session::get('role'),
              "color" => Session::get('background_color'),
            );
        } else {
            $table = array("role" => "Inconnu");
        }

        echo json_encode($table);
    }
}
