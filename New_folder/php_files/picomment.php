<?php

     session_start();
     require_once 'connect.php';
     $currentuser = htmlentities(trim($_SESSION["teeckle_user"]));
     $visited = htmlentities(trim($_POST["visited"]));
     $comment = htmlentities($_POST["comment"]);
     $pichref = $_POST['path'];

     if (!get_magic_quotes_gpc) {
        $currentuser = addslashes($currentuser);
        $sendto = addslashes ($sendto);
        $message = addslashes($message);
     }
     
     $success = true;

     $post = strpos($pichref,'pics');
     $pichref = substr ($pichref,$post);
     $sql = "SELECT contactid FROM contact_table WHERE reqfrom IN (:curr,:other) AND reqto IN (:curr,:other) AND  iscontact = 1";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->bindParam(':curr',$currentuser);
          $stmt->bindParam(':other',$visited);
          $stmt -> execute();
          $result = $stmt -> fetchAll();

          if ($result != array() || $currentuser == $visited) {
          $sql = "INSERT INTO pic_comments (fromuser,touser,usercomment,path) VALUES (?,?,?,?)";
               $stmt = $conn -> prepare($sql);
               $stmt -> execute(array($currentuser,$visited,$comment,$pichref));
               $result = $stmt -> fetchAll();
          }
          else {
               $success = false;
          }
     }
     catch (PDOException $e) {
          $success = false;
          die ($e->getMessage());    
     }
     if ($success = true) {
          echo "success";
     }
?>
