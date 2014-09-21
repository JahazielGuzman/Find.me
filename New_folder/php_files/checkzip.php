<?php

     session_start();
$zipcode = $_POST['zip_code'];
$sql = "SELECT zipcode FROM zips_table where zipcode = ?";

     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt ->execute(array($zipcode));
          $stmt -> fetch();
          if ($stmt -> rowCount() == 0) {
               $num = 0;
          }
          else {
               $num = 1;
          }
     }
     catch (PDOException $e) {
          $die = true;
          die ($e);
     }
     echo $num;
?>
