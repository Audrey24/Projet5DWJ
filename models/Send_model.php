<?php
class Send_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function send()
    {
        $id_event = Session::get('event');
        $extensions_valides = array( 'jpg' , 'jpeg' , 'gif' , 'png', 'mp4');

        $req = $this->db->prepare('SELECT MAX(id) FROM legend WHERE id_event = :id_event');
        $req->execute(array(
            'id_event' => $id_event));
        $num = $req->fetch()[0];
        print_r($_POST);

        $original = array();

        foreach ($_POST as $key => $Imagename) {
            if (!preg_match("#(leg$|min$)#i", $key)) {
                array_push($original, $key);
                echo "on ajoute ". $key;
            }
        };

        print_r($original);
        //Vérification des fichiers envoyés
        $i = 0;
        foreach ($original as $key => $fichier) {
            $name = $num+1;

            $maxImg = $this->decode_base64($_POST[$fichier]);
            $nomMax = "eventsData/{$id_event}/{$name}.jpeg";
            $res = file_put_contents($nomMax, $maxImg);

            $minImg = $this->decode_base64($_POST[$fichier.'min']);
            $nomMin = "eventsData/{$id_event}/{$name}min.jpeg";
            $res2 = file_put_contents($nomMin, $minImg);

            if ($res || $res2) {
                echo "Transfert réussi";

                # legende pour la photo i $_POST['legs'][$i]);
                $user = Session::get('id');
                $content = $_POST[$fichier.'leg'];
                $id_event = Session::get('event');
                $extension_upload = 'jpeg';

                $req = $this->db->prepare('INSERT INTO legend (id, content, id_event, id_user, extension) VALUES(:id, :content, :id_event, :id_user, :extension)');
                $req->execute(array(
                    'id' => $name,
                    'content' => $content,
                    'id_event' => $id_event,
                    'id_user' => $user,
                    'extension' => $extension_upload));

                $num = $name;
            }
            $i++;
        }
    }

    public function decode_base64($img)
    {
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        return base64_decode($img);
    }
}
