<?php
ini_set("display_errors","off");

function conectar(){
	$host = "localhost";
	$user = "root";
	$password = "";
	$database = "maratona";

	$conexao = mysql_connect($host,$user,$password);
	if (!$conexao) 
		die("Falha ao conectar ao banco de dados.");
		

	$db = mysql_select_db($database);
	if (!$db)
		die("Falha ao selecionar o banco de dados.");	

	return $conexao;	

}

function desconectar($con){
	mysql_close($con);
}


function salvarEquipe($id,$nome,$tecnico){
	$conexao = conectar();
	if ((is_null($id)) || ($id == ''))
		$sql = "insert into equipe (nome,tecnico) values ('$nome','$tecnico')";
	else
		$sql = "update equipe set nome ='$nome',tecnico ='$tecnico' where id = '$id'";
	if (mysql_query($sql))
		echo "Operação realizada com sucesso";
	else
		echo "Falha ao salvar a equipe";

	desconectar($conexao);
}

function excluirEquipe($id){
	$conexao = conectar();
	$sql = "delete from equipe where id = '$id'";
	if (mysql_query($sql))
		echo "Operação realizada com sucesso";
	else
		echo "Falha ao salvar a equipe";
	desconectar($conexao);
}

excluirEquipe($_REQUEST["id"]);

