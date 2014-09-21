<?php
     session_start();
     $die = false;
     if (!isset($_POST['registeremail'],$_POST['registeruser'],$_POST['registerpassword'],$_POST['birth_data'],
     $_POST['registersex'],$_POST['confpassword']))  {
          $die = true;
          die ('The fields were empty');
     }
     
     $email = trim($_POST["registeremail"]);
     $username = trim($_POST["registeruser"]);
     $password = trim($_POST["registerpassword"]);
     $DOB = trim($_POST["birth_data"]);
     $sex = trim($_POST["registersex"]);
     $conf = trim($_POST["confpassword"]);

     if (!get_magic_quotes_gpc) {
          $conf = addslashes($conf);
          $newaccount = addslashes ($newaccount);
          $email = addslashes ($email);
          $username = addslashes ($username);
          $password = addslashes ($password);
          $DOB = addslashes ($DOB);
          $sex = addslashes ($sex);
     }

     if ($sex != 'Man' && $sex != 'Woman') {
          $die = true;
          die ('The sex value is incorrect!');
     }
     
     if ($password != $conf) {
          
          die ('The two passwords are not the same, please try again');
     }
     
     
     function generateSalt($max = 15) {
        $characterList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $i = 0;
        $salt = "";
        while ($i < $max) {
            $salt .= $characterList{mt_rand(0, (strlen($characterList) - 1))};
            $i++;
        }
        return $salt;
     }

     $sqlh = "SELECT * FROM TeecklerUserInfo where hash = ?";
     $sql = "INSERT INTO TeecklerUserInfo (teeckleEmail, teeckleUsern, teecklePass, hash, teeckleDOB, teeckleSEX) VALUES
     (?,?,?,?,?,?)";

     require_once 'connect.php';
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

          $loop = true;
          while ($loop == true) {
          
          $salt = generateSalt(22);
          $hash = '$2y$08$'.$salt.'$';
          
               $stmt = $conn->prepare($sqlh);
               $stmt -> execute(array($hash));
               if ($stmt -> rowCount() == 0) {
                    $loop = false;
               }
          }
          $password = crypt($password,$hash);
          while ($password == '*0') {
               $password = crypt($password,$hash);
          }
          $stmt = $conn->prepare($sql);
          $stmt ->execute(array($email,$username,$password,$hash,$DOB,$sex));
     }
     
     catch (PDOException $e) {
          $die = true;
          die ($e);
     }
     
     $date = date("d,m,Y H:i:s");
     try {
     $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $sql = "INSERT INTO sessions (usern,ip,upd) VALUES (?,?,?)";
     $stmt = $conn->prepare($sql);
     $stmt -> execute(array($username,$_SERVER['REMOTE_ADDR'],$date));
     }
     catch(PDOException $e) {
          die ($e);
     }
     $_SESSION ['teeckle_user'] = $username;
     $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
     $_SESSION ['teeckle_dob'] = $DOB;
     $_SESSION ['teeckle_sex'] = $sex;

     if ($die == false) {
     header('Location: requiredinfo.php');
     }
?>
