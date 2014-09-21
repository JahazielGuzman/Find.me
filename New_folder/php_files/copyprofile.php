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
       $visited = basename($path, ".php");
       if ($userreg == $visited) {
            header ('Location: /teeckleProfile.php');
            exit;
       }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
    Teeckle.me Dating
    </title>
    <meta charset= "utf-8">
    <link rel="stylesheet" href="/cssfiles/ProfilePage.css" type="text/css" id="change"/>
    <link href="/cssfiles/template.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/cssfiles/jqueryui.css" type="text/css"/>
    <link rel="stylesheet" href="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
    <script src="/js_files/jquery.js" type="text/javascript">
    </script>
    <script src="/js_files/jqueryui.js" type="text/javascript">
    </script>
    <script src="/js_files/fancybox/fancybox/jquery.fancybox-1.3.4.js" type="text/javascript"></script>
    <script src="/js_files/livequery/jquery.livequery.js" type="text/javascript"></script>
    <script>
    var curruser = "<?php echo $userreg; ?>";
    var page = "<?php echo $visited; ?>";
    
  </script>
    <script src="/js_files/visprof.js" type="text/javascript">
    </script>
    
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
<div class="wrapper" id="wrapper">
<form action="" id="send_message">
<table class="messbox" id="messbox">
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
<form action="" id="add_contact">
<table class="messbox" id="addbox">
<thead>
<th class="messhead" id="addhead">Send Message</th>
</thead>
<tbody id="addbody">
<input type="hidden" name="visited" value="<?php echo $visited; ?>" />
</table>
</form>
<table style="float:left;">
<tr>
<td>
<img class="profile_pic" id="profile_pic" src="" /></td></tr>
<tr><td style="text-align: center; color:#3D79B4;">my pictures</td></tr>
<tr><td>
<br /><br /><br />
<table class="info_box2">
<tr><td><a id="teeckleme">teeckle me</a></td></tr>
<tr><td><a id="messme">message me</a></td></tr>
<tr><td><a id="addme">add me</a></td></tr>
</table>
</td></tr>
</table>
<table class="user_basic_info" id="userinfo">
<tr><td style="font-size:32px;"><?php echo $visited; ?></td></tr>
<tr ><td>age:<p style="display:inline" class="user_info"></p></td></tr>
<tr ><td id="location" class="user_info"></td></tr>
<tr ><td id="gender" class="user_info"></td></tr>
<tr ><td id="orientation" class="user_info"></td></tr>
<tr><td>Open to:<p style="display:inline;" id="opento" class="user_info"></p></td></tr>
</table>
<table style="float:right;">
<tr>
<td>
<table class="info_box1">
<th style="background-color:#3D79B4;color:white;">in my own words</th>
<tr><td>
<p class="user_info"></td></tr>
</table>
</td></tr>
<tr><td>
<br /><br /><br /><br />
<table class="info_box1">
<th style="background-color:#3D79B4;color:white;">My Stats</th>
<tr>
<td>Ethnicity:<p class="user_info" id="showethnicity"></p></td></tr>
<tr><td>Body Type:<p class="user_info" id="bodytype"></p></td></tr>
<tr><td>Employment:<p class="user_info" id="employment"></p></td></tr>
<tr><td>Height:<p class="user_info" id="height"></p> </td></tr>
<tr><td>Alcohol:<p class="user_info" id="alcohol"></p> </td></tr>
<tr><td>Languages:<p class="user_info" id="languages"></p></td></tr>
</table>
</td>
</tr>
</table>

</div>
</body>
</html>
