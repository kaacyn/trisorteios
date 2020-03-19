<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Trisorteios</title>

	<script src="js/bootstrap/js/bootstrap.min.js"></script>

	<link rel="stylesheet" href="js/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="js/bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="styles.css" rel="stylesheet">

  </head>
  <body>
	<?php $dezenas = lista_dezenas(); ?>
	<div class="geral">
		<header>
			<div class="container">
			    <div class="row">
			  		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			  			
						<h1><a href="./" title="TRISORTEIOS">TRISORTEIOS</a></h1>
						<div class="form_lancamentos">
							<form action="grava_dezena.php" method="post">
								<input name="dezenas" class="form-control dezenas" placeholder="Entre com as dezenas sorteadas" autofocus> 
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
							<div class="alert alert-warning" role="alert">
								<?php echo $mensagem; ?>
							</div>
						<?php } else {?>
						<div class="alert alert-info" role="alert">
								Bem vind(o) ao sistema de sorteios TRISORTEIOS!
						</div>
						<?php } ?>
			  		</div>
			  	</div>
			</div>
		</div>

