<?php
include("config.php");
include("functions.php");

$ler_todas_dezenas = ler_todas_dezenas();
$ler_todas_cartelas = ler_todas_cartelas();
$lista_cartela_ordem = lista_cartela_ordem();
$dezenas_chamadas = lista_dezenas();
?>

	<?php include("header.php"); ?>

	<div class="container">
	    <div class="row">
	  		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
	  			<?php include("coluna_esquerda.php"); ?>
			</div>
	  		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
	  			<div class="cartela">
		  			<h2>Todas dezenas</h2>
					<ul>
						<?php 
						foreach($ler_todas_dezenas as $dezena){	?>
							<li class="dezena <?php echo (in_array($dezena,$dezenas_chamadas)?"sorteada":false)?>" >
								<a href="excluir_incluir_dezena.php?dezena=<?php echo $dezena; ?>" title="Excluir"><?php echo $dezena; ?></a>
							</li>
						<?php } ?>
					</ul>
				</div>
	  		</div>
		</div>
	</div>

	<?php include("footer.php"); ?>