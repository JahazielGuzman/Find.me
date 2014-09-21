<?php
     session_start();
     require_once 'connect.php';

     
     
     $current = htmlentities($_SESSION['teeckle_user']);
     
     $visiting = htmlentities($_POST['page']);

          
          $success = true;
          $sql = "INSERT INTO members (groupid,member) VALUES (?,?)";
          try {
               $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn -> prepare($sql); 
               $stmt->execute(array($visiting,$current));
          }
          catch (PDOException $e) {
               $success = false;
               die ($e->getMessage());
               exit;    
          }
          if ($success == true) {
               echo "You have joined the group";
               exit;
          }
          
     
?>
