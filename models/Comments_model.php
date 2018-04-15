<?php
class Comments_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function getComments()
    {
        $id_event = Session::get('event');
        $req = $this->db->prepare('SELECT visitors.pseudo, comments.id_user, comments.content, comments.publicationDate
                                   FROM comments
                                   INNER JOIN visitors ON comments.id_user = visitors.id
                                   WHERE id_event = :id_event');
        $req->execute(array(
          'id_event' => $id_event
        ));

        $res = $req->fetchAll();
        return $res;
    }
}