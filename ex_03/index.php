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
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>phpWeb10Index</title>
  </head>
  <body>

    <form action="index.php" method="post">
   <input type="submit" name="logout" value="logout"></a>
 </form>
  </body>
</html>
<?php
if(isset($_POST["logout"]))
{
  //echo("yo");
  unset($_SESSION);
  session_destroy();
  header("Location: login.php");
}
 ?>
