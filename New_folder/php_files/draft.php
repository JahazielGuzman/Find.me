<?php
     
     $curruser = $_COOKIE['teeckle_user'];
     $timesent = $_POST['time_sent']
     $sql = "UPDATE ".$curruser." checked = 0 WHERE datesent = ?";

     require_once 'message.php';
     
     $con = @ new mysqli($messhost,$messusername,$messpass,$messdbn);
     if ($con -> mysql_connect_errno()) {
          die ('connection error');          
     }
     $stmt = $con -> prepare ($sql);
     $stmt -> bind_param("s",$timesent);
     $stmt -> execute();
      if ($stmt -> error != '') {
          die ("stuff happens1");
     }
     $stmt -> close();
     $con -> close();

     //*******seperator*********//

     
     $sql = "SELECT COUNT( * ) FROM ".$usseregg; // method of counting rows

     /////////////////////////////////
     
     session_start();
     $curruser = $_COOKIE['teeckle_user'];

     

     //******seperator********//

     session_start();
     $curruser = $_COOKIE['teeckle_user'];
     $piclocale = $_POST['pic_delete'];
     require_once 'picture.php';

     $deleted = unlink($piclocale);
     $sql = "DELETE FROM ".$curruser."pic_location,date_added,default_pic WHERE pic_location = ?";

     //********seperator********//
     $path = $_SERVER['PHP_SELF'];
     $visited = basename($path, ".php")

     ////
     if (gooddate.test(data[i])) {
                         var bday,byear;
                         bday = data[i].substr(0,5);
                         byear = data[i].substr(6,4);
                         byear = parseInt(byear);
                         var year = new Date();
                         year = year.getFullYear();
                         var day = new Date(day/month);
                         year = year - byear;
                         if (day < bday) {
                              year --;
                         }
                         $(this).text(year);
                    }
                    if ($birth != null) {
          $sql .= " `dob` = ?,";
          $count .= 's';
          $params[] = $birth;
     }

     //********seperator*********//

     // copy code to a file to create the profile, create file with name of user //
     write("/users/".$username.".php","/php_files/copyprofile.php");

$myFile = "/profile/".$username.".php";
$fh = fopen($myFile, 'w',0777) or die("can't open file");
$stringData = file_get_contents("copyprofile.php");
fwrite($fh, $stringData);
fclose($fh);

///////////////CRYPT//////////////////



     $sql = "SELECT * FROM TeeckleUserInfo WHERE hash = ?";

     require_once 'message.php';
     
     $con = @ new mysqli($host,$dbusername,$dbpassword,$dbn);
     if ($con -> mysql_connect_errno()) {
          die ('connection error');          
     }

     do  {
     $salt = rand();
     $stmt = $con -> prepare ($sql);
     $stmt = $con -> bind_param("s",$salt);
     $stmt -> execute();
     if ($stmt -> error != '') {
          die ("stuff happens1");
     }
     $stmt -> store_result();
     $rows = $stmt -> num_rows;
     $stmt -> close();
     } while ($rows > 0);
     $nsql = "INSERT INTO TeeckleUserInfo (hash) VALUES (?) WHERE TeeckleUsern = ?";
     $stmt = $con -> prepare($sql);
     $stmt = $stmt -> bind_param("ss",$salt,$username);
     $stmt -> execute();
     $con -> close();
     echo $rows;

     ////////////////sd/sd/sd/s/////

     $('[placeholder]').focus(function() {
	  var input = $(this);
	  if (input.val() == input.attr('placeholder')) {
		input.val('');
		input.removeClass('placeholder');
	  }
	}).blur(function() {
	  var input = $(this);
	  if (input.val() == '' || input.val() == input.attr('placeholder')) {
		input.addClass('placeholder');
		input.val(input.attr('placeholder'));
	  }
	}).blur();
	$('[placeholder]').parents('form').submit(function() {
	  $(this).find('[placeholder]').each(function() {
		var input = $(this);
		if (input.val() == input.attr('placeholder')) {
		  input.val('');
		}
	  })
	});
	///////////////////

	<form class="search_matches" style="display:none;" action="" method="post">
<i>Search Potential Matches </i> <br /> <br />
<b>I am looking for:</b> 
<select id="matchsex" name="matchsex">
<option value="Women"> Women <option>
<option value="Men"> Men </option>
</select>
<br />
<b>Sexual Orientation: </b>
<select id="sexorient" name="sexorient">
<option value="Straight">Straight</option>
<option value="Gay">Gay</option>
<option value="Bi">Bi</option>
<option value="any"> Any </option>
</select>
<br />
<b>Aged between: </b>
<select id="startage" name="startage">
</select>
 & 
<select id="endage" name="endage">
</select><br />
<b>Ethnicity: </b> 
<select name="ethnicity">
<option value="any"> Any </option>
<option value="White"> White </option>
<option value="Black"> Black </option>
<option value="Latino"> Latino </option>
<option value="Asian"> Asian </option>
</select> <br />
<b>Body Type: </b>
<select id="bodyType" name="bodyType">
</select>
 <br />
