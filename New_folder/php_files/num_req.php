<?php

     session_start();
     $curruser = $_SESSION['teeckle_user'];
     $sql = "SELECT COUNT(contactid) FROM contact_table WHERE checked = 0 AND reqto = ?";
     $mysqlerror = false;

     require_once "connect.php";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt ->execute(array($curruser));
          $num_cont = $stmt -> fetch();
     }
     
     catch (PDOException $e) {
          $mysqlerror = true;
          echo $sql;
     }
     
     if ($mysqlerror == false) {
          echo $num_cont[0];
     }
?>
