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

if ( isset( $_REQUEST[ "event" ] ) ) {
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
		default:
			break;
	}

	header ( "Location: " . $_REQUEST[ "view" ] . "-" . $code );

}


