<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>phpWeb9</title>
  </head>
  <body>
<form action="inscription.php" method="post">
  <label>Nom : </label><br/>
  <input type="text" name="name" /><br/>
  <label>Email : </label><br/>
  <input type="email" name="email"/><br/>
  <label>Password : </label><br/>
  <input type="password" name="password"/><br/>
  <label>Password Again : </label><br/>
  <input type="password" name="password_conf"/><br/>
  <br/>
  <input type="submit" value="submit" name="subBtn" >
  <input type="reset">
</form>
  </body>
</html>
<?php
session_start();
try{
$bdd = new PDO("mysql:host=yturenne;dbname=Myuser;port=3306","root","toto2");
echo ("connection ok\n");
}
catch(PDOException $e)
{
  die ("error " . $e->getMessage() . "\n");
}
//var_dump ($_POST);
if(isset($_POST["subBtn"]))
  {//echo"ok";
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $password2 = $_POST["password_conf"];
  $temoin = true;

if(!(strlen($name)>2 && strlen($name)<11))
{
  $temoin=false;
  echo("invalid name\n");
}

if (!filter_var($email,FILTER_VALIDATE_EMAIL))
{
  $temoin=false;
  echo("invalid email\n");

}
if(!(strlen($password)>2 && strlen($password)<11))
{
  $temoin=false;
  echo("invalid password\n");

}
if($password != $password2)
{
  $temoin=false;
  echo("invalid password or password confirmation\n");
}
//$salt=rand(100,999);
$password = password_hash($password, PASSWORD_BCRYPT);

if ($temoin == true)
{
  $dat=date("y/m/d");
  echo "okidoc";
  $prepare = $bdd->prepare("INSERT INTO inscription (name, email, password,dat)VALUES(:name , :email , :password, :dat)");
  $prepare->execute(array(":name"=>$name,
   ":email"=>$email,
   ":password"=>$password,":dat"=>$dat));
   echo("bingo");
}
}
else {
  echo"nonok";
}





 ?>
