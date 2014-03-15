<?php

     session_start();
     require_once 'connect.php';
     $parms = array();
     $currentuser = htmlentities(trim($_SESSION["teeckle_user"]));
     $sendto = htmlentities(trim($_POST["visited"]));
     $pichref = $_POST['path'];

     if (!get_magic_quotes_gpc) {
        $currentuser = addslashes($currentuser);
        $sendto = addslashes ($sendto);
        $message = addslashes($message);
     }
     $post = strpos($pichref,'pics');
     $pichref = substr ($pichref,$post);
     $params = array($sendto,$pichref);
     
     $success = true;

     if ($_POST['later'] == 1) {
          $sql = "SELECT numcomm, thumbnail, fromuser, usercomment FROM pic_comments as pc LEFT JOIN (select * from pic_table WHERE defaultpic = 1) AS pt ON (pc.fromuser = pt.user) WHERE touser = ? and path = ? AND fromuser = ? ORDER BY numcomm desc LIMIT 1";
          $params = array($sendto,$pichref,$currentuser);
     }
     else {
     $sql = "SELECT numcomm, thumbnail, fromuser, usercomment FROM pic_comments as pc LEFT JOIN (select * from pic_table WHERE defaultpic = 1) AS pt ON (pc.fromuser = pt.user) WHERE touser = ? and path = ?";
     }
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute($params);
          $result = $stmt -> fetchAll(); 
     }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());    
     }
     if ($success = true) {
          echo json_encode($result);
     }
?>
