<?php

     session_start();
     $curruser = $_SESSION['teeckle_user'];
     $sql = "SELECT thumbnail, reqfrom 
FROM contact_table, pic_table 
WHERE iscontact = 0 AND reqto = ?
AND USER = reqfrom
and defaultpic = 1
ORDER BY contactid DESC";
     $sql2 = 'UPDATE contact_table SET checked = 1 WHERE checked = 0 AND reqto = ?';

     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($curruser));
          $result = $stmt -> fetchAll();

          $stmt = $conn -> prepare($sql2);
          $stmt->execute(array($curruser));
     }
     catch (PDOException $e) {
          die ($e);
     }

     echo json_encode($result);
?>
