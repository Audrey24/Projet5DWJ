<?php

foreach ($_FILES['uploads']['name'] as $filename) {
    echo '<li>' . $filename . '</li>';
}
