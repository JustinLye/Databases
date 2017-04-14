<?php

setcookie('user_id', "", time()+1);
setcookie('rest_id', "", time()+1);
setcookie('user_type', "", time()+1);
setcookie('logged_out', 1);
header('Location:../index.html');

?>