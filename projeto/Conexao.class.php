<?php

abstract class Conexao{
    private static $host = "localhost";
    private static $user = "root";
    private static $password = "";
    private static $database = "maratona";
    private static $conexao;


    private static function conectar ()
    {
        Conexao::$conexao = mysqli_connect ( Conexao::$host , Conexao::$user , Conexao::$password , Conexao::$database);
        if (! Conexao::$conexao )
            die( "Falha ao conectar ao banco de dados." );
        $db = mysqli_select_db ( Conexao::$conexao , Conexao::$database );
        if ( ! $db )
            die( "Falha ao selecionar o banco de dados." );
    }

    public static function desconectar ()
    {
        mysqli_close (Conexao::$conexao);
    }

    public static function getConexao(){
        Conexao::conectar();
        return Conexao::$conexao;
    }
}