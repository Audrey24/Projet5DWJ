<?php
class CreateEvent_model extends Model
{
    //Construction sur le model du parent qui est Model.
    public function __construct()
    {
        parent::__construct();
    }

    public function create()
    {
        $creator = $_POST['mail'];
        $title = $_POST['title'];
        $image = $_FILES['myImg'];
        $color = $_POST['color'];

        echo($creator);
        echo($title);
        echo($image);
        echo($color);

        $req = $this->db->prepare('INSERT INTO event (creator, title, background_img, background_color) VALUES(:creator, :title, :background_img, :background_color)');
        $req->execute(array(
                  'creator' => $creator,
                  'title' => $title,
                  'background_img' => $image,
                  'background_color' => $color));
    }
}
