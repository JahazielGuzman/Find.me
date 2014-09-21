<?php
     session_start();
     
     $user = $_SESSION['teeckle_user'];
     require_once 'connect.php';
     try {
     $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "DELETE FROM sessions WHERE ip = ? AND usern = ?";
     $stmt = $conn->prepare($sql);
     $stmt -> execute(array($_SERVER['REMOTE_ADDR'],$user));
     }
     catch (PDOException $e) {
          die ($e);
     }
     
     session_destroy();
     header ('Location: /login_register.php');
?>
