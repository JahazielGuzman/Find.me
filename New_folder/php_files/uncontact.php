<?php
     session_start();
     $curruser = $_SESSION['teeckle_user'];
     $del = $_POST['deleted'];
     $sql = 'DELETE FROM contact_table  WHERE (reqfrom = :curr AND reqto = :oth) OR (reqto = :curr AND reqfrom = :oth) and iscontact = 1';

     require_once 'connect.php';
     try {
          $con = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername,$DBpassword);
          $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $con -> prepare($sql); 
          $stmt->bindParam(':curr',$curruser);
          $stmt->bindParam(':oth',$del);
          $stmt->execute();
          }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());
     }
     echo 'success';
?>
