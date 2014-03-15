<?php
     session_start();
     require_once 'connect.php';
     if (isset($_SESSION['teeckle_user'])) {
     $date = date("d,m,Y H:i:s");
     $sql = "UPDATE sessions SET upd = ? WHERE ip = ?";
      
      try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($date,$_SERVER['REMOTE_ADDR']));
     }
     catch (PDOException $e) {
          die ($e->getMessage());
     }
}
else {
      $sql = "DELETE FROM sessions WHERE ip = ?";
      try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $usern,$pass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($_SERVER['REMOTE_ADDR']));
     }
     catch (PDOException $e) {
          die ($e->getMessage());
     }
}

     
     $current = htmlentities($_SESSION['teeckle_user']);
     
     
     if(isset($_POST['visited'])) {
          $visiting = htmlentities($_POST['visited']);

          
          $success = false;
          $sql = "SELECT * FROM contact_table WHERE (reqfrom = :from and reqto = :to) OR (reqfrom = :to and reqto = :from )";
          
          try {
               $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn -> prepare($sql); 
               $stmt -> bindParam(':from',$current);
               $stmt -> bindParam(':to',$visiting);
               $stmt->execute();
               if (($stmt -> rowCount()) == 0) {
                    
                    $success = true;
                    $sql = "INSERT INTO contact_table (reqfrom, reqto, iscontact) VALUES (:from, :to, 0)";
                    $stmt = $conn -> prepare($sql); 
                    $stmt -> bindParam(':from',$current);
                    $stmt -> bindParam(':to',$visiting);
                    $stmt->execute();
               }
          }
          catch (PDOException $e) {
               $success = false;
               die ($e->getMessage());
               exit;    
          }
          if ($success == true) {
               echo "Your Contact request has been sent";
               exit;
          }
     }
     else if (isset($_POST['approved'])) {
     
          $approved = htmlentities($_POST['approved']);
          $sql = "UPDATE contact_table
set iscontact = 1 WHERE (reqfrom = :from and reqto = :to) OR (reqfrom = :to and reqto = :from )";
          
          try {
               $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn -> prepare($sql);
               $stmt -> bindParam(':to',$current);
               $stmt -> bindParam(':from',$approved);
               $stmt->execute();
               $success = true;
               }
               
               catch (PDOException $e) {
                    $success = false;
                    die ($e->getMessage());
                    exit;
               }
               
          if ($success == true) {
               echo $approved." has been added succesfully";
               exit;
          }
          else {
               echo 'request was not sent. you may be contacts or may have a pending request';
          }

     }
     
?>
