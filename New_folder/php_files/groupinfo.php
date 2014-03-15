<?php
    
     session_start();
     $group = $_POST['group'];
     if (isset($_POST['visited'])) {
          $userprofile = $_POST['visited'];
     }
     
     $sql = "SELECT groupname, cityg, country, DATE_FORMAT(founded, '%M, %d, %Y') as founded, CONCAT(COUNT(memid),' members') as memid, category, descript FROM groups as g LEFT JOIN (select memid,mgroupid from members where mgroupid = ?) as mem ON (mem.mgroupid = g.groupid) where g.groupid = ?";
     require_once 'connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($group,$group));
          $result = $stmt -> fetchAll();
     }
     catch (PDOException $e) {
          die ($e);
     }
     
     echo json_encode($result);

?>
