<?php

if (!isset($_GET['id'])) {
  $id = 'No id passed';
}
else {
  $id = $_GET['id'];
}

echo "Id was: ", htmlentities($id);

?>