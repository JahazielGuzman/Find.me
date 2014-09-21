<?php

session_start();
$from = $_SESSION['teeckle_user'];
if (!isset($_POST['to']) && !isset($_POST['group']));
$to = $_POST['to'];
$group = $_POST['group'];

// subject
$subject = 'You have been invited by '.$from.' to teeckle me';

// message
$message = '<html>
<head>
  <title>You have been invited by '.$from.'</title>
</head>
<body>
<p>You have been invited to join '.$from.'\'s group. To 
join their group you must create a teeckleme account. 
website: http://www.cabrerasantiago.com

https://www.teeckle.me/login_register.php
</p>
</body>
</html>';

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: teeckleme@gmail.com';
// Mail it
mail($to, $subject, $message, $headers);
?>
