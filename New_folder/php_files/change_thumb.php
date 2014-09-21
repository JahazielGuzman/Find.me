<?php

     session_start();
     $curruser = htmlentities($_SESSION['teeckle_user']);
     $path=htmlentities($_POST['href']);
     $path =trim( str_replace("https://teeckle.me", "",$path));
     $pic_button=htmlentities($_POST['pic_button']);

     if (isset($_POST['group'])) {
          $curruser = $_POST['group'];
     }

     require_once 'connect.php';
     if ($pic_button == 'profile') { 	 
	 $sql = "UPDATE pic_table SET `defaultpic`=0 WHERE `defaultpic`=1 AND `user`=?";
	 $sql2 = "UPDATE pic_table SET `defaultpic`=1 WHERE `piclocation`=? AND `user`=?";
	
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt->execute(array($curruser));

          $stmt = $conn -> prepare($sql2);
	     $stmt -> execute(array($path,$curruser));
     }
     catch (PDOException $e) {
          $mysqlerror = true;
          die ($e);
     }
     if ($mysqlerror == false) {
     echo 'success_profile';
     }
	}
	else if ($pic_button == 'delete') {
		 $sql = "DELETE FROM pic_table WHERE piclocation = ? AND user = ?";
		 try {
          	    $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
	              $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                   $stmt = $conn->prepare($sql);
	              $stmt -> execute(array($path,$curruser));
     		 }
     		 catch (PDOException $e) {
                      $mysqlerror = true;
                      die ($e);
                 }
                 if ($mysqlerror == false) {
                 echo $path;
                 }	
     }
?>
