<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>phpWeb10</title>
</head>
<body>
  <form action="login.php" method="post">
    <label>email :</label><br/>
    <input type="text" name="email"/><br/>
    <label>password :</label><br/>
    <input type="password" name="password"/><br/>
    <label>remember me --> </label>
    <input type="checkbox" name="remember"><br/>
    <input type="submit" name="subBtn"/>
  </form>

</body>
</html>
<?php

session_start();
if(!isset($_SESSION["login"]) || $_SESSION["login"]!= "yep")
{
$_SESSION["login"] = "nope";
try{
  $bdd = new PDO("mysql:host=localhost;dbname=inscription;port=3306","root","toto2");
  echo ("connection ok<br/>");
}
catch(PDOException $e)
{
  die ("error " . $e->getMessage() . "\n");
}

if(isset($_POST["subBtn"]))
{
  $_SESSION["password"] = $_POST["password"];
  $_SESSION["email"] = $_POST["email"];

if (isset($_POST["remember"]))
{
  $params = session_get_cookie_params();
  setcookie(session_name(), $_COOKIE[session_name()], time() + 3600, $params["path"], $params["secure"],
  $params["httponly"]);
}
// else {
//   setcookie(session_name()time()-3600);
// }

  //$password = password_hash($password, PASSWORD_BCRYPT);
  //echo $password . "\n";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $connect = $bdd->prepare("SELECT name, email, password FROM inscription WHERE email= :email");
  $connect->bindparam(":email",$_SESSION["email"]);
  $connect->execute();
  $row = $connect->fetchAll(PDO::FETCH_ASSOC);
  foreach ($row as $value){
  $_SESSION["Hpass"] = $value["password"];
  $_SESSION["name"] = $value["name"];
  //echo $_SESSION["name"] . "<br/>";
  }
  if(password_verify($_SESSION["password"], $_SESSION["Hpass"]))
  {
      echo ("succesfully log!<br/>");
      $_SESSION["login"] = "yep";
      header("Location: index.php");
      //echo("yo");
      exit();
  }
  else {
    echo ("invalid email/password");
  }
}
}
elseif(isset($_SESSION["login"]) && $_SESSION["login"] == "yep")
{
  if(isset($_GET["logout"]))
{
  //echo("yo");
   unset($_SESSION["login"]);
   unset($_COOKIE[session_name()]);
   session_destroy();
   header("Location: login.php");
 }

}
?>
