<?php

     $username = $_SESSION['teeckler_user'];
     $sql = "Delete FROM TeecklerUserinfo * WHERE username = ".$username;
     $sql = "DELETE FROM TeeckleUserProfile * WHERE username =".$username;
     $sql = "DELETE TABLE "$username.
?>
