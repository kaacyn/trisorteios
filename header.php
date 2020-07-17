<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Trisorteios</title>

	<script src="assets/js/bootstrap/js/bootstrap.min.js"></script>
	<script src="assets/js/jquery-3.1.1.min.js"></script>
	<script src="assets/js/jquery-migrate-3.0.0.min.js"></script>
	<script src="assets/js/scripts.js"></script>
	<link rel="stylesheet" href="assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/js/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="assets/css/styles.css" rel="stylesheet">

  </head>
  <body>

	<div class="geral">
		<header>
			<div class="container">
			    <div class="row">
			  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  			
						<h1><a href="./" title="TRISORTEIOS">TRISORTEIOS</a></h1>
						<div class="form_lancamentos">
							<form action="grava_dezena.php" method="post">
								<input name="dezenas" class="form-control dezenas" placeholder="Entre com as dezenas sorteadas" autofocus> 
								<input name="back" type="hidden" value="<?php echo $_SERVER['REQUEST_URI']?>">
								<input class="btn btn-success" type="submit" value="LANÇAR">
							</form>
						</div>
			  		</div>
			  	</div>
			</div>
		</header>

		<div class="mensagem"> 
			<div class="container">
			    <div class="row">
			  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  			<?php if($mensagem = mensagem()){ ?>
							<div class="alert alert-secondary" role="alert">
								<?php echo $mensagem; ?>
							</div>
						<?php } else {?>
						<div class="alert alert-secondary" role="alert">
								Bem vind(o) ao sistema de sorteios TRISORTEIOS!
						</div>
						<?php } ?>
			  		</div>
			  	</div>
			</div>
		</div>
		
		<?php if(SANDRINHA_MACIEL == true){ ?>
			<?php 
				$contar_titulos_na_posicao = contar_titulos_na_posicao($lista_cartela_ordem);

				if((isset($contar_titulos_na_posicao[19]) and $contar_titulos_na_posicao[19] >= 1) or (isset($contar_titulos_na_posicao[20]) and $contar_titulos_na_posicao[20] >= 1)){	?>
					<div class="sandrinha_maciel"> 
						<div class="container">
						    <div class="row">
						  		<div class="col-xs-2 col-sm-2 col-md-2 col-lg-2">
						  			<div class="imagem_sandra">	
						  				<img src="assets/images/sandrinha_maciel.png" class="img-responsive" alt="sandra maciel">
						  			</div>
						  		</div>
						  		<div class="col-xs-10 col-sm-10 col-md-10 col-lg-10">
						  			
									<div class="balao2">

										<?php if(isset($contar_titulos_na_posicao[20]) and $contar_titulos_na_posicao[20]>=1){ ?>
											
											<span class="dialogo_sandrinha_maciel">SAAAAIIIIIIIIIIIU! PARABÉNS!!!</span>
										<?php } else if(isset($contar_titulos_na_posicao[19]) and $contar_titulos_na_posicao[19] >=1){ ?>
											<span class="dialogo_sandrinha_maciel">São <?php echo count($dezenas_chamadas)?> bolas chamadas e <?php echo $contar_titulos_na_posicao[19]; ?> título pela boa.</span> 

										<?php }?>

										
									</div>

						  		</div>
						  	</div>
						</div>
					</div>
				<?php } ?>
		<?php } ?> 