<?php

     session_start();
     $curruser = htmlentities($_SESSION['teeckle_user']);
     $sql = "SELECT thumbnail, reqfrom, reqto

FROM contact_table

LEFT JOIN (



SELECT thumbnail,user

FROM pic_table

WHERE defaultpic = 1

) AS pt
 ON ( IF( reqfrom = :curr,reqto,reqfrom ) = pt.user ) 
WHERE (
reqfrom = :curr

OR reqto = :curr
)

AND iscontact = 1";
     $result = array();
     
     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn-> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt -> bindParam(':curr',$curruser);
          $stmt->execute();
          $result = $stmt -> fetchAll();
          }
          
     catch (PDOException $e) {
          die ($e);
     }

     echo json_encode($result);

?>


