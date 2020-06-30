<?php
include("config.php");
include("functions.php");


$ler_todas_dezenas = ler_todas_dezenas();
$ler_todas_cartelas = ler_todas_cartelas();
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
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<?php 
					
							$sorteios_anteriores = ler_todos_sorteios();
							// echo "<pre>";
							// print_r($sorteios_anteriores);
							// exit;
							?>
				  			<div class="cartela">
					  			<h2>Sorteios anteriores</h2>
								<ul>
									<?php 
									foreach($sorteios_anteriores as $data=>$sorteio){
										foreach($sorteio as $numero_rodada=>$dezenas){	?>
											<h3><?php echo formata_data($data)?> - Rodada número <?php echo ($numero_rodada+1); ?></h3>
											<?php
											foreach($dezenas as $dezena){	?>
												<li class="dezena">
													<?php echo $dezena; ?>
												</li>
											<?php } ?>
										<?php } ?>
									<?php } ?>
								</ul>
							</div>

						</div>

					</div>
				</form>
	  		</div>
		</div>
	</div>

	<?php include("footer.php"); ?>