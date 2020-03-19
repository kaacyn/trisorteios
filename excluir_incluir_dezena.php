<?php
include("functions.php");

$back = "./";
if(isset($_GET['back'])){
	$back = $_GET['back']."?numero_cartela=".$_GET['numero_cartela']."&back=cartela.php";
}


if(excluir_dezena($_GET['dezena'])){
	mensagem("Dezena <b>".$_GET['dezena']."</b> excluída com sucesso.");
} else if(grava_dezenas(array($_GET['dezena']))){

	mensagem("Dezena <b>".$_GET['dezena']."</b> lançada com sucesso.");
}

redirect($back);