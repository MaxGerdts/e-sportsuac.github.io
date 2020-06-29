<?php
include('config.php');
$session_uid='';
$_SESSION['uid']='';
if(empty($session_uid) && empty($_SESSION['uid']))
{
  session_destroy();
  echo '<meta http-equiv="refresh" content="1; url=../index.php">';
//echo "";
}
 ?>
