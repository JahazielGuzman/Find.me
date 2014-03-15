<?php
     session_start();
     $usern = $_SESSION['teeckle_user'];

     if (isset($_POST['page'])) {
          $usern = $_POST['page'];
     }
     
     if (isset($_POST['visited'])) {
          $usern = $_POST['visited'];
     }

     
     $sqlpic = "SELECT piclocation, thumbnail, dateadded, defaultpic from pic_table WHERE user = ?";
     $result = array();
     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sqlpic);
          $stmt->execute(array($usern));
          $result = $stmt -> fetchALL();
     }
     catch (PDOException $e) {
          die ($e);
     }
     echo json_encode($result);
?>
