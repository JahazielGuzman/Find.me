<?php

     session_start();
     $curruser = $_SESSION['teeckle_user'];
     $pic_path = $_POST['picloc'];

     $sql = "UPDATE pic_table set defaultpic = 0 WHERE defaultpic = 1 AND user = ?";
     $sql2 = "UPDATE pic_table set defaultpic = 1 WHERE piclocation = ? AND user = ?";

     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($curruser));

          $stmt = $conn -> prepare($sql2);
          $stmt->execute(array($pic_path,$curruser));
          }
          
     catch (PDOException $e) {
          die ($e);
     }
?>
