<?php


     session_start();     
     $TeeckleEmail = $_POST['email'];
          
     require 'connect.php';

     $sqlh = "SELECT teeckleEmail FROM TeecklerUserInfo WHERE teeckleEmail = ?";

    try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sqlh);
          $stmt ->execute(array($TeeckleEmail));
          $rows = $stmt -> rowCount();
          if ($rows == 0) {
               $proof = 1;
          }
          else {
               $proof = 0;
          }
     }
     catch(PDOException $e) {
          echo ($e);
     }
     
     echo $proof;
?>
