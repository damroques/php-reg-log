<?php
//include_once("login.php");
session_start();
if($_SESSION["login"] == "yep")
{
  echo ("Hello: " . $_SESSION["name"] . "!\n");
}
else {
  header("Location: login.php");
}
?>
<br/><a href="login.php?logout=true">Logout<a/>
