<?php
     session_start();
     $curruser = $_SESSION['teeckle_user'];
     if(!isset($_POST['topic']) && !isset($_POST['group'])) {
          die('error');
     }

     $group = trim($_POST['group']);
     $top = trim($_POST["topic"]);

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
	     $group = cleaninput($group);
          

          $params = array($group,$top);

     $sql = "SELECT thumbnail,postid,topicid,from_user,post_body,date FROM discussion_post LEFT JOIN (select user,thumbnail,defaultpic from pic_table) as pt ON (from_user = pt.user) WHERE dgroupid = ? AND topicid = ? AND pt.defaultpic = 1";

     if (isset($_POST['later'])) {
          $late = $_POST['later'];
          $params[] = $late;
          $sql .= ' AND postid > ?';
     }
     $sql .= " ORDER BY postid";
     
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
