<?php 
// ISSO É SOMENTE PARA TESTES
require_once "Conexao.php";
require_once "calcMedia.php";
session_start();
define('DB_HOST'        , "DESKTOP-9F00L48\SQLEXPRESS");
define('DB_USER'        , "sa");
define('DB_PASSWORD'    , "12345");
define('DB_NAME'        , "TESTE");
define('DB_DRIVER'      , "sqlsrv");
$num = rand(0,100);
$Conexao    = Conexao::getConnection();
$stmt = $Conexao->prepare('INSERT INTO DADOS (concentracao) VALUES(:num)');
$stmt->execute(array(
  ':num' => $num
));
//isso é pra quando a variável não estiver setada/estiver vazia
if(empty($_SESSION["hour"])||!(isset($_SESSION["hour"]))){
  $_SESSION["hour"]=date("H");
}
//ele vê se já passou uma hora, e se sim, atualiza a média
if($_SESSION["hour"]<date("H")){
  $_SESSION["hour"]=date("H");
  Medias::CalcularMedia();
}
echo $num;
?>