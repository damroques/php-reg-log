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
//echo ("Hello: " . $_SESSION["name"] . "!\n");
 ?>
