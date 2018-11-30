<?php
session_start();
if($_SESSION["IsLogged"] == false && isset($_SESSION["IsLogged"])){
    header("Location: desconectar.php");
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Page Title</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<form method = "get" action = "desconectar.php">
<h5>
<?php 
echo "You are logged, ".$_SESSION['UserName']."!";
?>
</h5>
<br>
<input class="btn blue lighten-1" type="submit" value="Desconectar">
</form>
</body>
</html>