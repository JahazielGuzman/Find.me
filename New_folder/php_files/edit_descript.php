<?php

     session_start();
     $group = htmlentities($_POST['group']);
     $desk = $_POST['description'];
     if (!get_magic_quotes_gpc) {
        $desk = addslashes($desk);
     }
     
     $desk = htmlentities($desk);

     $sql = 'UPDATE groups SET `descript` = ? WHERE `groupid` = ?';

     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($desk,$group));
     }
     catch (PDOException $e) {
          die ($e);
     }
     
     echo 'successfully edited';
?>
