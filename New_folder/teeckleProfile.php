<?php
     session_start();
     require_once ('/home/content/24/9456524/html/php_files/connect.php');
     
     // check if user is logged in
     if (isset($_SESSION['teeckle_user'])) {
          
          // update the time the user is logged in  
          $date = date("d,m,Y H:i:s");
          $sql = "UPDATE sessions SET upd = ? WHERE ip = ?";
      
          try {
          
               $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername,$DBpassword);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn -> prepare($sql); 
               $stmt->execute(array($date,$_SERVER['REMOTE_ADDR']));
          }
          
          catch (PDOException $e) {
               die ($e->getMessage());
          }
     $userreg = $_SESSION['teeckle_user'];
     }

     else {
     	
          $sql = "DELETE FROM sessions WHERE ip = ?";
        
          try {
          	
               $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername,$DBpassword);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn -> prepare($sql); 
               $stmt->execute(array($_SERVER['REMOTE_ADDR']));
               
               header ('Location: /index.php');
               exit;
          }
     
          catch (PDOException $e) {
               die ($e->getMessage());
          }

     }
     
     $userdef = htmlentities($_SESSION['teeckle_user']);
     

     if (isset($_POST['visited'])) {
          $userdef = htmlentities($_POST['visited']);
     }
     
     // get the thumbnail for the profile picture of the current user
     $sql = "SELECT thumbnail FROM pic_table WHERE defaultpic = 1 AND user = ?";
     
     require_once '/home/content/24/9456524/html/php_files/connect.php';
     
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql);
          $stmt->execute(array($userdef));
          $result = $stmt -> fetch();
     }
     
     catch (PDOException $e) {
          die ($e);
     }
     
