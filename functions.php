<?php
session_start();

function ler_todas_cartelas(){
	$linhas = array();

	if(!isset($_SESSION['cartelas_ordem'])){
		$_SESSION['cartelas_ordem'] = array();
	}

	$arquivo = fopen('db/cartelas.csv', 'r');
	while (($linha = fgetcsv($arquivo,0, ";")) !== false)
	{

		$linha_array = array_map('trim', preg_split("/[\s,;]/", $linha[1]));

		$linha_array = array_filter($linha_array);

		$numero_cartela = array_shift($linha); 

		if(!empty($linha_array)){
			if(is_numeric($numero_cartela)){
				if(!isset($_SESSION['cartelas_ordem'][$numero_cartela])){
					$_SESSION['cartelas_ordem'][$numero_cartela] = 0;
				}

				$linhas[$numero_cartela] = array(
					"dezenas"			=>	$linha_array,
					"nome"				=>	$linha[1],
					"telefone"			=>	$linha[2],
					"email"				=>	$linha[3],
					"numero_cartela"    =>  $numero_cartela
				);
			}
		}
	}

	fclose($arquivo);

	return $linhas;
}

function sortear_cartela($ler_todas_cartelas){
	// ksort($ler_todas_cartelas);
	$ler_todas_cartela = array_rand($ler_todas_cartelas,1);

	return $ler_todas_cartela;
}

function formata_data($data){
	#yyyymmdd
	$ano = substr($data, 0, 4);
	$mes = substr($data, 4, 2);
	$dia = substr($data, 6, 2);

	return $dia."/".$mes."/".$ano;
}

function separa_em_dezenas($numero){

	$numero = somente_numero($numero);

	return str_split($numero, 2);
}

function lista_cartela_ordem(){

	if(!isset($_SESSION['cartelas_ordem'])){

		ler_todas_cartelas();
	}

	if(!is_array($_SESSION['cartelas_ordem'])){
		return false;
	}

	if(count($_SESSION['cartelas_ordem']) == 0){
		return false;
	}

	return $_SESSION['cartelas_ordem'];
}

function ler_cartela($numero_cartela){
	if($ler_todas_cartelas = ler_todas_cartelas()){
		if(isset($ler_todas_cartelas[$numero_cartela])){
			return $ler_todas_cartelas[$numero_cartela];
		}
	}

	redirect("./");

}


function ler_todas_dezenas(){
	$cartelas = ler_todas_cartelas();

	$dezenas_unicas = array();
	foreach($cartelas as $cartela){
		foreach($cartela['dezenas'] as $dezena){
			if(!in_array($dezena,$dezenas_unicas)){
				$dezenas_unicas[] = $dezena;
			}
		}
	}

	sort($dezenas_unicas);

	return $dezenas_unicas;
}

function separa_dezenas($dezenas){

	return explode(",",rtrim(chunk_split (trim($dezenas),2,','),','));

}

function numero_par($numero){
	if (! ($numero & 1 )) {
	  return true;
	} 

	return false;
}

function verifica_dezena($dezena){

	if(numero_par(strlen($dezena)) and $dezena >= 1 and $dezena <= 60){
		return true;
	}

	return false;
}

function somente_numero($str)
{
    return preg_replace("/[^0-9]/", "", $str);
}

function mensagem($mensagem = false){
	if($mensagem != false){
		$_SESSION['mensagem'] = $mensagem;
	} else {
		if(!empty($_SESSION['mensagem'])){
			$mensagem = $_SESSION['mensagem'];
			unset($_SESSION['mensagem']);
			return $mensagem;
		}
	}
}

function redirect($url){
	header("Location: ".$url);
	exit;
}

function grava_dezenas($dezenas){

	if(!isset($_SESSION['dezenas'])){
		$_SESSION['dezenas'] = array();
	}

	if(!is_array($dezenas)){
		return false;
	}

	foreach($dezenas as $dezena){

		if(!in_array($dezena,$_SESSION['dezenas'])){
			$_SESSION['dezenas'][] = $dezena;

			if(!ranquear_cartelas(array(0 => $dezena))){
				mensagem("Não foi possivel ranquear as cartelas.");
			}

		}
	}

	sort($_SESSION['dezenas']);

	return true;
	
}

