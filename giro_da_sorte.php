<?php
include("config.php");
include("functions.php");


$ler_todas_dezenas = ler_todas_dezenas();
$ler_todas_cartelas = ler_todas_cartelas();
$lista_cartela_ordem = lista_cartela_ordem();
$dezenas_chamadas = lista_dezenas();

if(isset($_POST['sortear_cartela'])){
	$cartela = sortear_cartela($ler_todas_cartelas);

	$ler_cartela = ler_cartela($cartela);
	$json = htmlspecialchars(json_encode(separa_em_dezenas(str_pad($cartela, 6, '0', STR_PAD_LEFT))));
}


	include("header.php"); ?>

	<div class="container">
	    <div class="row">
	  		<div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
				<?php include("coluna_esquerda.php"); ?>
			</div>
	  		<div class="col-xs-9 col-sm-9 col-md-9 col-lg-9">
				<form method="post">
					<div class="row">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<div class="cartela">
								<form action="" method="post">

									<h2>Giro da sorte</h2>
									<div class="giro-da-sorte">

										<div class="display" id="cartela-premiada" data-numero-cartela="<?php echo $json; ?>" data-numero-start="<?php echo (isset($_POST['sortear_cartela'])?"on":"off")?>">
											<div class="output" id="output0">-</div>
											<div class="output" id="output1">-</div>
											<div class="output" id="output2">-</div>
										</div>

										<div class="">
											<input class="btn btn-success" name="sortear_cartela" type="submit" value="SORTEAR CARTELA">
										</div>
										<?php if(isset($ler_cartela) and is_array($ler_cartela)){?>
											<?php if($ler_cartela['telefone'] || $ler_cartela['telefone'] || $ler_cartela['email']){ ?>
												<div id="titular" class="titular" style="display: none;">
													<?php if($ler_cartela['telefone']){ ?>
														<h3><?php echo str_pad($cartela, 6, '0', STR_PAD_LEFT);?> - <?php echo $ler_cartela['nome']?></h3>
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
									</div>
								</form>
							</div>
						</div>
					</div>
				</form>
	  		</div>
		</div>
	</div>

	<?php include("footer.php"); ?>