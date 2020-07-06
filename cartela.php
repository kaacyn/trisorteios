<?php
include("config.php");
include("functions.php");

$ler_cartela = ler_cartela($_GET['numero_cartela']);
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
		  			<h2>Cartela nº <?php echo link_cartela_prev_next($_GET['numero_cartela'],$ler_todas_cartelas)['prev'];?> <?php echo str_pad($_GET['numero_cartela'], 6, '0', STR_PAD_LEFT)?> <?php echo link_cartela_prev_next($_GET['numero_cartela'],$ler_todas_cartelas)['next'];?></h2>
					<ul>
						<?php 
						if(is_array($ler_cartela['dezenas']) and count($ler_cartela['dezenas']) > 0 ){ ?>
							<?php foreach($ler_cartela['dezenas'] as $dezena){	?>
								<li class="dezena <?php echo (in_array($dezena,$dezenas_chamadas)?"sorteada":false)?>">
									<a href="excluir_incluir_dezena.php?dezena=<?php echo $dezena; ?>&back=cartela.php&numero_cartela=<?php echo $_GET['numero_cartela']?>" title="Excluir dezena"><?php echo $dezena; ?></a>
								</li>
							<?php } ?>

							<?php if($ler_cartela['telefone'] || $ler_cartela['telefone'] || $ler_cartela['email']){ ?>
								<div class="titular">
									<?php if($ler_cartela['telefone']){ ?>
										<h3><?php echo $ler_cartela['nome']?></h3>
									<?php } ?>
									<?php if($ler_cartela['telefone']){ ?>
										<span class="telefone"><?php echo $ler_cartela['telefone']?></span>
									<?php } ?>

									<?php if($ler_cartela['email']){ ?>
										<span class="e-mail"><?php echo $ler_cartela['email']?></span>
									<?php } ?>
								</div>
							<?php } ?>
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