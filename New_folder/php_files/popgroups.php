<?php

     session_start();
     $curruser = $_SESSION['teeckle_user'];
     
     $error = false;
          
          $params = array($curruser);

     $sql = "SELECT thumbnail, mgroupid, COUNT( memid ) AS num
FROM members
LEFT JOIN (

SELECT user, thumbnail
FROM pic_table
WHERE defaultpic =1
) AS pt ON ( mgroupid = pt.user ) 
GROUP BY mgroupid ORDER BY num ASC";

     require_once 'connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt -> execute($params);
          $result = $stmt -> fetchALL();
     }
     
     catch(PDOException $e) {
     $error = true;
          die ($e);
          
     }
     if ($error == false) {
          echo json_encode($result);
     }
?>
