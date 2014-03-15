<?php

     session_start();
     $curruser = $_SESSION['teeckle_user'];
     $timesent = $_POST['time_sent'];
     $sql = "UPDATE ".$curruser." checked = 0 WHERE datesent = ?";

     require_once 'connect.php';
     
     $con = @ new mysqli($host, $DBusername, $DBpassword,$dbn);
     if ($con -> mysql_connect_errno()) {
          die ('connection error');          
     }
     $stmt = $con -> prepare ($sql);
     $stmt -> bind_param("s",$timesent);
     $stmt -> execute();
      if ($stmt -> error != '') {
          die ("stuff happens1");
     }
     $stmt -> close();
     $con -> close();
?>
