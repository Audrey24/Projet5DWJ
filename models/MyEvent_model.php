<?php
class MyEvent_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function events()
    {
        $user = Session::get('id');

        $req = $this->db->prepare('SELECT event.title, event.id FROM event
                                    INNER JOIN attendance ON event.id = attendance.id_event
                                    WHERE attendance.id_user = :iduser');
        $req->execute(array(
              'iduser' => $user));

        $res = $req->fetchAll();
        return $res;
    }

    public function register()
    {
        if (isset($_POST['titleEvent'])) {
            Session::set('event', $_POST['titleEvent']);
        }
    }
}