?>
<!DOCTYPE html>
<html>
  <head>
  <meta charset="utf-8" />
    <title>
    Teeckle.me Dating
    </title>
    <link rel="stylesheet" href="/cssfiles/ProfilePage.css" type="text/css" id="change"/>
    <link href="/cssfiles/template.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="/cssfiles/jqueryui.css" type="text/css"/>
    
    <link rel="stylesheet" type="text/css" href="/js_files/jquery_crop/css/imgareaselect-default.css" />
    <script src="/js_files/jquery.js" type="text/javascript">
    </script>
    <script src="/js_files/jqueryui.js" type="text/javascript">
    </script>
    <script src="/js_files/livequery/jquery.livequery.min.js" type="text/javascript"></script>
    <script>
    var curruser = "<?php echo $userreg; ?>";
    $(function () {

	 // update the current time in a variable
         var today = new Date();
         today = today.getFullYear();
         var this_year = today - 18;
         var start = today - 100;
         
              // change the tume a user can select on the datepicker
       	      $( "#datepick" ).datepicker({
         	   changeMonth: true,
		   changeYear: true,		
		   yearRange: start + ':' + this_year
	      });
		
	     
	});
  </script>
    
    <script src="/js_files/sections.js" type="text/javascript">
    </script>
    <script src="/js_files/chat.js" type="text/javascript">
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
    <form class="edit" id="edit_main" method="post">
      edit main information
      <hr />
      I am: 
      <select name="changestatus" id="changestatus">
      <option value="...">...</option> 
      <option value="single"> single </option> 
      <option value="married"> married </option>
      <option value="other"> other </option>  
      </select>
      <select name="changeorientation" id="changesorientation">
      <option value="...">...</option> 
      <option value="looking for a girl"> girl </option> 
      <option value="looking for a guy"> guy </option>
      <option value="looking for both"> both </option>  
      </select>
      <select name="changesex" id="changesex"> 
      <option value="...">...</option> 
      <option value="Woman"> Woman </option> 
      <option value="Man"> Man </option> 
      </select>
      <hr />
      open to:
      <select name="opento">
      <option value="...">...</option> 
      <option value="friends">friends</option>
      <option value="short-term relationships">short term relationships</option>
      <option value="long-term relationships">long term relationships</option>
      </select>
      <hr />
      born:
      <input type="text" name="change_birth" id="datepick" size="5"/>
      <hr />
      <select name="changecountry" id="changecountry">
      <option value="...">...</option> 
      <option value="U.S.A">U.S.A </option>
      </select>&nbsp;&nbsp;&nbsp;Zip code:
      <input type="text" name="change-zip" id="changezip" size="5" maxlength="5">
      <hr />
      <br />
      <a id="submit_edit_main">submit</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <a id="close_edit_main">close</a>
      </form>
      <form id ="imowform" method="post">
      <table id="imowedit" class="messbox" id="messbox">
     <thead>
     <th class="messhead" id="messhead">In My Own Words</th>
     </thead>
     <tbody id="messbody">
     <tr><td>edit</td></tr>
     <tr><td>
     <textarea name="imow" cols="50" rows="6" maxlength="140"></textarea>
     </td></tr>
     <tr>
     <td style="text-align:right;"><button type="button" id="sendimow" style="color:white;"><a>edit</a></button>&nbsp;<button type="button" id="cancelimow"><a>cancel</a></button></td>
     </tr>
     </tbody>
     </table>
     </form>
      <form id="mystatsedit" class="edit" method="post">
        mystatsedit <br />
        Ethnicity:
        <select name="ethnicity">
        <option value="...">...</option> 
        <option value="black">black</option>
        <option value="white">white</option>
        <option value="latino">latino/hispanic</option>
        <option value="asain">asian</option>
        <option value="other">other</option>
        </select> <br />
        Body Type:
        <select name="bodytype">
        <option value="...">...</option> 
        <option value="slim">slim</option>
        <option value="athletic">athletic</option>
        <option value="extra">a little extra</option>
        <option value="curvy">curvy</option>
        </select><br />
        Employment:
        <select name="employment">
        <option value="...">...</option> 
        <option value="self employed">self employed</option>
        <option value="student">student</option>
        <option value="full time">full time</option>
        <option value="part time">part time</option>
        <option value="other">other</option>
        </select><br />
        Height:
        <select name="feet">
        <option value="...">...</option> 
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        </select>
        <select name="inches">
        <option value="...">...</option> 
        <option value="0">0</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        </select><br />
        Alcohol:
        <select name="alcohol">
        <option value="...">...</option> 
        <option value="heavy drinker">heavy drinker</option>
        <option value="social drinker">social drinker</option>
        <option value="dont drink">dont drink</option>
        </select><br />
        Languages:
        <select name="languages[]">
        <option value="...">...</option>
        <option value="English">English</option>
