<?php 
require_once "Conexao.php";
class Media{
public static function CalcularMedia(){
    $Conexao = Conexao::getConnection();
    $dados_media = $Conexao->query("SELECT avg(concentracao) FROM dados WHERE datepart(day,data_registro) = ".getdate()["mday"]);
    $media = $dados_media->fetchAll();
    //pega a concentração média por uma hora
    $chechExistsMediaDiaria = $Conexao->query("SELECT cod,concentracao FROM MEDIAS_DIARIAS where datepart(day,data_dia) = ".getdate()["mday"]);
    $medias_diarias = $chechExistsMediaDiaria->fetchAll();
    $codMediaDiaria = $medias_diarias[0][0];
    $countRows = count($medias_diarias);
    //vê se existe já uma média diária, e se não existir, ele insere para depois ir atualizando a cada hora 
    if($countRows == 0){
        $insertMediaDiaria = $Conexao->prepare("INSERT into MEDIAS_DIARIAS(concentracao) values(:media)");
        $insertMediaDiaria->execute(array(
          ':media' => $media[0][0]
        ));
    }
    //se já existir, ele atualiza a média diária com base na da última hora
    else{
        $insertMediaDiaria = $Conexao->prepare("UPDATE MEDIAS_DIARIAS set concentracao = :media where datepart(day,data_dia) = " .getdate()["mday"]);
        $insertMediaDiaria->execute(array(
         ':media' => ($medias_diarias[0][1] + $media[0][0])/2
        ));
    }
    $dados_media = $Conexao->prepare("INSERT into MEDIAS_HORARIAS (cod,concentracao) values(:cod,:con)");
    //aqui ele insere a média horária
    $dados_media->execute(array(
       ':con'=> $media[0][0],
        ':cod'=> $codMediaDiaria
    ));
    $delete_temp_data = $Conexao->prepare("DELETE FROM DADOS");
    $delete_temp_data->execute();
    //aqui ele apaga os dados temporários em "tempo real" da última hora, para não lotar o banco
    //PS:LEMBRANDO QUE NÃO É TOTALMENTE EXATO, VAI HAVER ALGUMA VARIAÇÃO, MAS NADA QUE COMPROMETA A VERACIDADE DOS DADOS
}
}
?>