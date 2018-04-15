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

        $req = $this->db->prepare('SELECT event.title, event.id, attendance.role FROM event
                                    INNER JOIN attendance ON event.id = attendance.id_event
                                    WHERE attendance.id_user = :iduser');
        $req->execute(array(
              'iduser' => $user));

        $res = $req->fetchAll();
        return $res;
    }

    public function register()
    {
        #print_r($_POST['titleEvent']);
        $data = explode(',', $_POST['titleEvent']);
        if (isset($data[0])) {
            Session::set('event', $data[0]);
            Session::set('role', $data[1]);
            Session::set('titleEvent', $data[2]);
        }
    }

    public function delete()
    {
        $id = $_POST['id'];
        echo($id);

        $req = $this->db->prepare('DELETE FROM event WHERE id = :id');
        $req->execute(array(
             'id' => $id));
    }
}
