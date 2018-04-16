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
        $req = $this->db->prepare('SELECT visitors.pseudo, comments.id, comments.id_user, comments.content, DATE_FORMAT(comments.publicationDate, "%d/%m/%Y") AS publicationDate
                                   FROM comments
                                   INNER JOIN visitors ON comments.id_user = visitors.id
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
            $req = $this->db->prepare('INSERT INTO comments (content, id_user, id_event) VALUES(:content, :id_user, :id_event)');
            $req->execute(array(
            'content' => $content,
            'id_user' => $id,
            'id_event' => $id_event));
        }
    }

    public function deleteComments($id)
    {
        $req = $this->db->prepare('DELETE FROM comments WHERE id = :id');
        $req->execute(array(
      'id' => $id));
    }
}
