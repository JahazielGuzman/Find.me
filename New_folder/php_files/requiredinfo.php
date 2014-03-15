<?php

       session_start();
       if (isset($_SESSION['teeckle_user'])) {
            $userreg = $_SESSION['teeckle_user'];
            $DOB = $_SESSION['teeckle_dob'];
            $sex = $_SESSION['teeckle_sex']; 
       }
       else {
            header ('Location: /login_register.php');
            exit;
       }
?>

<!DOCTYPE html>
<html>
  <head>
    <title> teeckle.me </title>
    <link href="" rel="stylesheet" type="text/css" >
    <link href="/cssfiles/template.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js">
    </script>
    <script src="/js_files/age_info.js" type="text/javascript"> 
    </script>
    <script src="/js_files/lib/jquery.form.js" type="text/javascript">
    </script>
    <script>
    $(function () {
    $('#reqinf').click(function () {
     sub = $('[name="zip_code"]');
     sub = sub.val();
     $.post('/php_files/checkzip.php',{'zip_code':sub},function (data) {
          if (data != 0) {
               $('#morereginfo').attr('action',"/php_files/requiredinfoform.php");
               $('#morereginfo').submit();
          }
     });
});
});
    </script>
  </head>
  <body>
    <div class="header">
      <img src="/images/Me.png" class="logo" />
      <p class="sections">
        <a>Groups</a>&nbsp; &nbsp; &nbsp; &nbsp;
        <a>Places</a>&nbsp; &nbsp; &nbsp; &nbsp;
        <a>Teeckle</a>
      </p>
    </div>
    <div class="wrapper" id="wrapper">
    <p>
    Just a little more information <?php echo $userreg ?>
    </p>
    <br />
    <form method="post" name="morereginfo" id="morereginfo" style="display:inline;">
    Country: <select name="country">
    <option name="country" value="U.S.A">U.S.A</option>
    </select> <br />
    Zip code: <input type="text" name="zip_code" maxlength="5" size="5"/> <br />
    status: <select name="status">
    <option name="status" value="single"> I'm single </option>
    <option name="status" value="relationship"> I'm in a relationship </option>
    <option name="status" value="married"> I'm married </option>
    </select><br />
    looking for: <select name="orientation">
    <option name="orientation" value="looking for a girl">a girl</option>
    <option name="orientation" value="looking for a guy">a guy</option>
    <option name="orientation" value="looking for both">both</option>
    </select> <br />
    Open to: <select name="opento">
    <option name="opento" value="friends">make some friends</option>
    <option name="opento" value="short-term relationships">short-term relationships</option>
    <option name="opento" value="long-term relationships">long-term relationships</option>
    </select> <br />
    <button id="reqinf" type="button" name="imdone" value="IM DONE!">submit</button>
    </form>
    </div>
  </body>
</html>
