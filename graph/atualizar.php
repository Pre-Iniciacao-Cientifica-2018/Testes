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
            $query      = $Conexao->query("SELECT TOP 1 concentracao,data_registro FROM DADOS order by id desc");
            $data   = $query->fetchAll(); 
            echo json_encode($data[0]);
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    function getMediasDiarias(){
        //se quiserem testar, coloca dia 23 pra dar certo ou insere no banco msm
        session_start();
        $Conexao = Conexao::getConnection();
        $query = $Conexao->query("SELECT concentracao,datepart(hour,data_registro) from MEDIAS_HORARIAS WHERE convert(varchar(10),data_registro,103) = '".$_SESSION["datepicker"]."' ORDER by datepart(hour,data_registro)");
        $dados_media = $query->fetchAll();
        $return;
        try{
        for($i=0;$i<count($dados_media);$i++){
            $return[$i] = $dados_media[$i][0];
        }
    }catch(Exception $e){}
        try{
        $return[count($return)] = "end-con";
        for($i=0;$i<count($dados_media);$i++){
            $return[count($return)] = $dados_media[$i][1].":00";
        }
    }
        catch(Exception $e){}
        echo json_encode($return);
        //o javascript não tem matriz, por isso retornei array msm
}

    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            case 'att':
                getData();break;
                case 'md':
                getMediasDiarias();break;

        }
    }
?>