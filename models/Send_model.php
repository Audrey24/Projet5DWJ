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
        print_r($_FILES);
        print_r($_POST);

        //Vérification des fichiers envoyés
        $i = 0;
        foreach ($_FILES as $key => $fichier) {
            if ($_FILES[$key]['error'] > 0) {
                $erreur = "Erreur lors du transfert";
            }
            # echo($_FILES[$key]['name']);

            //1. strrchr renvoie l'extension avec le point (« . »).
            //2. substr(chaine,1) ignore le premier caractère de chaine.
            //3. strtolower met l'extension en minuscules.
            $extension_upload = strtolower(substr(strrchr($_FILES[$key]['name'], '.'), 1));
            if (in_array($extension_upload, $extensions_valides)) {
                echo "Extension correcte";
            }
            $image = file_get_contents($_FILES[$key]['tmp_name']);

            $name = $num+1;
            $nom = "eventsData/{$id_event}/{$name}.{$extension_upload}";
            $resultat = move_uploaded_file($_FILES[$key]['tmp_name'], $nom);

            $minImg = $_POST[$key.'min'];
            $minImg = str_replace('data:image/png;base64,', '', $minImg);
            $minImg = str_replace(' ', '+', $minImg);
            $minImg = base64_decode($minImg);
            $nomMin = "eventsData/{$id_event}/{$name}min.png";
            file_put_contents($nomMin, $minImg);

            if ($resultat) {
                echo "Transfert réussi";

                # legende pour la photo i $_POST['legs'][$i]);
                $user = Session::get('id');
                $content = $_POST[$key.'leg'];
                $id_event = Session::get('event');

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
}
