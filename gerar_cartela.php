<?php
include("config.php");
include("functions.php");


$ler_todas_dezenas = ler_todas_dezenas();
$ler_totas_cartelas = ler_totas_cartelas();
$lista_cartela_ordem = lista_cartela_ordem();
$dezenas_chamadas = lista_dezenas();

if(isset($_POST['quantidade'])){
	gerar_cartelas($_POST['quantidade']);
}

?>
	
	<?php include("header.php"); ?>

	<div class="container">
	    <div class="row">
	  		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<?php include("coluna_esquerda.php"); ?>
			</div>
	  		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<form method="post">
					<div class="row">
						<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
							<input type="number" name="quantidade" min="1" max="999" required="" placeholder="Números de cartelas de 1 a 99999" class="form-control">
						</div>
						<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
							<input class="form-control btn btn-success" type="submit" value="Gerar">
						</div>
					</div>
				</form>
	  		</div>
		</div>
	</div>

	<?php include("footer.php"); ?>