<?php
    require_once "Conexao.php";
    require_once "declareSqlVar.php";
    function getData() {
        try {
            $Conexao    = Conexao::getConnection();
            $query      = $Conexao->query("SELECT TOP 1 concentracao,data_registro,id FROM DADOS order by id desc");
            $data   = $query->fetchAll(); 
            echo json_encode($data[0]);
        } catch(Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }
    function getMedias(){
        session_start();
        $Conexao = Conexao::getConnection();
        $return;
        if (isset($_SESSION["datepicker"]) && !empty($_SESSION["datepicker"])) {
            $query = $Conexao->query("SELECT concentracao,datepart(hour,data_registro) from MEDIAS_HORARIAS WHERE convert(varchar(10),data_registro,103) = '".$_SESSION["datepicker"]."' ORDER by datepart(hour,data_registro)");
            convertToArray($return,$query);        
        }
        else if(isset($_SESSION["datepickerFrom"]) && !empty($_SESSION["datepickerFrom"])){
            $query = $Conexao->query("SELECT avg(concentracao),convert(varchar(10),data_registro,103) from MEDIAS_HORARIAS where convert(smalldatetime,data_registro,103) between '".$_SESSION["datepickerFrom"]."' and '".$_SESSION["datepickerTo"]."' group by data_registro order by data_registro");
            convertToArray($return,$query);        
        }
        else if(isset($_SESSION["datepickerSemanal"]) && !empty($_SESSION["datepickerSemanal"])){
            $query = $Conexao->query("SELECT avg(concentracao),convert(varchar(10),data_registro,103) from MEDIAS_HORARIAS where datepart(week,data_registro) = datepart(week,getdate()) group by data_registro order by data_registro");
            convertToArray($return,$query);
        }
        else{
            $query = $Conexao->query("SELECT avg(concentracao),convert(varchar(10),data_registro,103) from MEDIAS_HORARIAS where month(data_registro) = month(getdate()) group by data_registro order by data_registro");
            convertToArray($return,$query);
        }
        echo json_encode($return);
}
    function convertToArray(&$return,$query){
        $dados_media = $query->fetchAll();
        try{
            for($i=0;$i<count($dados_media);$i++){
                $return[$i] = $dados_media[$i][0];
            }
        }catch(Exception $e){}
            try{
            $return[count($return)] = "end-con";
            for($i=0;$i<count($dados_media);$i++){
                if(isset($_SESSION["datepicker"])){
                    $return[count($return)] = $dados_media[$i][1].":00";
                }
                else{
                    $return[count($return)] = $dados_media[$i][1];
                }
                
            }
        }
            catch(Exception $e){}
            //o javascript não tem matriz, por isso retornei array 
    } 
    function eraseSessionVariables(){
        session_start();
        session_destroy();
    }
    function getTop5Reg(){
        $Conexao = Conexao::getConnection();
        $query = $Conexao->query("SELECT top 5 concentracao,data_registro from dados");
        $return;
        convertToArray($return,$query);
        echo json_encode($return);
    }
    if(isset($_POST['action']) && !empty($_POST['action'])) {
        $action = $_POST['action'];
        switch($action) {
            case 'att':
                getData();break;
                case 'md':
                getMedias();break;
                case 'del':
                eraseSessionVariables();break;
                case 'top5':
                getTop5Reg();break;

        }
    }
?>