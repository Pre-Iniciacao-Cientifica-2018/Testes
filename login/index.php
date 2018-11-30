<?php
    define('DB_HOST'        , "localhost");
    define('DB_USER'        , "sa");
    define('DB_PASSWORD'    , "12345");
    define('DB_NAME'        , "TESTE");
    define('DB_DRIVER'      , "sqlsrv");
    
    require_once "Conexao.php";
    $fez = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["usu"], $_POST["senha"]) && !empty($_POST["usu"]) && !empty($_POST["senha"])) {
            try {
                    $Conexao    = Conexao::getConnection();
                    $query      = $Conexao->query("SELECT * FROM PESSOA WHERE usu = '".$_POST["usu"]."' AND senha = '".$_POST["senha"]."'");
                    $pessoa   = $query->fetchAll();
                    if (empty($pessoa)) {
                        $fez = "Usuário ou senha incorretos";
                    }
                    else {
                        header("location: grafico.php");
                    }
            } catch(Exception $e) {
                echo $e->getMessage();
                exit;
            }
        } else {
            $fez = "Escreve aí né";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Login</title>
</head>
<body>
    <form method="post">
        <h3>Login com <b>PHP</b></h3>
        <br>
        <div class="input-field text-white">
            <input id="usuario" name="usu" type="text" autocomplete="off">
            <label for="usuario">Usuário</label>
        </div>
        <div class="input-field">
            <input id="senha" name="senha" class="text-white" type="text" autocomplete="off">
            <label for="senha">Senha</label>
        </div><br>
        <p>
        <?php 
            echo $fez;
        ?>
        </p>  
        <br>      
        <input class="btn blue lighten-1" type="submit" value="Entrar">
    </form>
    <script src="js/materialize.min.js"></script>
</body>
</html>