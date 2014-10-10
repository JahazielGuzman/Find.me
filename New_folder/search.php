<?php

     session_start();
     // access to database
     require_once (__DIR__.'/php_files/connect.php');
     
     // if the user is currently logged in
     if (strlen($_SESSION['teeckle_user']) > 0) {
          
          // update the last time the user was on the site  
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
     
          $curruser = $_SESSION['teeckle_user'];
     }
     
     else {
     	
          // assume user is no longer on website
          $sql = "DELETE FROM sessions WHERE ip = ?";
      
          try {
               
               $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername,$DBpassword);
               $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               $stmt = $conn -> prepare($sql); 
               $stmt->execute(array($_SERVER['REMOTE_ADDR']));
               
               echo 'hi '.$_SESSION['teeckle_user'];
               exit;
          }
          catch (PDOException $e) {
         
               die ($e->getMessage());
          }

     }
     
     // use the current users zip code when they search for someone
     $sql = "SELECT zipcode FROM TeeckleUserProfile where teeckleUsern = ?";
    
     try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $DBusername, $DBpassword);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn->prepare($sql);
          $stmt ->execute(array($curruser));
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
    <link href="/cssfiles/template.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="/js_files/jquery_crop/css/imgareaselect-default.css" />
    <link rel="stylesheet" type="text/css" href="/cssfiles/search.css" />
    <script src="/js_files/jquery.js" type="text/javascript">
    </script>
    <script src="/js_files/livequery/jquery.livequery.min.js" type="text/javascript"></script>
    <script src="/js_files/search.js" type="text/javascript">
    </script>
    <script src="/js_files/chat.js" type="text/javascript"></script>
    <script>
    var zippy = "<?php echo $result[0]; ?>";
    var curruser = "<?php echo $_COOKIE['teeckle_user']; ?>";
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
<div class="wrapper" id="wrapper" style="
    padding-top: 10px;
    height: 800px;
">

<p style="
    display: inline;
    margin: -9px 1px 0px 50px;
    background-color: gray;
    padding: 10px;
    border-radius: 10px 10px 0px 0px;
    float: left;
">search</p>
<p style="
    display: inline;
    background-color: grey;
    border-radius: 10px 10px 0px 0px;
    padding: 10px;
    float: left;
    margin: -8px 0px 0px 0px;
">quick match</p>
<div style="
    background-color: rgb(245, 245, 245);
    width: 700px;
    height: 500px;
    border-radius: 10px 10px 0px 0px;
    float:left;
    margin: 30px -21px 0px 0px;
    position: absolute;
    padding: 10px;
" id="matches">
</div> 
<div style="
    float: left;
    width: 300px;
    height: 500px;
    background-color: rgb(245, 245, 245);
    border-radius: 10px;
    position: absolute;
    margin: 30px 0px 0px 700px;
">
<form id="search_matches" method="post">
          <p class="criteria"><span id="type">profile</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>
          
        </p>
        <table style="

    position: absolute;

    display: none;

    z-index:10;

" class="input_box">
        <tbody><tr><td><a class="type" id="profile">profiles</a></td></tr>
        <tr><td><a class="type" id="group">groups</a></td></tr>
        </table>
        <span id="search_type">
        <br>
        <p class="criteria"><span id="lookin">girls who like guys</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>
          <input name="preference" id="pref" type="hidden" value="girls who like guys" />
        </p>
        
        <table style="
    position: absolute;
    display: none;
    z-index:10;
" class="input_box">
        <tbody><tr><td><a class="looking" id="girlsguys">girls who like guys</a></td></tr>
        <tr><td><a class="looking" id="girlsguys">girls who like girls</a></td></tr>
        <tr><td><a class="looking" id="guysgirls">guys who like girls</a></td></tr>
        <tr><td><a class="looking" id="guysguys">guys who like guys</a></td></tr>
        <tr><td><a class="looking" id="girlsboth">girls who like both</a></td></tr>
        <tr><td><a class="looking" id="guysboth">guys who like both</a></td></tr>
        </tbody></table><br>
        <p class="criteria"><span id="start">18</span> to <span id="end">24</span>:&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>
        </p>
       
        <table style="
    position: absolute;
    display: none;
" class="input_box">
        <tbody><tr><td>ages <input name="age1" id="age1" width="2" value="18" type="text" maxlength="2" style="
    width: 30px;
">
        -</td><td><input name="age2" id="age2" width="2" value="24" type="text" maxlength="2" style="
    width: 30px;
"></td></tr>
        </tbody></table><br>
        <p class="criteria"><span id="relstatus"> single</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>
        <input name="status" type="hidden" value="single" />
        </p>
        
        <table name="employment" style="
    position: absolute;
    display: none;
