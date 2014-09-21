<?php
       session_start();
       if (isset($_SESSION['teeckle_user'])) {
            $userreg = $_SESSION['teeckle_user'];
       }
       else {
            header ('Location: /login_register.php');
            exit;
       }
       $path = $_SERVER['PHP_SELF'];
       $grouppage = basename($path, ".php");
       $sql = "SELECT admin FROM groups WHERE groupid = ?";
       $sql2 = "SELECT memid FROM members WHERE member = ? AND mgroupid = ?";
       $sql3 = "SELECT privacy FROM groups WHERE groupid = ?";
        $success = true;
        require_once '/home/content/24/9456524/html/php_files/connect.php';
          try {
               $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn -> prepare($sql);
               $stmt-> execute(array($grouppage));
               $result = $stmt -> fetch();
               $stmt1 = $conn -> prepare($sql2);
               $stmt1 -> execute(array($userreg,$grouppage));
               $stmt = $conn -> prepare($sql3);
               $stmt -> execute(array($grouppage));
               $privacy = $stmt -> fetch();
          }
          catch (PDOException $e) {
               $success = false;
               $admin = 'cheese';
          }
          if ($success == true) {
              $admin = $result[0]; 
              if ($stmt1->rowCount() > 0) {
                   $member = 1;
              }
              else {
                   $member = 0;
              }
          }
          
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
    Teeckle.me Dating
    </title>
    <meta charset= "utf-8">
    
    <link href="/cssfiles/template.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/cssfiles/jqueryui.css" type="text/css"/>
    
    <script src="/js_files/jquery.js" type="text/javascript">
    </script>
    <script src="/js_files/jqueryui.js" type="text/javascript">
    </script>
    
    <script src="/js_files/livequery/jquery.livequery.js" type="text/javascript"></script>
    <script>
    var curruser = "<?php echo $userreg; ?>";
    var page = "<?php echo $grouppage; ?>";
    var admin = "<?php echo $admin; ?>";
    var member = "<?php echo $member; ?>";
    var privacy = "<?php echo $privacy[0]; ?>";
  </script>
    
    <script src="/js_files/groupactivity.js" type="text/javascript">
    </script>
    <link rel="stylesheet" href="/cssfiles/groupspages.css" style="text/css" />
  </head>
  <body>
   <div class="top">
  <div class="header">
  <a href="/teeckleProfile.php">
    <img src="/images/Me.png" class="logo" />
    </a>
    <a class="profnav" id="profile"><img src="/images/Profile-Icons-Blue.png" /> </a> 
    <a class="profnav"  id="messages"><img src="/images/Message-Icons.png" /></a><span id="nums"></span>
<a class="profnav" id="contacts"> <img src="/images/book_grey2_icon.png" /> </a><span id="conts"></span> 
<a class="profnav" id="teeckles"><img src="/images/feather.png" /></a>
<span id="teeks"></span>
<a class="profnav" id="search" href="/search.php"><img src="/images/manfi_glass_blue.png" /></a>
    <p class="sections">
      <a href="/groups.php"> Groups </a>|
      <a style="color:#2774b8;"> Teeckle </a>|&nbsp;&nbsp;&nbsp;
      <a href="/php_files/sign_out.php"> Log out </a> 
    </p>
  </div>
  </div>
<p class="section2">
     &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
    
    
    
  </p>
  <div class="chat">
			<div class="chat-lobby">
				<div class="chat-caption">
					<p>Chat Lobby</p>
				</div>
				<div>
					<ul id="friend_list">
						
					</ul>
				</div>
				
			</div>
			<div class="chat-table">
				<div class="person">
				<img id="chat_pic" class="mess" src="" />
					<span id="chat_name"></span>
                         <span id="close" class="close">x<span>
				</div>
				<ul id="display_mess">
						
				</ul>
				<div id="mess_text">
					
				</div>
			</div>
		</div>
  <p class="groupinfo section2" >
  </p>
  <ul id="group2head">
     <ul id="groupnav">
     <li ><a class="navy" id="main">Main</a></li>
     <li ><a class="navy" id="disc">Discussions</a></li>
     <li ><a class="navy" id="pic">Pictures</a></li>
     <li ><a class="navy" id="mem">Members</a></li>
     </ul>
  </ul>
<div class="wrapper" id="wrapper">
<form action="" id="send_message">
<table style="display:none;" class="messbox" id="messbox">
<thead>
<th class="messhead" id="messhead">Send Message</th>
</thead>
<tbody id="messbody">
<tr><td>to <span style="color:#3D79B4;"><?php echo $visited; ?></span></td></tr>
<tr><td>
<textarea name="message" cols="50" rows="6" maxlength="140">
</textarea>
<input type="hidden" name="visited" value="<?php echo $visited; ?>" />
</td></tr>
<tr>
<td style="text-align:right;"><button type="button" id="sendmess"><a>send</a></button>&nbsp;<button type="button" id="cancelmess"><a>cancel</a></button></td>
</tr>
</tbody>
</table>
</form>
<ul id="leftgroup">
<li><table><tr><td><img class="profile_pic" id="profile_pic" src="" />
</td><td><button type="button" class="join_butt">JOIN</button></td></tr>
<tr><td><button class="del" type="button" id="delete">delete group</button></td></tr>
<tr><td><button class="leaves" type="button" id="leave">leave group</button></td></tr></table>
<li>
<ul class="user_basic_info">
<li class="groupinfo"></li>
<li class="groupinfo"></li>
<li class="groupinfo"></li>
<li class="groupinfo"></li>
<li class="groupinfo"></li>
</ul>
</li>
</ul>
<ul id="rightgroup">
<li>
<table class="desc">
<th id="desc_head" style="background-color:#3D79B4;color:white;">Description<a id="edit_descript">edit</a></th>
<tr><td><p class="groupinfo"></p></td></tr>
</table>
</il>
</ul>
<form id ="descform" method="post">
      <table id="descedit" class="messbox" id="messbox">
     <thead>
     <th class="messhead" id="messhead">description</th>
     </thead>
     <tbody id="messbody">
     <tr><td>edit description</td></tr>
     <tr><td>
     <textarea name="description" cols="50" rows="6" maxlength="140"></textarea>
     </td></tr>
     <tr>
     <td style="text-align:right;"><button type="button" id="sendimow" style="color:white;"><a>edit</a></button>&nbsp;<button type="button" id="cancelimow"><a>cancel</a></button></td>
     </tr>
     </tbody>
     </table>
     <input type="hidden" name="group" value="<?php echo $grouppage; ?>">
     </form>
     
     <table id="editbasic" >
<tr><td>country:</td></tr> 
<tr><td><select>
<option value="u.s.a">U.S.A</option>
</select></td></tr>
<tr><td>zip code:</td></tr> 
<tr><td><input type="text"></td></tr>
<tr><td>category:</td></tr>
<tr><td><select></select></td></tr>
</table>
</div>
<form id="topicreation">
<table id="topicform" style="display:none;width: 300px;position:absolute;margin-top: 20px;margin-left: 290px;">
<tr><td class="messhead">create a topic</td></tr>
<tr><td id="replace">topic: <input name="topic" type="text" />
<input type="hidden" name="page" value="<?php echo $grouppage; ?>"></td></tr>
<tr><td><button id="topicz" style="float:right;" type="button">create</button></td></tr>
</table>
</form>
</body>
</html>
