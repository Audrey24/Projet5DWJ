<?php

foreach ($_FILES['uploads']['name'] as $filename) {
    echo '<li>' . $filename . '</li>';
}


<?php $data = $this->data;
  for ($i=0; $i<count($data); $i++) {
      ?>
    <form id="getEventForm" action="MyEvent/register" method="post">
      <input type="text" name="idEvent" id="idEvent" class="col-lg-1 col-md-1" value="<?php echo($data[$i]['id'])?>"/>
      <input type="radio" name="titleEvent" id="titleEvent" value="<?php echo($data[$i]['title'])?>"/><label for="title"> <?php echo($data[$i]['title']) ?></label><br>
      <button type="submit" id="btnChoiceEvent" class="btn btn-success col-lg-3 col-md-3">Choisir</button><br>
      <div id="messageEvent"></div>
    </form>
    <?php
  }
    ?>
