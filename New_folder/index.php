<?php
       session_start();
       if (isset($_SESSION['teeckle_user'])) {
            header ('Location: teeckleProfile.php'); 
            exit;
       }
?>
<!DOCTYPE html>
<html>
  <head>
    <title> teeckle.me </title>
    <link href="/cssfiles/LoginPage.css" rel="stylesheet" type="text/css" />
    <link href="/cssfiles/template.css" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="/cssfiles/jqueryui.css" type="text/css"  media="all" />
    <script src="/js_files/jquery.js" type="text/javascript">
    </script>
    <script src="/js_files/jqueryui.js">
    </script>
    <script src="/js_files/dist/jquery.validate.js" type="text/javascript">
    </script>
    <script src="/js_files/loginVal.js" type="text/javascript">
    </script>
    <script>
    $(function() {
    
         // hide the log in box and display it when the
         // user wants to log in
         $(".login").hide();

         $("#login").click(function () {
              $(".login").show();
         })
         
         // update todays date in a cariable
         // set the range for valid birthdays
         var today = new Date();
         today = today.getFullYear();
         var this_year = today - 18;
         var start = today - 100;
     
         $( "#datepicker" ).datepicker({
              changeMonth: true,
              changeYear: true,
              yearRange: start + ":" + this_year
         });
    });
  </script>
  </head>
  <body>
  
    <div class="header">
      <img src="/images/Me.png" class="logo" />
      <p class="sections">
        <span style="color:#F79521;">already a member</span> | <a id="login">log in</a>
      </p>
    </div>
    <div class="wrapper" id="wrapper">
      <p class="description">
      <span style="font-family:Pigeon; font-size:50px; color:#818486;">
        Sign Up to Teeckle
        </span><br />
        <span style="color:#225f99;">its fun and most importantly <b>FREE</b></span>
      <form action="/php_files/login.php" method="post" id="logger">
      <table class="login">  
          <tr>
          <td>
          e-mail: <input id="email" type="text" name="email" size="30"></td>
          <td>password: <input id="password" style="margin-right: 2px;" type="password" name="userpwd" maxlength="20" size="30" /> 
          </td>
          <td><input class="submit" value="Submit" type="submit" name="loggedin"><td>
        </tr>
      </table>
      </form>
      <p style="float:left;">
      <span style="font-family:Pigeon; color:#2774b8; font-size:60px; text-shadow:7px -1px 9px #B2D6F2">
     Feel free to Teeckle...
     </span>
     <br />
     <span style="font-size: 18px;color:#225f99;">
     Teeckle.Me allows you to <br /><b>meet new people, create events</b><br />
     and <b>join groups</b> who share your interests.
     </span>
      </p>
      <form method="post" id="regger">
      <table class="register">
     <th class="reghead">
      New Account 
      </th>
        <tr><td id="error"></td></tr>
        <tr>
        <td> 
        <input type="radio" style="width:50px;" name="registersex" value="Woman">Woman</input> 
        <input type="radio" style="width:50px;" name="registersex" value="Man">Man</input> 
        </td> </tr>
        <tr>
        <td>
        <input placeholder="date of birth" type="text" name="birth_data" id="datepicker">
      </td></tr>
      <tr>
      <td><input placeholder="username" type="text" name="registeruser"> </td></tr>
      <tr>
       <td>
      <input placeholder="e-mail" type="text" name="registeremail" > </td></tr> 
     <tr>
      <td>
      <input placeholder="password" type="password" name="registerpassword" > </td></tr> 
     <tr>
        <td>
      <input placeholder="confirm password" type="password" name="confpassword" > </td></tr>
      <tr>
        <td> 
      <button type="button" class="submit" value="Create Account" id="regis" name="new_account">sign up</button>
      </td>
        </tr>
      </table>
      </form>
    </div>
    <div class="footer">
      Teeckle.Me &#169; 2012 &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
      <a>About Us</a>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
      <a>Privacy</a>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;
      <a>Terms &amp; Conditions</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      <a>FAQ</a>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
      <a>Contact Us </a>
    </div>
  </body>
</html>
