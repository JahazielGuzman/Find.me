<?php
    
     session_start();
          $TeeckleEmail = trim($_POST['email']);
     	$TeecklePass = trim($_POST['userpwd']);
     	if (!using_magic_quotes_gpc) {
               $TeeckleEmail = addslashes($TeeckleEmail);
	          $TeecklePass = addslashes($TeecklePass);
          }
     require 'connect.php';

     $sqlh = "SELECT hash FROM TeecklerUserInfo WHERE teeckleEmail = ?";
     $sql = "SELECT teeckleUsern FROM TeecklerUserInfo WHERE teeckleEmail = ? AND teecklePass = ?";

    try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sqlh);
          $stmt ->execute(array($TeeckleEmail));
          $rows = $stmt -> rowCount();
          if ($rows == 0) {
               throw new Exception('YOU ARE NOT REGISTERED');
          }
          $stmt->bindColumn('hash', $tests);
          $stmt->fetch();
          
          $pazz = crypt($TeecklePass,$tests);
          while ($pazz == '*0') {
          $pazz = crypt($TeecklePass,$tests);
          }
          $stmt = $conn->prepare($sql);
          $stmt ->execute(array($TeeckleEmail,$pazz));
          $rows = $stmt -> rowCount();
          if ($rows == 0) {
               throw new Exception('YOU ARE NOT REGISTERED');
          }
          $stmt->bindColumn(1, $result);
          $stmt->fetch();
          $date = date("d,m,Y H:i:s");
     $sql = "INSERT INTO sessions (usern,ip,upd) VALUES (?,?,?)";
     $stmt = $conn->prepare($sql);
     $stmt -> execute(array($result,$_SERVER['REMOTE_ADDR'],$date));
          $_SESSION['teeckle_user'] = $result;
          $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
          
          header ('Location: https://teeckle.me/teeckleProfile.php');
          }
     
     catch (PDOException $e) {
          $mysqlerror = true;
          die($sql);
     }
     catch (Exception $thing) {
          die ($thing);
     }
     
?>
