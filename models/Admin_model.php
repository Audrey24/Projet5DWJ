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
        $title = $_POST['newTitle'];
        $color = $_POST['newColor'];
        $updateImg = $_POST['updateImg'];

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

        //Vérification des fichiers envoyés
        if ($updateImg) {
            if ($_FILES['newImg']['error'] > 0) {
                $erreur = "Erreur lors du transfert";
            }

            $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png');

            $extension_upload = strtolower(substr(strrchr($_FILES['newImg']['name'], '.'), 1));
            if (in_array($extension_upload, $extensions_valides)) {
                echo "Extension correcte";
            }
            $image = file_get_contents($_FILES['newImg']['tmp_name']);

            foreach (glob("eventsData/{$id}/backgroundImg.*") as $filename) {
                unlink($filename);
            }

            $nom = "eventsData/{$id}/backgroundImg.{$extension_upload}";
            $resultat = move_uploaded_file($_FILES['newImg']['tmp_name'], $nom);
            if ($resultat) {
                echo "Transfert réussi";
            }
        }
    }

    public function getEventUsers()
    {
        $id_event = Session::get('event');

        $req = $this->db->prepare('SELECT attendance.id_user, attendance.id_event, visitors.pseudo, attendance.role
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
