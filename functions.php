<?php
session_start();

function ler_totas_cartelas(){
	$linhas = array();

	if(!isset($_SESSION['cartelas_ordem'])){
		$_SESSION['cartelas_ordem'] = array();
	}

	//Abre o Arquvio no Modo r (para leitura)
	$arquivo = fopen('db/cartelas.txt', 'r');
	while(!feof($arquivo))
	{
		//Mostra uma linha do arquivo
		$linha = fgets($arquivo, 1024);

		$linha_array = array_map('trim', explode(',',$linha));
		$numero_cartela = array_shift($linha_array); 

		if(!empty($linha_array)){
			$linhas[$numero_cartela] = $linha_array;
			
			if(!isset($_SESSION['cartelas_ordem'][$numero_cartela])){
				$_SESSION['cartelas_ordem'][$numero_cartela] = 0;
			}
		}
	}

	fclose($arquivo);

	return $linhas;
}

function lista_cartela_ordem(){

	if(!isset($_SESSION['cartelas_ordem'])){
		ler_totas_cartelas();
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

	return ler_totas_cartelas()[$numero_cartela];
}

function ler_todas_dezenas(){
	$cartelas = ler_totas_cartelas();

	$dezenas_unicas = array();
	foreach($cartelas as $cartela){
		foreach($cartela as $dezena){
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

function ranquear_cartelas($dezenas){
	if(!is_array($dezenas)){
		return false;
	}

	if(!isset($_SESSION['cartelas_ordem'])){
		$_SESSION['cartelas_ordem'] = array();
	}

	$todas_cartelas = ler_totas_cartelas();

	foreach($todas_cartelas as $numero_cartela => $dezenas_cartela){

		foreach($dezenas_cartela as $dezena_cartela){
			if(in_array($dezena_cartela,$dezenas)){

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
	$cartelas = null;
	$n = array();
	$n_unico = array();
	# Gera os 20 números
	for ($x = 1; $x <= $quantidade; $x++) { 
		$i=1;
		while ($i <= 20) { 
			$numero_cartela = str_pad($x, 6, '0', STR_PAD_LEFT);
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
		array_unshift($n,$numero_cartela);
		# Exibe os números
	
		$cartelas .= implode(', ', $n)."\n";

		$n = array();

	}

	rename("db/cartelas.txt", "db/bkp_".time()."_cartelas.txt");
    //Variável $fp armazena a conexão com o arquivo e o tipo de ação.
    $fp = fopen("db/cartelas.txt", "a+");
 
    //Escreve no arquivo aberto.
    fwrite($fp, trim($cartelas));
     
    //Fecha o arquivo.
    fclose($fp);

    excluir_lancamentos();

    mensagem("Cartelas geradas com sucesso.");

    redirect("./");
}