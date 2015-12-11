<?php
ini_set ( "display_errors" , "off" );
function conectar ()
{
    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "maratona";
    $conexao = mysqli_connect ( $host , $user , $password , $database );
    if ( ! $conexao )
        die( "Falha ao conectar ao banco de dados." );
    $db = mysqli_select_db ( $conexao , $database );
    if ( ! $db )
        die( "Falha ao selecionar o banco de dados." );
    return $conexao;
}
function desconectar ( $con )
{
    mysqli_close ( $con );
}
/**
 * @param $query
 * @return array - uma lista, caso o resultado da consulta gerar uma lista (select)
 * @return boolean - false se o comando sql estiver errado e true se ele estiver
 *                   certo e nao gerar lista (delete,insert,update)
 */
function query($query){
    $conn = conectar();
    $result = mysqli_query($conn,$query);
    if (is_bool($result))
        return $result;
    $lista = array();
    if ($result)
        while($linha  = mysqli_fetch_object($result) ) {
            $lista[] = $linha;
        }
    mysqli_close($conn);
    return $lista;
}
/**
 * @param $table - String, nome da tabela onde se deseja fazer a operaçao
 * @param $id - int, id do registro que se deseja excluir
 * @return boolean - invoca o metodo query, que devolve um
 *                   boolean para a operacao delete
 */
/*
function excluir($table,$id){
    $sql = "delete from $table where id = '$id'";
    return query($sql);
}
*/
/**
 * @param $table - String, nome da tabela
 * @param $fields - array, vetor com nomes dos campos da tabela
 * @param $values - array, vetor com os valores que se deseja inserir
 */
function inserir($table, $fields, $values){
    if (!is_array($fields) || !is_array($values))
        return false;
    $sql = "insert into $table (" . implode(",", $fields) . ") values";
    $sql .= "('" . implode("','", $values) . "')";
    return query($sql);
}
/**
 * @param $table - String, nome da tabela
 * @param $fields- array, vetor com os campos
 * @param $values- array, vetor com os valores
 * @param string $condicao, condição para a alteracao
 * @return boolean, true se deu certo, false se houve erros
 */
function alterar($table, $fields, $values, $condicao = ""){
    if (!is_array($fields) || !is_array($values))
        return false;
    /** estas instruções são para transformar os dois vetores em um só
    para que fique nesta forma
    "campo1" => "valor1",
    "campo2" => "valor2"                                            **/
    $sets = array_flip($fields); // esta função transforma chaves em campos e campos em chaves
    foreach($sets as $key => $campo){
        if (array_key_exists($campo,$values))
            $sets[$key] = $values[$campo];  // atribuindo à chave o valor correspondente
    }
    // observe que tambem poderiamos exigir que o parametro fosse um array na forma desejada
    $sql = "update  $table set ";
    foreach($sets as $key=>$value){
        $sql .= "$key = '$value',";
    }
    $sql = substr($sql,0,-1); // retirando a ultima virgula
    $sql .= " $condicao";
    return query($sql);
}

function excluirDificuldade($id){
    return excluir("dificuldade",$id);
}

