<?php

     session_start();
     $curruser = htmlentities($_SESSION['teeckle_user']);
     $imow = $_POST['imow'];
     if (!get_magic_quotes_gpc) {
        $imow = addslashes($imow);
     }
     
     $imow = htmlentities($imow);

     $sql = 'UPDATE TeeckleUserProfile SET `imow` = ? WHERE `teeckleUsern` = ?';

     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($imow,$curruser));
     }
     catch (PDOException $e) {
          die ($e);
     }
     echo 'successfully edited';
?>
