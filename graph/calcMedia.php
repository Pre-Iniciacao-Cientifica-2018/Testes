<?php 
require_once "Conexao.php";
class Medias{
public static function CalcularMedia(){
    $Conexao = Conexao::getConnection();
    $dados_media = $Conexao->query("SELECT avg(concentracao) FROM dados WHERE datepart(day,data_registro) = ".getdate()["mday"]);
    $media = $dados_media->fetchAll();
    //pega a concentração média por uma hora
    $dados_media = $Conexao->prepare("INSERT into MEDIAS_HORARIAS (concentracao) values(:con)");
    //aqui ele insere a média horária
    $dados_media->execute(array(
       ':con'=> $media[0][0],
    ));
    $delete_temp_data = $Conexao->prepare("DELETE FROM DADOS");
    $delete_temp_data->execute();
    //aqui ele apaga os dados temporários em "tempo real" da última hora, para não lotar o banco
    //PS:LEMBRANDO QUE NÃO É TOTALMENTE EXATO, VAI HAVER ALGUMA VARIAÇÃO, MAS NADA QUE COMPROMETA A VERACIDADE DOS DADOS
}
}

?>