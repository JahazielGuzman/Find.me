<?php

     session_start();
     $usern = $_SESSION['teeckle_user'];
     $othern = $_POST['convo'];
     require_once 'connect.php';
     $result = array();
     if (isset($_POST['newer'])) {
     $newer = $_POST['newer'];
          $sql = "SELECT messid,thumbnail, fromuser, touser, message, DATE_FORMAT(STR_TO_DATE(datesent,'%m %d, %Y'),'%c %d, %Y')  as datesent, CONCAT(

DATE_FORMAT(STR_TO_DATE(datesent,'%m %d, %Y %h:%i'),'%h:%i'),' ', IF(SUBSTR(datesent,18) = 'A','am','pm')) as time
FROM mess_table AS mt
LEFT JOIN (
SELECT * 
FROM pic_table
WHERE defaultpic =  1
) AS pt ON ( pt.user = mt.fromuser ) 
WHERE fromuser
IN (:user,:othern)
AND touser
IN (:user,:othern) AND mt.messid > :nrt
ORDER BY mt.messid";
$error = false;

     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->bindParam(':user',$usern);
          $stmt->bindParam(':othern',$othern);
          $stmt->bindParam(':nrt',$newer,PDO::PARAM_INT);
          $stmt->execute();
          $result = $stmt -> fetchAll();
          
     }
     catch (PDOException $e) {
          die ($e);
     }
     }

     else {
     $sql = "SELECT messid,thumbnail, fromuser, touser, message,  DATE_FORMAT(STR_TO_DATE(datesent,'%m %d, %Y'),'%c %d, %Y') as datesent, CONCAT(
DATE_FORMAT(STR_TO_DATE(datesent,'%m %d, %Y %h:%i'),'%h:%i'),' ', IF(SUBSTR(datesent,18) = 'A','am','pm')) as time
FROM mess_table AS mt
LEFT JOIN (
SELECT * 
FROM pic_table
WHERE defaultpic =  1
) AS pt ON ( pt.user = mt.fromuser ) 
WHERE fromuser
IN (:user,:othern)
AND touser
IN (:user,:othern)
ORDER BY mt.messid";
     $sql2 = 'UPDATE mess_table SET checked = 1 WHERE touser = ? AND fromuser = ?';
     

     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername,$DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->bindParam(':user',$usern);
          $stmt->bindParam(':othern',$othern);
          $stmt->execute();
          $result = $stmt -> fetchAll();

          $stmt = $conn -> prepare($sql2);
          $stmt->execute(array($usern,$othern));
          
     }
     catch (PDOException $e) {
          die ($e);
     }
     } 
     echo json_encode($result);
    

?>
