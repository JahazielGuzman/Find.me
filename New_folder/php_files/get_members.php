<?php
   
     session_start();
     $group = $_POST['group'];
     $curruser = htmlentities($_SESSION['teeckle_user']);
     $sql = "SELECT memid, member FROM members WHERE mgroupid = ?";
     $result = array();
     
     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($group));
          $result = $stmt -> fetchAll();
          }
          
     catch (PDOException $e) {
          die ($e);
     }

     echo json_encode($result);
?>
