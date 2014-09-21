<?php

     $iama = $_POST ['lookinfor'];
     $fromages = $_POST ['startage'];
     $andages = $_POST ['endage'];
     $useremail = $_POST ['email'];
     $passw = $_POST ['regpass'];

     $file = fopen ('registered.txt', 'a');
     fwrite ($file, $useremail.' | '.
     $passw.' | '.$iama.' | '.$fromages.' | '.$andages."\n");
     echo header('Location: http://www.teeckle.me/temp');
     fclose ($file);
?>