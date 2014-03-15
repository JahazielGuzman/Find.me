<?php
     session_start();
     $userdef = htmlentities($_SESSION['teeckle_user']);
     

     if (isset($_POST['visited'])) {
          $userdef = htmlentities($_POST['visited']);
     }
     
     $sql = "SELECT thumbnail FROM pic_table WHERE defaultpic = 1 AND user = ?";
     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($userdef));
          $result = $stmt -> fetch();
     }
     catch (PDOException $e) {
          die ($e);
     }
     
     echo $result[0];
?>
