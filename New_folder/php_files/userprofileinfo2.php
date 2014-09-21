<?php
     
     $userprofile = $_POST['visited'];
     
     $sql = "SELECT dob,gender,zipcode,orientation,opento,ethnicity,bodytype,
     employment,height,alcohol,languages FROM TeeckleUserProfile WHERE teeckleUsern = '".$userprofile."'";
     require 'connect.php';
     @ $con = new mysqli($host,$DBusername,$DBpassword,$dbn);
     if ($con -> connect_errno) {
     die ('it happened');
     }
     $stmt = $con -> prepare ($sql) or die ('sup dude');
     $stmt -> execute ();
     $gender;
     $zipcode;
     $orientation;
     $opento;
     $ethnicity;
     $bodytype;
     $employment;
     $height;
     $alcohol;
     $languages;
     $birth;
     $stmt -> bind_result(
     $birth,
     $gender,
     $zipcode,
     $orientation,
     $opento,
     $ethnicity,
     $bodytype,
     $employment,
     $height,
     $alcohol,
     $languages);
     $stmt -> fetch();
     $stmt -> close();
     $con -> close();
     $params = array(
     '0' => $birth,
     '1' => $gender,
     '2' => $zipcode,
     '3' => $orientation,
     '4' => $opento,
     '5' => $ethnicity,
     '6' => $bodytype,
     '7' => $employment,
     '8' => $height,
     '9' => $alcohol,
     '10' => $languages
     );

     echo json_encode($params);
?>
