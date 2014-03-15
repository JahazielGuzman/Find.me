<?php
     session_start();
     $parms = array();
     $currentuser = htmlentities(trim($_SESSION["teeckle_user"]));

     if (!get_magic_quotes_gpc) {
        $currentuser = addslashes($currentuser);
       
     }

     $params = array($currentuser,$sendto);
     
     require_once 'connect.php';
     $success = true;
     $sql = "SELECT thumbnail, teeckler, teeckled
FROM teeckle_table
LEFT JOIN (

SELECT * 
FROM pic_table
WHERE defaultpic =  '1'
) AS NEW ON ( NEW.user = teeckler ) 
WHERE teeckled = ?";
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($currentuser));
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


