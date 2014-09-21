<?php
     
     session_start();
     $curruser = $_SESSION['teeckle_user'];
     if(!isset($_POST['post']) && !isset($_POST['page']) && !isset($_POST['topic'])) {
          die('error');
     }

     $top = trim($_POST["topic"]);
     $post = trim($_POST['post']);
     $page = trim($_POST['page']);

     if (!get_magic_quotes_gpc) {
          $top = addslashes($top);
          $page = addslashes($page);
          $post = addslashes($post);
         
     }
     $error = false;
     function cleaninput($input){
			$input=trim($input);
			$input=htmlentities($input);
		return($input);
	}

	     $top = cleaninput($top);
	     $page = cleaninput($page);
	     $post = cleaninput($post);
          

          $params = array($top,$curruser,$post,$page);

     $sql = "INSERT INTO discussion_post (topicid,from_user,post_body,dgroupid) VALUES (?,?,?,?)";

     require_once 'connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt -> execute($params);
     }
     
     catch(PDOException $e) {
     $error = true;
          die ($e);
          
     }
     if ($error == false) {
          echo 'success';
     }
?>