<option value="Afrikaans">Afrikaans</option>
<option value="Albanian">Albanian</option>
<option value="Arabic">Arabic</option>
<option value="Armenian">Armenian</option>
<option value="Basque">Basque</option>
<option value="Belarusan">Belarusan</option>
<option value="Bengali">Bengali</option>
<option value="Breton">Breton</option>
<option value="Bulgarian">Bulgarian</option>
<option value="Catalan">Catalan</option>
<option value="Cebuano">Cebuano</option>
<option value="Chechen">Chechen</option>
<option value="Chinese">Chinese</option>
<option value="C++">C++</option>
<option value="Croatian">Croatian</option>
<option value="Czech">Czech</option>
<option value="Danish">Danish</option>
<option value="Dutch">Dutch</option>
<option value="Esperanto">Esperanto</option>
<option value="Estonian">Estonian</option>
<option value="Farsi">Farsi</option>
<option value="Finnish">Finnish</option>
<option value="French">French</option>
<option value="Frisian">Frisian</option>
<option value="Georgian">Georgian</option>
<option value="German">German</option>
<option value="Greek">Greek</option>
<option value="Gujarati">Gujarati</option>
<option value="Ancient Greek">Ancient Greek</option>
<option value="Hawaiian">Hawaiian</option>
<option value="Hebrew">Hebrew</option>
<option value="Hindi">Hindi</option>
<option value="Hungarian">Hungarian</option>
<option value="Icelandic">Icelandic</option>
<option value="Ilongo">Ilongo</option>
<option value="Indonesian">Indonesian</option>
<option value="Irish">Irish</option>
<option value="Italian">Italian</option>
<option value="Japanese">Japanese</option>
<option value="Khmer">Khmer</option>
<option value="Korean">Korean</option>
<option value="Latin">Latin</option>
<option value="Latvian">Latvian</option>
<option value="Lithuanian">Lithuanian</option>
<option value="Malay">Malay</option>
<option value="Maori">Maori</option>
<option value="Mongolian">Mongolian</option>
<option value="Norwegian">Norwegian</option>
<option value="Occitan">Occitan</option>
<option value="Polish">Polish</option>
<option value="Portuguese">Portuguese</option>
<option value="Romanian">Romanian</option>
<option value="Rotuman">Rotuman</option>
<option value="Russian">Russian</option>
<option value="Sanskrit">Sanskrit</option>
<option value="Sardinian">Sardinian</option>
<option value="Serbian">Serbian</option>
<option value="Sign Language">Sign Language</option>
<option value="Slovak">Slovak</option>
<option value="Slovenian">Slovenian</option>
<option value="Spanish">Spanish</option>
<option value="Swahili">Swahili</option>
<option value="Swedish">Swedish</option>
<option value="Tagalog">Tagalog</option>
<option value="Tamil">Tamil</option>
<option value="Thai">Thai</option>
<option value="Tibetan">Tibetan</option>
<option value="Turkish">Turkish</option>
<option value="Ukrainian">Ukrainian</option>
<option value="Urdu">Urdu</option>
<option value="Vietnamese">Vietnamese</option>
<option value="Welsh">Welsh</option>
<option value="Yiddish">Yiddish</option>
        </select><br />
        <select name="languages[]">
        <option value="...">...</option>
        <option value="English">English</option>
<option value="Afrikaans">Afrikaans</option>
<option value="Albanian">Albanian</option>
<option value="Arabic">Arabic</option>
<option value="Armenian">Armenian</option>
<option value="Basque">Basque</option>
<option value="Belarusan">Belarusan</option>
<option value="Bengali">Bengali</option>
<option value="Breton">Breton</option>
<option value="Bulgarian">Bulgarian</option>
<option value="Catalan">Catalan</option>
<option value="Cebuano">Cebuano</option>
<option value="Chechen">Chechen</option>
<option value="Chinese">Chinese</option>
<option value="C++">C++</option>
<option value="Croatian">Croatian</option>
<option value="Czech">Czech</option>
<option value="Danish">Danish</option>
<option value="Dutch">Dutch</option>
<option value="Esperanto">Esperanto</option>
<option value="Estonian">Estonian</option>
<option value="Farsi">Farsi</option>
<option value="Finnish">Finnish</option>
<option value="French">French</option>
<option value="Frisian">Frisian</option>
<option value="Georgian">Georgian</option>
<option value="German">German</option>
<option value="Greek">Greek</option>
<option value="Gujarati">Gujarati</option>
<option value="Ancient Greek">Ancient Greek</option>
<option value="Hawaiian">Hawaiian</option>
<option value="Hebrew">Hebrew</option>
<option value="Hindi">Hindi</option>
<option value="Hungarian">Hungarian</option>
<option value="Icelandic">Icelandic</option>
<option value="Ilongo">Ilongo</option>
<option value="Indonesian">Indonesian</option>
<option value="Irish">Irish</option>
<option value="Italian">Italian</option>
<option value="Japanese">Japanese</option>
<option value="Khmer">Khmer</option>
<option value="Korean">Korean</option>
<option value="Latin">Latin</option>
<option value="Latvian">Latvian</option>
<option value="Lithuanian">Lithuanian</option>
<option value="Malay">Malay</option>
<option value="Maori">Maori</option>
<option value="Mongolian">Mongolian</option>
<option value="Norwegian">Norwegian</option>
<option value="Occitan">Occitan</option>
<option value="Polish">Polish</option>
<option value="Portuguese">Portuguese</option>
<option value="Romanian">Romanian</option>
<option value="Rotuman">Rotuman</option>
<option value="Russian">Russian</option>
<option value="Sanskrit">Sanskrit</option>
<option value="Sardinian">Sardinian</option>
<option value="Serbian">Serbian</option>
<option value="Sign Language">Sign Language</option>
<option value="Slovak">Slovak</option>
<option value="Slovenian">Slovenian</option>
<option value="Spanish">Spanish</option>
<option value="Swahili">Swahili</option>
<option value="Swedish">Swedish</option>
<option value="Tagalog">Tagalog</option>
<option value="Tamil">Tamil</option>
<option value="Thai">Thai</option>
<option value="Tibetan">Tibetan</option>
<option value="Turkish">Turkish</option>
<option value="Ukrainian">Ukrainian</option>
<option value="Urdu">Urdu</option>
<option value="Vietnamese">Vietnamese</option>
<option value="Welsh">Welsh</option>
<option value="Yiddish">Yiddish</option>
        </select><br />
        <select name="languages[]">
        <option value="...">...</option>
        <option value="English">English</option>
