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

        $req = $this->db->prepare('SELECT event.title, event.id, event.background_color, attendance.role FROM event
                                    INNER JOIN attendance ON event.id = attendance.id_event
                                    WHERE attendance.id_user = :iduser');
        $req->execute(array(
              'iduser' => $user));

        $res = $req->fetchAll();
        return $res;
    }

    public function register()
    {
        $data = explode(',', $_POST['titleEvent']);
        print_r($data);
        if (isset($data[0])) {
            Session::set('event', $data[0]);
            Session::set('role', $data[1]);
            Session::set('titleEvent', $data[2]);
            Session::set('background_color', $data[3]);
        }
    }

    public function delete()
    {
        $user = Session::get('id');
        $id = $_POST['id'];

        $req = $this->db->prepare('SELECT role FROM attendance WHERE id_event = :id AND id_user = :id_user');
        $req->execute(array(
             'id' => $id,
             'id_user' => $user));

        $res = $req->fetch();

        if ($res['role'] == 1) {
            $req = $this->db->prepare('DELETE FROM event WHERE id = :id');
            $req->execute(array(
             'id' => $id));

            $dir = "eventsData/{$id}";
            $filesdelete = scandir($dir);
            for ($i=2; $i<count($filesdelete); $i++) {
                unlink("eventsData/".$id."/".$filesdelete[$i]);
            }

            rmdir("eventsData/{$id}/");
        }
    }
}
