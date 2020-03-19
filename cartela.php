<?php
include("functions.php");

$ler_cartela = ler_cartela($_GET['numero_cartela']);
$ler_totas_cartelas = ler_totas_cartelas();
$lista_cartela_ordem = lista_cartela_ordem();
?>
<?php include("header.php"); ?>

	<div class="container">
	    <div class="row">
	  		<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
	  			<?php include("coluna_esquerda.php"); ?>
			</div>
	  		<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
	  			<div class="cartela">
		  			<h2>Cartela nº <?php echo $_GET['numero_cartela']?></h2>
					<ul>
						<?php 
						foreach($ler_cartela as $dezena){	?>
							<li class="dezena <?php echo (in_array($dezena,$dezenas)?"sorteada":false)?>">
								<a href="excluir_incluir_dezena.php?dezena=<?php echo $dezena; ?>&back=cartela.php&numero_cartela=<?php echo $_GET['numero_cartela']?>" title="Excluir dezena"><?php echo $dezena; ?></a>
							</li>
						<?php } ?>
					</ul>
				</div>
				<div class="btn_voltar">
					<a href="./" class="btn btn-success" title="VOLTAR">VOLTAR</a>
				</div>
	  		</div>
		</div>
	</div>
	<?php include("footer.php"); ?>