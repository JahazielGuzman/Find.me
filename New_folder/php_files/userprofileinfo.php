<?php
     session_start();
     $userprofile = $_SESSION['teeckle_user'];
     if (isset($_SESSION['visited'])) {
          $userprofile = $_POST['visited'];
     }
     
     $sql = "SELECT FLOOR(DATEDIFF(CURDATE(),STR_TO_DATE(dob,'%m/%d/%Y'))/365) AS dob, gender, CONCAT(city,',',state) as city, lookingfor, opento, relstatus, imow, ethnicity, bodytype, employment, height, alcohol, languages, education, children
FROM TeeckleUserProfile AS tup, zips_table AS zip
WHERE teeckleUsern = ?
AND zip.zipcode = tup.zipcode";
     require_once 'connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($userprofile));
          $result = $stmt -> fetchAll();
     }
     catch (PDOException $e) {
          die ($e);
     }
     
     echo json_encode($result);

?>