<option value="Afrikaans">Afrikaans</option>
<option value="Albanian">Albanian</option>
<option value="Arabic">Arabic</option>
<option value="Armenian">Armenian</option>
<option value="Basque">Basque</option>
<option value="Belarusan">Belarusan</option>
<option value="Bengali">Bengali</option>
<option value="Breton">Breton</option>
<option value="Bulgarian">Bulgarian</option>

<option value="Catalan">Catalan</option>
<option value="Cebuano">Cebuano</option>

<option value="Chechen">Chechen</option>
<option value="Chinese">Chinese</option>
<option value="C++">C++</option>
<option value="Croatian">Croatian</option>
<option value="Czech">Czech</option>
<option value="Danish">Danish</option>
<option value="Dutch">Dutch</option>
<option value="Esperanto">Esperanto</option>
<option value="Estonian">Estonian</option>
<option value="Farsi">Farsi</option>
<option value="Finnish">Finnish</option>
<option value="French">French</option>
<option value="Frisian">Frisian</option>
<option value="Georgian">Georgian</option>
<option value="German">German</option>
<option value="Greek">Greek</option>
<option value="Gujarati">Gujarati</option>
<option value="Ancient Greek">Ancient Greek</option>
<option value="Hawaiian">Hawaiian</option>
<option value="Hebrew">Hebrew</option>
<option value="Hindi">Hindi</option>
<option value="Hungarian">Hungarian</option>
<option value="Icelandic">Icelandic</option>
<option value="Ilongo">Ilongo</option>
<option value="Indonesian">Indonesian</option>
<option value="Irish">Irish</option>
<option value="Italian">Italian</option>
<option value="Japanese">Japanese</option>
<option value="Khmer">Khmer</option>
<option value="Korean">Korean</option>
<option value="Latin">Latin</option>
<option value="Latvian">Latvian</option>
<option value="Lithuanian">Lithuanian</option>
<option value="Malay">Malay</option>
<option value="Maori">Maori</option>
<option value="Mongolian">Mongolian</option>
<option value="Norwegian">Norwegian</option>
<option value="Occitan">Occitan</option>
<option value="Polish">Polish</option>
<option value="Portuguese">Portuguese</option>
<option value="Romanian">Romanian</option>
<option value="Rotuman">Rotuman</option>
<option value="Russian">Russian</option>
<option value="Sanskrit">Sanskrit</option>
<option value="Sardinian">Sardinian</option>
<option value="Serbian">Serbian</option>
<option value="Sign Language">Sign Language</option>
<option value="Slovak">Slovak</option>
<option value="Slovenian">Slovenian</option>
<option value="Spanish">Spanish</option>
<option value="Swahili">Swahili</option>
<option value="Swedish">Swedish</option>
<option value="Tagalog">Tagalog</option>
<option value="Tamil">Tamil</option>
<option value="Thai">Thai</option>
<option value="Tibetan">Tibetan</option>
<option value="Turkish">Turkish</option>
<option value="Ukrainian">Ukrainian</option>
<option value="Urdu">Urdu</option>
<option value="Vietnamese">Vietnamese</option>
<option value="Welsh">Welsh</option>
<option value="Yiddish">Yiddish</option>
        </select><br />
        <select name="education" id="education">
