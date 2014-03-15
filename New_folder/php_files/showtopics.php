<?php
     session_start();
     $curruser = $_SESSION['teeckle_user'];
     if(!isset($_POST['page'])) {
          die('error');
     }

     $top = trim($_POST["page"]);

     if (!get_magic_quotes_gpc) {
          $top = addslashes($top);
         
     }
     $error = false;
     function cleaninput($input){
			$input=trim($input);
			$input=htmlentities($input);
		return($input);
	}

	     $top = cleaninput($top);
          

          $params = array($top);

     $sql = "SELECT topicid,thumbnail,subject,started,date FROM discussion LEFT JOIN (select user,thumbnail from pic_table) as pt ON (started = pt.user) WHERE groupcon = ?";

     require_once 'connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt -> execute($params);
          $result = $stmt -> fetchALL();
     }
     
     catch(PDOException $e) {
     $error = true;
          die ($e);
          
     }
     if ($error == false) {
          echo json_encode($result);
     }
?>
