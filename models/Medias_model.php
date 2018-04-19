<?php
class Medias_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function getLegend()
    {
        $id_event = Session::get('event');

        $req = $this->db->prepare('SELECT id, content, extension FROM legend WHERE id_event = :id_event');
        $req->execute(array(
          'id_event' => $id_event));

        $res = $req->fetchAll();
        return $res;
    }

    public function delete()
    {
        $id = Session::get('event');
        $idImg = $_POST['idImg'];

        $filesdelete = "eventsData/{$id}/{$idImg}";
        unlink($filesdelete);

        $name = explode('.', $idImg);
        $name = $name[0];
        echo $name;

        $req = $this->db->prepare('DELETE FROM legend WHERE id= :id AND id_event = :id_event');
        $req->execute(array(
          'id_event' => $id,
          'id' => $name));
    }
}
