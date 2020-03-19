<?php
include("functions.php");


if(excluir_lancamentos()){
	mensagem("Dezena <b>".$_GET['dezena']."</b> excluída com sucesso.");
}

redirect("./");