<?php

     session_start();
     $curruser = $_SESSION['teeckle_user'];
     $deny = $_POST['denied'];
     $sql = 'DELETE FROM contact_table  WHERE reqfrom = ? AND reqto = ?';

     require_once 'connect.php';
     try {
          $con = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername,$DBpassword);
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $con -> prepare($sql); 
          $stmt->execute(array($deny,$curruser));
          }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());
     }
     echo 'success';
?>
