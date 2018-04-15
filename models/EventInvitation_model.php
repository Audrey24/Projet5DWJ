<?php
class EventInvitation_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function invite($idEvent)
    {
        $req = $this->db->prepare('SELECT event.id, event.title, attendance.role, visitors.pseudo
                                   FROM event
                                   INNER JOIN attendance ON attendance.id_event = event.id
                                   INNER JOIN visitors ON attendance.id_user  = visitors.id
                                   WHERE attendance.id_event = :id_event');
        $req->execute(array(
            'id_event' => $idEvent));

        $res = $req->fetchAll();
        return $res;
    }
}
