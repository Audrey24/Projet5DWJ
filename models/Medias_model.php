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

        $req = $this->db->prepare('SELECT extension FROM legend WHERE id = :id');
        $req->execute(array(
          'id' => $idImg));
        $res = $req->fetch();
        $extension = $res[0];

        $filesdelete = "eventsData/{$id}/{$idImg}.{$extension}";
        $mindelete = "eventsData/{$id}/{$idImg}min.png";
        unlink($filesdelete);
        unlink($mindelete);

        $name = explode('.', $idImg);
        $name = $name[0];

        $req = $this->db->prepare('DELETE FROM legend WHERE id= :id AND id_event = :id_event');
        $req->execute(array(
          'id_event' => $id,
          'id' => $name));
    }

    public function getPage($page)
    {
        $nb = 10;

        $index_deb = ($page * $nb) + 1;
        $index_fin = ($page+1)*$nb;

        $id_event = Session::get('event');

        $req = $this->db->prepare('SELECT id, content, extension FROM legend WHERE id_event = :id_event AND id >= :idxdeb AND id<= :idxfin');
        $req->execute(array(
        'id_event' => $id_event,
        'idxdeb' => $index_deb,
        'idxfin' => $index_fin));

        $data = $req->fetchAll();

        $extImg = array("jpg","jpeg","gif","png");
        $extVid = array("mp4", "mov");

        for ($i = 0; $i<count($data); $i++) {
            $imagefile = "eventsData/".Session::get('event')."/".$data[$i]['id']."min.png";
            $size = getimagesize($imagefile);
            $width = $size[0];
            $height = $size[1];
            $ratio = ($height/$width);
            if ($ratio<0.6) {
                $text= '<div class="grid-item imgbox thumbnail"';
            } elseif ($ratio >= 0.6 && $ratio <= 0.8) {
                $text= '<div class="grid-item imgbox2 thumbnail"';
            } elseif ($ratio > 0.8 && $ratio <= 1) {
                $text= '<div class="grid-item imgbox3 thumbnail"';
            } elseif ($ratio >1 && $ratio <= 1.4) {
                $text=  '<div class="grid-item imgbox4 thumbnail"';
            } elseif ($ratio >1.4 && $ratio <= 1.6) {
                $text=  '<div class="grid-item imgbox5 thumbnail"';
            } elseif ($ratio>1.7) {
                $text= '<div class="grid-item imgbox6 thumbnail"';
            } else {
                $text = '<div class="grid-item thumbnail"';
            }

            $text = $text. 'id="'.$data[$i]['id'].'" data-idimg="'.$data[$i]['id'].'" data-extension="'.$data[$i]['extension'].'">';

            if (!empty(Session::get('pseudo')) && (Session::get('role') == 1)) {
                $text = $text . '<button type="button" data-idimg="'.$data[$i]['id'].'" data-extension="'.$data[$i]['extension'].'" class="close deleteMod" data-dismiss="alert" aria-hidden="true">&times</button>';
            }

            if (in_array($data[$i]['extension'], $extImg)) {
                $text = $text.'<i class="fa fa-camera-retro"></i><img class="center openMod" src="'.$imagefile.'">';
            } else {
                $text = $text.'<i class="fa fa-film"></i><img class="center openMod" src="'.$imagefile.'">';
            }
            $text = $text .'<div class="caption"><p>'.$data[$i]['content'].'</p>
                            </div></div>';

            $text = $text. '<div id="msgDeleteMedias"></div>';
            echo $text;
        }
    }
}
