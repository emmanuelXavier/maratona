<?php
ini_set("display_errors","off");
//error_reporting(E_ALL & ~E_NOTICE);
header('charset = utf-8'); 
session_name("loginUserMege");
session_start();
require_once('funcoes.php');
require_once('header.php');
$vetor = explode('-',$_GET['nav']);
$nav = $vetor[0];
$_GET['id'] =  explode(':',$vetor[count($vetor) - 1]);
$_GET['id'] = (count($_GET['id']) > 1) ? $_GET['id'] : (int) $vetor[count($vetor) - 1];
require_once("alert.php");
require_once('nav/' . ($nav !='' ? $nav : 'home') . '.php');
require_once('footer.php');
?>