function link_cartela_prev_next($numero_cartela,$ler_todas_cartelas){

	$retorno = array(
		"prev" => '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>',
		"next" => '<i class="fa fa-arrow-circle-right" aria-hidden="true"></i>'
	);

	$array_keys = array_keys($ler_todas_cartelas);
	
	$index = array_search($numero_cartela, $array_keys);


	if($index !== false){

		if(isset($array_keys[$index+1])){
			$retorno['next'] = '<a href="./cartela.php?numero_cartela='.$array_keys[$index+1].'"><i class="fa fa fa-arrow-circle-right" aria-hidden="true"></i></a>';
		} else {
			$retorno['next'] = '<i class="fa fa-arrow-circle-right" style="color:#CCC;" aria-hidden="true"></i>';
		}

		if(isset($array_keys[$index-1])){
			$retorno['prev'] = '<a href="./cartela.php?numero_cartela='.$array_keys[$index-1].'"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i></a>';
		} else {
			$retorno['prev'] = '<i class="fa fa-arrow-circle-left" aria-hidden="true"></i>';	
		}
	}

	return $retorno;
}

function ranquear_cartelas($dezenas){
	if(!is_array($dezenas)){
		return false;
	}

	if(!isset($_SESSION['cartelas_ordem'])){
		$_SESSION['cartelas_ordem'] = array();
	}

	$todas_cartelas = ler_todas_cartelas();

	foreach($todas_cartelas as $numero_cartela => $dezenas_cartela){

		foreach($dezenas_cartela['dezenas'] as $dezena_cartela){
			if(in_array($dezena_cartela,$dezenas)){
				//echo $numero_cartela; exit;
				$_SESSION['cartelas_ordem'][$numero_cartela]++;

				//echo $_SESSION['cartelas_ordem'][$numero_cartela];exit;
			}
		}
	}


	arsort($_SESSION['cartelas_ordem']);


	return true;
}

function lista_dezenas(){

	if(!isset($_SESSION['dezenas'])){
		$_SESSION['dezenas'] = array();
	}

	if(!is_array($_SESSION['dezenas'])){
		return false;
	}

	if(count($_SESSION['dezenas']) == 0){
		return false;
	}

	return $_SESSION['dezenas'];
}

function excluir_dezena($dezena){
	if(!isset($_SESSION['dezenas'])){
		$_SESSION['dezenas'] = array();
	}

	if(count($_SESSION['dezenas']) == 0){
		return false;
	}

	$dezenas = lista_dezenas();
	if (($key = array_search($dezena, $dezenas)) !== false) {
		//echo $_SESSION['dezenas']; exit;
	    unset($_SESSION['dezenas'][$key]);
	    unset($_SESSION['cartelas_ordem']);
	   	ranquear_cartelas($_SESSION['dezenas']);
		return true;
	}

	return false;
}

function excluir_lancamentos(){
	if(isset($_SESSION['dezenas'])){
		unset($_SESSION['dezenas']);
		unset($_SESSION['cartelas_ordem']);

		return true;
	}

	return false;
}

function gerar_cartelas($quantidade){

	if(@rename("db/cartelas.csv", "db/bkp_".time()."_cartelas.csv") == false){
		mensagem("O arquivo cartelas.csv está aberto em outro local. É necessário fechá-lo.");
		return false;
	}

    $arquivo = fopen('db/cartelas.csv', 'w');

	$header = array(
		"CARTELA",
		"DEZENAS",
		"NOME",
		"TELEFONE",
		"EMAIL"
	);

    fputcsv($arquivo, $header, ";"); 


	$cartelas = null;
	$n = array();
	$n_unico = array();
	# Gera os 20 números
	for ($x = 1; $x <= $quantidade; $x++) { 
		$i=1;
		while ($i <= 20) { 
			$numero = str_pad(rand(1, 60), 2, '0', STR_PAD_LEFT);
			if(!in_array($numero,$n)){
				$n[] = $numero; 
				$i++;
			}

			if(!in_array($numero,$n_unico)){
				$n_unico[] = $numero; 
			}
		}
		# Ordena os números
		sort($n);
		//array_unshift($n,$numero_cartela);
		# Exibe os números
	
		$cartela = array(
			$x,
			implode(', ', $n),
			"",
			"",
			""
		);

		 fputcsv($arquivo, $cartela, ";");

		$n = array();
	}

    fclose($arquivo);

    excluir_lancamentos();

    mensagem("Cartelas geradas com sucesso.");

    redirect("./");
}


function contar_titulos_na_posicao($lista_cartela_ordem){
	$titulos_pela_boa = array();

	if(isset($lista_cartela_ordem) and !empty($lista_cartela_ordem)){
		foreach($lista_cartela_ordem as $titulo => $ordem){

				if(!isset($titulos_pela_boa[$ordem])){
					$titulos_pela_boa[$ordem] = 0;
				}

				$titulos_pela_boa[$ordem]++;
			
		}

		return $titulos_pela_boa;
	}

	return false;
}