" class="input_box">
        <tbody><tr><td><a class="relstat" value="single">single</a></td></tr>
        <tr><td><a  class="relstat" value="in a relationship">in a relationship</a></td></tr>
        <tr><td><a class="relstat"  value="married">married</a></td></tr>
        <tr><td><a class="relstat"  value="married">any</a></td></tr>
        </tbody></table><br>
        <p class="criteria"><span id="have">have a photo</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>
        <input name="photo" type="hidden" id="picval" value="have a photo" />
        </p>
        
        <table name="feet" style="
    position: absolute;
    display: none;
" class="input_box">
        <tbody><tr><td><a class="picornot">have a photo</a></td></tr>
        <tr><td><a class="picornot">doesn't matter</a></td></tr>
        </tbody></table>
        
        <p class="criteria"><span id="mill">2</span> miles away from <span id="fromz">me</span>&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/>
        <input name="zip" type="hidden" value=<?php echo $result[0]; ?> />
        </p>
        
        <table style="
    position: absolute;
    display: none;
" class="input_box">
        <tbody><tr><td><a><input type="text" style="
    width: 50px; 
" value=<?php echo $result[0]; ?> /></a></td></tr>
        <tr><td><a><select name="dist" id="milesaway">
        <option value="2" name="2" class="distance">2</option>
        <option value="5" name="5" class="distance">5</option>
        <option value="15" name="15" class="distance">15</option>
        <option value="50" name="50" class="distance">50</option>
        <option value="250" name="250" class="distance">250</option>
        </select></a></td></tr>
        </tbody></table><br>
       <p class="criteria">advanced&nbsp;&nbsp;<img src="/images/arrow.jpg" width="15px" height="15px"/></p>
       <table style="
    position: absolute;
    display: none;
    z-index:10;

" class="input_box"> 
        <tbody><tr><td><a class="advanced">ethnicity</a></td></tr>
        <tr><td><a class="advanced">body type</a></td></tr>
        <tr><td><a class="advanced">employment</a></td></tr>
        <tr><td><a class="advanced">height</a></td></tr>
        <tr><td><a class="advanced">alcohol</a></td></tr>
        <tr><td><a class="advanced">languages</a></td></tr>
        </tbody></table>
       <div id="advanced" style="display: none;">
       Ethnicity:

        <select name="ethnicity" class="dis" id="eth">
        <option value="asain">asian</option>
        <option value="black">black</option>
        <option value="latino">latino/hispanic</option>
        <option value="white">white</option>
        <option value="other">other</option>
        </select> <br />
        Body Type:
        <select name="bodytype" class="dis" id="bodt">
        <option value="slim">slim</option>
        <option value="athletic">athletic</option>
        <option value="extra">a little extra</option>
        <option value="curvy">curvy</option>
        </select><br />
        Employment:
        <select name="employment" class="dis" id="emp">
        <option value="self employed">self employed</option>
        <option value="student">student</option>
        <option value="full time">full time</option>
        <option value="part time">part time</option>
        <option value="other">other</option>
        </select><br />
        Height:
        <select name="feet" class="dis" class="hei">
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        </select>
        <select name="inches" class="dis" class="hei">
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
        <select name="alcohol" class="dis" id="alc">
        <option value="heavy drinker">heavy drinker</option>
        <option value="social drinker">social drinker</option>
        <option value="dont drink">dont drink</option>
        </select><br />
        <select name="languages[]" class="dis" id="lan1">
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
        <select name="languages[]" class="dis" id="lan2">
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
        <select name="languages[]" class="dis" id="lan3">
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
        <select name="education"  class="dis" id="education">
<option value="High school">High school</option>
<option value="Associates">Associates</option>
<option value="Bachelors">Bachelors</option>
<option value="Masters program">Masters program</option>
<option value="Law school">Law school</option>
<option value="Medical school">Medical school</option>
<option value="Ph.D">Ph.D</option>
</select><br />
<select  name="kids" class="dis" id="kid">
<option value="Have a kid">Have a kid</option>
<option value="Have kids">Have kids</option>
<option value="Dont have kids">Dont have kids</option>
<option value="Might want kids">Might want kids</option>
<option value="Want kids">Want kids</option>
<option value="Dont want kids">Dont want kids</option>
</select><br />
        </div>
      </form>
      </span>
      <a id="searchp">search</a>
      </div>
</div>
<div id="footer">
     Teeckle.Me &#169; 2012 &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
      <a>About Us</a>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
      <a>Privacy</a>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
      <a>Terms &amp; Conditions</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      <a>FAQ</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      <a>Contact Us </a></div>
</body>
</html>
