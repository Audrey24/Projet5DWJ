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
        $user = Session::get('id');
        $extensions_valides = array('mp4', 'mov');

        $num = $this->getMaxMed($id_event);
        $num++;

        print_r($_POST);
        print_r($_FILES);
        # traitement images
        foreach ($_POST as $key => $Imagename) {
            if (!preg_match("#(leg$|min$)#i", $key)) {
                $maxImg = Utils::decode_base64($_POST[$key]);
                $nomMax = "eventsData/{$id_event}/{$num}.jpeg";
                $resultat = file_put_contents($nomMax, $maxImg);

                $this->saveMinLeg($_POST[$key.'min'], $id_event, $num, $resultat, $_POST[$key.'leg'], "jpeg", $user);
                $num++;
            }
        };

        # traitement videos
        foreach ($_FILES as $key => $fichier) {
            $extension_upload = strtolower(substr(strrchr($_FILES[$key]['name'], '.'), 1));
            if ($_FILES[$key]['error'] == 0 || in_array($extension_upload, $extensions_valides)) {
                $video = file_get_contents($_FILES[$key]['tmp_name']);
                $nom = "eventsData/{$id_event}/{$num}.{$extension_upload}";
                $resultat = move_uploaded_file($_FILES[$key]['tmp_name'], $nom);

                $this->saveMinLeg($_POST[$key.'min'], $id_event, $num, $resultat, $_POST[$key.'leg'], $extension_upload, $user);
                $num++;
            } else {
                echo "Extension video incorrecte";
            }
        }
    }

    /*private function decode_base64($img)
    {
        $img = str_replace('data:image/jpeg;base64,', '', $img);
        $img = str_replace(' ', '+', $img);
        return base64_decode($img);
    }*/

    private function getMaxMed($event)
    {
        $req = $this->db->prepare('SELECT MAX(id) FROM legend WHERE id_event = :id_event');
        $req->execute(array(
          'id_event' => $event));
        return $req->fetch()[0];
    }

    private function saveMinLeg($mini, $id_event, $idMedia, $boolOriginalSave, $leg, $extension_upload, $user)
    {
        $minImg = Utils::decode_base64($mini);
        $nomMin = "eventsData/{$id_event}/{$idMedia}min.jpeg";
        $res2 = file_put_contents($nomMin, $minImg);

        if ($boolOriginalSave || $res2) {
            echo "Transfert réussi";

            $content = htmlspecialchars($leg);

            $req = $this->db->prepare('INSERT INTO legend (id, content, id_event, id_user, extension) VALUES(:id, :content, :id_event, :id_user, :extension)');
            $req->execute(array(
              'id' => $idMedia,
              'content' => $content,
              'id_event' => $id_event,
              'id_user' => $user,
              'extension' => $extension_upload));
        }
    }
}
