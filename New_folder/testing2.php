<?php
$sql = 'CREATE TABLE questions (';
for ($i = 1; $i < 109; $i ++) {
     $sql .= " q".$i." char(50) NOT NULL";
     if ($i != 108) {
          $sql .= ",";
     }
}
$sql .= ")";

require_once '/home/content/24/9456524/html/php_files/connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute();
     }
     catch (PDOException $e) {
          $success = false;
          echo "fail";    
     }
?>
