<?php
    require_once "Conexao.php";
    define('DB_HOST'        , "localhost");
    define('DB_USER'        , "sa");
    define('DB_PASSWORD'    , "12345");
    define('DB_NAME'        , "TESTE");
    define('DB_DRIVER'      , "sqlsrv");

    function getData() {
        try {
            $Conexao    = Conexao::getConnection();
            $query      = $Conexao->query("SELECT TOP 1 * FROM DADOS");
            $data   = $query->fetchAll();
            echo $data[0][0];
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            case 'att':
                getData();break;
        }
    }
?>