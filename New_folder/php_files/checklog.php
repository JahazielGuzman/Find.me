<?php

     require_once 'connect.php';
     try {
          $conn = new PDO ('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $sql = "DELETE from sessions WHERE (DATEDIFF(STR_TO_DATE(upd,'%d,%m,%Y %h:%i'),CURDATE()) = 0 AND -5 >= hour(TIMEDIFF(TIME(STR_TO_DATE(upd,'%d,%m,%Y %h:%i')),CURTIME())) >= 5) OR (0 > DATEDIFF(STR_TO_DATE(upd,'%d,%m,%Y %h:%i'),CURDATE()) > 0)";
          $stmt = $conn -> prepare($sql);
          $stmt -> execute();
     }
     catch (PDOException $e) {
          die ($e);
     }

?>
