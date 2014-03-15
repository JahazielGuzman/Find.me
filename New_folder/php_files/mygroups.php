<?php

     session_start();
     $curruser = $_SESSION['teeckle_user'];
     
     $error = false;
          
          $params = array($curruser);

     $sql = "SELECT thumbnail,groupid FROM groups LEFT JOIN (select user,thumbnail from pic_table) as pt ON (groupid = pt.user) WHERE admin = ?";

     require_once 'connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt -> execute($params);
          $result = $stmt -> fetchALL();
     }
     
     catch(PDOException $e) {
     $error = true;
          die ($e);
          
     }
     if ($error == false) {
          echo json_encode($result);
     }
?>
