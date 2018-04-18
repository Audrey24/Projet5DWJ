<?php
class Admin_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function updateEvent()
    {
        $id = Session::get('event');
        $update = $_POST['update'];
        $form = array();
        parse_str($_POST['form'], $form);

        $title = $form['newTitle'];
        $color = $form['newColor'];

        if (empty($title) && ($update == 1)) {
            $req = $this->db->prepare('UPDATE event SET background_color = :background_color WHERE id= :id');
            $req->execute(array(
            'id' => $id,
            'background_color' => $color));
            Session::set('background_color', $color);
            echo("1");
        } elseif (!empty($title) && ($update == 0)) {
            $req = $this->db->prepare('UPDATE event SET  title = :title  WHERE id= :id');
            $req->execute(array(
            'id' => $id,
            'title' => $title));
            Session::set('titleEvent', $title);

            echo("2");
        } elseif (!empty($title) && ($update == 1)) {
            $req = $this->db->prepare('UPDATE event SET  title = :title, background_color = :background_color WHERE id= :id');
            $req->execute(array(
                'id' => $id,
                'title' => $title,
                'background_color' => $color));
            echo("3");
            Session::set('titleEvent', $title);
            Session::set('background_color', $color);
        }
    }

    public function getEventUsers()
    {
        $id_event = Session::get('event');

        $req = $this->db->prepare('SELECT attendance.id_user, attendance.id_event, visitors.pseudo
                                 FROM attendance INNER JOIN visitors
                                 ON attendance.id_user = visitors.id
                                 WHERE id_event= :id_event');
        $req->execute(array(
          'id_event' => $id_event));

        $res = $req->fetchAll();
        return $res;
    }

    public function deleteUsers($id_user)
    {
        $req = $this->db->prepare('DELETE FROM attendance WHERE id_user = :id_user');
        $req->execute(array(
          'id_user' => $id_user));
    }
}
