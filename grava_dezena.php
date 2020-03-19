<?php
include("functions.php");

$erros = 0;
$dezenas = somente_numero($_POST['dezenas']);
$dezenas_validadas = array();

if(strlen($dezenas) == 1){
	$dezenas = "0".$dezenas;
}

if(!empty($dezenas)){
	$dezenas_array = separa_dezenas($dezenas);

	if(is_array($dezenas_array) and count($dezenas_array) >= 0){
		foreach($dezenas_array as $dezena){
			if(verifica_dezena($dezena)){
				$dezenas_validadas[] = $dezena;
			} else {
				mensagem("A dezena <b><i>".$dezena."</i></b> é inválida.");
				$erros++;
			}
		}

	} else {
		mensagem("Não possui dezenas a serem lançadas.");
		$erros++;
	}

} else {
	mensagem("Não possui dezenas a serem lançadas.");
	$erros++;
}

if($erros == 0){
	if(grava_dezenas($dezenas_array)){
		mensagem("Dezena(s) <b>".implode(",",$dezenas_array)."</b> lançada(s) com sucesso.");
		redirect("./");
	}
} else {
	redirect("./");
}