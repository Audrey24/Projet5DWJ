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
        $req = $this->db->prepare('SELECT visitors.pseudo, comment.id, comment.id_user, comment.content, DATE_FORMAT(comment.publicationDate, "%d/%m/%Y") AS publicationDate
                                   FROM comment
                                   INNER JOIN visitors ON comment.id_user = visitors.id
                                   WHERE id_event = :id_event');
        $req->execute(array(
          'id_event' => $id_event
        ));

        $res = $req->fetchAll();
        return $res;
    }

    public function comment()
    {
        //On récupère l'id du texte que l'on commente et les données du commentaire.
        $content = $_POST['content'];
        $content = htmlspecialchars($content);
        $id = Session::get('id');
        $id_event = Session::get('event');

        if (!empty($content)) {
            //On insère dans le Bdd et on ajoute l'id de l'user pour pouvoir ajouter le pseudo sur la vue.
            $req = $this->db->prepare('INSERT INTO comment (content, id_user, id_event) VALUES(:content, :id_user, :id_event)');
            $req->execute(array(
            'content' => $content,
            'id_user' => $id,
            'id_event' => $id_event));
        }
    }

    public function deleteComments($id)
    {
        $req = $this->db->prepare('DELETE FROM comment WHERE id = :id');
        $req->execute(array(
      'id' => $id));
    }
}