<b>Living within: </b>
<select name="milesWithin">
<option value="5"> 5 </option>
<option value="10"> 10 </option>
<option value="15"> 15 </option>
<option value="25"> 25 </option>
</select>
<b> of </b>
<b>Zip Code: </b>
<input type="text" name="zipCodeMatch" maxlength="5" size="5" /><br />
<b> Interested In: </b>
<select name="interestMatch">
<option>Casual Encounters</option>
<option></option>
<option></option>
</select> <br />
<input class="submit" type="submit" name="searchMatches" value="submit"/>
</form>

/////////////////////// for message displaying /////////////////////

<div style="
    width: 700px;
    padding: 5px;
">
<img style="
    height: 40px;
    width: 40px;
    background-color: black;
">

<table style="
    display: inline-table;
    background-color: rgb(228, 228, 228);
    height: 50px;
    border-radius: 5px;
">
<tbody style="
    display: inline;
"><tr>
<td>s dusdsu dsuodisod soid osidos dos idos dosidosiodis dsodi osdiosidosi d</td>
<td style="
    padding-left: 65px;
">Aug 2 2012 - 5:30pm</td>

</tr>
</tbody></table>

</div>

///////////////////////////////////////////////////////////////////

<div style="width: 300px;
background-color: white;
border-radius: 5px;
overflow: auto;">
<img src="" style='height: 80px;
width:80px;
background-color: black;'>
<table style="
    margin-top: -85px;
    display: inline-table;
width: 100px;
">
<tbody><tr><td>username</td></tr>
<tr><td>hello</td></tr>
</tbody></table>
</div>

///////////////////////////////////////////////////////////

if (isset($_COOKIE['teeckle_usern'])) {
     $date = date("d,m,Y H:i:s");
     $sql = "UPDATE sessions SET upd = ? WHERE ip = ?";
      require_once 'connect.php';
      try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $usern,$pass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($date,$_SERVER['REMOTE_ADDR']));
     }
     catch (PDOException $e) {
          die ($e->getMessage());
     }
}
else {
      $sql = "DELETE FROM sessions WHERE ip = ?";
      require_once 'connect.php';
      try {
          $conn = new PDO('mysql:host='.$host.';dbname='.$dbn, $usern,$pass);
          $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $stmt = $conn -> prepare($sql); 
          $stmt->execute(array($_SERVER['REMOTE_ADDR']));
     }
     catch (PDOException $e) {
          die ($e->getMessage());
     }
}

/////////////////////////////////////////////////////////
?>

SELECT thumbnail,TeeckleUsern AS usern, gender, relstatus, lookingfor, imow, dob, city, state

FROM TeeckleUserProfile AS TUP, 

zips_table AS zp, (

SELECT latitude, longitude

FROM zips_table

WHERE zipcode = 11226

) AS LAT, TeeckleUserProfile AS TIP

LEFT JOIN (

SELECT * 

FROM pic_table

WHERE defaultpic =  1

) AS pt ON ( pt.user = TIP.teeckleUsern )

WHERE TUP.zipcode = zp.zipcode

AND TUP.zipcode

IN (



SELECT zipcode

FROM zips_table

WHERE (

( 180.00 * ( ACOS( (

SIN( RADIANS( LAT.latitude ) ) * SIN( RADIANS( latitude ) ) + COS( RADIANS( LAT.latitude ) ) * COS( RADIANS( latitude ) ) * COS( RADIANS( LAT.longitude ) - RADIANS( longitude ) ) ) ) ) / PI( )

) * 69.09

) <= 5

) AND lookingfor  = 'looking for a girl' AND gender = 'W' AND FLOOR(DATEDIFF(CURDATE(),STR_TO_DATE(dob,'%m/%d/%Y'))/365) >= 18 AND FLOOR(DATEDIFF(CURDATE(),STR_TO_DATE(dob,'%m/%d/%Y'))/365) <= 24 AND relstatus = 'single'

//////////////////////////////////////////////////////////////////

<div style="
    overflow: auto;
"><div style="
    overflow: auto;
"><img style="
    width: 75px;
    height: 75px;
    background-color: black;
    float: left;
"><table style="
    float: left;
    display: inline;
">
<tbody><tr><td>Scarlett</td></tr>
<tr><td>27/F/Straight/Single</td></tr>
<tr><td>Brooklyn, NY</td></tr>
<tr><td>Short-term relationships</td></tr>
</tbody></table></div>
<p style="
    display: block;
">on a typical friday niht i am once in while i like to go out and havre a good time doing whatever im doing that is very rare, even though i like to go out more. its a lil hard sometimes</p>
</div>

//////////////////////////////////////////////////////////////////

INSERT INTO contact_table (reqfrom,reqto,iscontact) VALUES ('pitaz','pikachu7',0) WHERE NOT EXISTS ( SELECT contactid FROM contact_table WHERE reqfrom IN ('pitaz','pikachu7') AND reqto IN ('pitaz','pikachu7') AND iscontact = 1
)