function salvarEquipe ( $id , $nome , $tecnico )
{
    $conexao = conectar ();
    if ( ( is_null ( $id ) ) || ( $id == '' ) )
        $sql = "insert into equipe (nome,tecnico) values ('$nome','$tecnico')";
    else
        $sql = "update equipe set nome ='$nome',tecnico ='$tecnico' where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}
function salvarMembro ( $id , $nome , $equipe )
{
    $conexao = conectar ();
    if ( ( is_null ( $id ) ) || ( $id == '' ) )
        $sql = "insert into membros (nome,equipe) values ('$nome','$equipe')";
    else
        $sql = "update membros set nome ='$nome',equipe ='$equipe' where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}
function salvarAvaliacao ( $id , $avaliacao , $questao , $equipe )
{
    $hora = date ( 'Y-m-d H:i' );
    $conexao = conectar ();
    if ( ( is_null ( $id ) ) || ( $id == '' ) )
        $sql = "insert into avaliacao (hora,avaliacao,questao,equipe) values ('$hora','$avaliacao','$questao','$equipe')";
    else
        $sql = "update avaliacao set hora ='$hora',equipe ='$equipe',avaliacao ='$avaliacao',questao ='$questao' where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}
function excluirEquipe ( $id )
{
    $conexao = conectar ();
    $sql = "delete from equipe where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}
function excluirMembro ( $id )
{
    $conexao = conectar ();
    $sql = "delete from membros where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}
function listar ( $relacao )
{
    $conexao = conectar ();
    $sql = "select * from {$relacao}";
    $query = mysqli_query ( conectar () , $sql );
    while ( $obj = mysqli_fetch_object ( $query ) )
        $lista[] = $obj;
    desconectar ( $conexao );
    return $lista;
}
function getRegistro ( $relacao , $id )
{
    $conexao = conectar ();
    $sql = "select * from {$relacao} where id='{$id}'";
    $query = mysqli_query ( $conexao , $sql );
    $obj = mysqli_fetch_object ( $query );
    desconectar ( $conexao );
    return $obj;
}
function getAcertos ( $equipe )
{
    $conexao = conectar ();
    $sql = "select * from vacertos where equipe='{$equipe}'";
    $query = mysqli_query ( $conexao , $sql );
    while ( $obj = mysqli_fetch_object ( $query ) )
        $lista[] = $obj;
    desconectar ( $conexao );
    return $lista;
}
function salvarMaratona ( $id , $nome , $juiz , $datainicio , $datafim )
{
    $conexao = conectar ();
    if ( ( is_null ( $id ) ) || ( $id == '' ) )
        $sql = "insert into maratona (nome,juiz,datainicio,datafim) values ('$nome','$juiz','$datainicio','$datafim')";
    else
        $sql = "update maratona set nome ='$nome',juiz ='$juiz',datainicio ='$datainicio',datafim ='$datafim' where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}

function salvarDificuldade ( $id , $descricao , $peso , $cor )
{
    $conexao = conectar ();
    if ( ( is_null ( $id ) ) || ( $id == '' ) )
        $sql = "insert into dificuldade (descricao,peso,cor) values ('$descricao','$peso','$cor')";
    else
        $sql = "update dificuldade set descricao ='$descricao',peso ='$peso',cor = '$cor' where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}

function excluirMaratona ( $id )
{
    $conexao = conectar ();
    $sql = "delete from maratona where id = '$id'";
    if ( mysqli_query ( $conexao , $sql ) )
        $result = true;
    else
        $result = false;
    desconectar ( $conexao );
    return $result;
}

function addQuestao($id, $titulo, $problema){
    $conexao = conectar();
    if((is_null($id)) || ($id == ''))
        $sql = "insert into questao (titulo, problema) values ('$titulo', '$problema')";
    else
        $sql = "update into questao (titulo, problema) values ('$titulo', '$problema')";
    if (mysql_query($sql))

        $result = true;
    else

        $result = false;

    desconectar($conexao);

    return $result;
}


if ( isset( $_REQUEST[ "event" ] ) ) {
    try{
    switch ( $_REQUEST[ "event" ] ) {
        case 'excluirEquipe':
            $code = ( excluirEquipe ( $_REQUEST[ "id" ] ) ) ? "202" : "404";
            break;
        case 'excluirMembro':
            $code = ( excluirMembro ( $_REQUEST[ "id" ] ) ) ? "202" : "404";
            break;
        case 'excluirMaratona':
            $code = ( excluirMaratona ( $_REQUEST[ "id" ] ) ) ? "202" : "404";
            break;
        case 'salvarEquipe':
          $code = ( salvarEquipe ( $_REQUEST[ "id" ] , $_REQUEST[ "nome" ] , $_REQUEST[ "tecnico" ] ) ) ? "202" : "404";
            break;
        case 'salvarMembro':
            $code = ( salvarMembro ( $_REQUEST[ "id" ] , $_REQUEST[ "nome" ] , $_REQUEST[ "equipe" ] ) ) ? "202" : "404";
            break;
        case 'salvarAvaliacao':
            $code = ( salvarAvaliacao ( $_REQUEST[ "id" ] , $_REQUEST[ "avaliacao" ] , $_REQUEST[ "questao" ] , $_REQUEST[ "equipe" ] ) ) ? "202" : "404";
            break;
        case 'salvarMaratona':
            $code = ( salvarMaratona ( $_REQUEST[ "id" ] , $_REQUEST[ "nome" ] , $_REQUEST[ "juiz" ] , $_REQUEST[ "datainicio" ] , $_REQUEST[ "datafim" ] ) ) ? "202" : "404";
            break;
        case 'salvarDificuldade':
            $code = ( salvarDificuldade ( $_REQUEST[ "id" ] , $_REQUEST[ "descricao" ] , $_REQUEST[ "peso" ] , $_REQUEST[ "cor" ]) )? "202" : "404";
            break;
        case 'excluirDificuldade':
            $code = ( excluirDificuldade ( $_REQUEST[ "id" ]) )? "202" : "404";
            break;
        default:
            break;
    }

    header ( "Location: " . $_REQUEST[ "view" ] . "-" . $code );
    }catch(Exception $ex){
        echo $ex->getMessage();
    }
}
/*
$metodo = $_REQUEST['event'];
if ($metodo){
    $parametros = array_diff_key($_REQUEST,array("event" =>"", "view"=>""));
    $code = call_user_func_array($metodo,$parametros)?"202":"404";
    header("Location: " . $_REQUEST["view"] . "-" .$code);
}*/