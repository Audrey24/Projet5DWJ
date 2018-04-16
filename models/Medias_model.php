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

        $req = $this->db->prepare('SELECT content FROM legend WHERE id_event = :id_event');
        $req->execute(array(
          'id_event' => $id_event));

        $res = $req->fetchAll();
        return $res;
    }
}
