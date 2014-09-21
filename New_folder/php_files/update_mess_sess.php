<?php
     session_start();
     $usern = $_SESSION['teeckle_user'];
     
     $sql = "SELECT thumbnail, numsessions AS online, fromuser, touser
FROM mess_table LEFT JOIN (SELECT * FROM pic_table WHERE defaultpic = '1') AS NEW ON (NEW.user = IF( fromuser = :user, touser, fromuser )) 


LEFT OUTER JOIN (SELECT numsessions,usern FROM sessions) as numsess ON (numsess.usern = IF( fromuser = :user, touser, fromuser ))

WHERE messid

IN (

SELECT MAX(messid ) 

FROM mess_table

WHERE fromuser = :user

OR touser = :user

GROUP BY (

IF( fromuser = :user, touser, fromuser )
)
) ORDER BY datesent DESC";
   

     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt -> bindParam(':user', $usern);
          $stmt->execute();
          $result = $stmt -> fetchAll();
     }
     catch (PDOException $e) {
          die ($e);
     }
     
     echo json_encode($result);

?>