<option value="High school">High school</option>
<option value="Associates">Associates</option>
<option value="Bachelors">Bachelors</option>
<option value="Masters program">Masters program</option>
<option value="Law school">Law school</option>
<option value="Medical school">Medical school</option>
<option value="Ph.D">Ph.D</option>
</select><br />
<select>
<option value="Have a kid">Have a kid</option>
<option value="Have kids">Have kids</option>
<option value="Dont have kids">Dont have kids</option>
<option value="Might want kids">Might want kids</option>
<option value="Want kids">Want kids</option>
<option value="Dont want kids">Dont want kids</option>
</select><br />
        <button type="button" id="changestats">save</button>
        <button type="button" id="closestats">cancel</button>
      </form>
<table style="float:left;">
<tr>
<td>
<img class="profile_pic" id="profile_pic" src="<?php echo $result[0]; ?>" />
</td>
</tr>
<tr><td style="text-align: center; color:#3D79B4;">my pictures</td></tr>
<tr><td><div class="question">
			<div class="question_caption" align="center">
				Question
			</div>
			<div class="question_form">
			<form>
			<ul>
				<li>
				<label>Do you like foreign movies with subtitles?</label><br>
				<input type="radio" name="q1" value="1a" checked="checked">Yes<br>
				<input type="radio" name="q1" value="1b">No<br>
				<input type="radio" name="q1" value="1c">can't answer with a subtitle
				</li>
				<li>
				<label>Answers I'll accept</label><br>
				<input type="radio" name="q2" value="2a">Yes<br>
				<input type="radio" name="q2" value="2b">No<br>
				<input type="radio" name="q2" value="2c" checked="checked">can't answer with a subtitle
				</li>
				<li>
				<label>This question is...</label><br>
				<input type="radio" name="q3" value="3a">Irrelevant<br>
				<input type="radio" name="q3" value="3b">A little important<br>
				<input type="radio" name="q3" value="3c" checked="checked">Somewhat important<br>
				<input type="radio" name="q3" value="3d">Very important
				</li>
			</ul>
			</form>
			</div>
		</div></td></tr>
</table>
<table class="user_basic_info" id="userinfo">
<tr><td style="font-size:32px;"><?php echo $userreg; ?></td><td><a id="editmainbutt">edit</a></tr></tr>
<tr ><td>age:<p style="display:inline" class="user_info"></p></td></tr>
<tr ><td id="location" class="user_info"></td></tr>
<tr ><td id="gender" class="user_info"></td></tr>
<tr ><td id="orientation" class="user_info"></td></tr>
<tr><td>Open to:<p style="display:inline;" id="opento" class="user_info"></p></td></tr>
<tr><td id="relstatus" class="user_info"></td></tr>
</table>
<table style="float:right;">
<tr>
<td>
<table class="info_box1" id="imowhead">
<th class="info_head">in my own words<a id="editimow" class="edit_button" >edit</a></th>
<tr><td class="user_info">
</td></tr>
</table>
</td></tr>
<tr><td>
<br />
<br />
<br />
<br />
<table class="info_box1">
<th class="info_head" id="statshead">My Stats<a id="editstats" style="margin-left:82px;" class="edit_button">edit</a></th>
<tr>
<td>Ethnicity:<p class="user_info" id="showethnicity"></p></td></tr>
<tr><td>Body Type:<p class="user_info" id="bodytype"></p></td></tr>
<tr><td>Employment:<p class="user_info" id="employment"></p></td></tr>
<tr><td>Height:<p class="user_info" id="height"></p> </td></tr>
<tr><td>Alcohol:<p class="user_info" id="alcohol"></p> </td></tr>
<tr><td>Languages:<p class="user_info" id="languages"></p></td></tr>
<tr><td>Education:<p class="user_info" id="education"></p></td></tr>
<tr><td>Children:<p class="user_info" id="children"></p></td></tr>
</table>
</td>
</tr>
</table>
</div>

</body>
</html>
