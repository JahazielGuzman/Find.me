<?php

     session_start();
     $parms = array();
     $currentuser = htmlentities(trim($_SESSION["teeckle_user"]));
     $sendto = htmlentities(trim($_POST["visited"]));
     $message = htmlentities($_POST["message"]);

     if (!get_magic_quotes_gpc) {
        $currentuser = addslashes($currentuser);
        $sendto = addslashes ($sendto);
        $message = addslashes($message);
     }
     $date = $_POST['date'];

     $params = array($currentuser,$sendto,$message,$date);
     
     require_once 'connect.php';
     $success = true;
     $sql = "INSERT INTO mess_table (fromuser,touser,message,datesent) VALUES (?,?,?,?)";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute($params);
     }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());    
     }
     if ($success = true) {
          echo "Your message to ".$sendto." has been sent successfully";
     }
?>
