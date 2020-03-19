				<?php if(is_array($lista_cartela_ordem) and count($lista_cartela_ordem) > 0) {?>
					<ul class="scroll">
						<li><a class="todas_dezenas" href="./" title="Listar todas dezenas">Todas Dezenas</a></li>
						<?php foreach($lista_cartela_ordem as $numero_cartela => $ordem){?>
							<li class="<?php echo ($ordem==19?"naboa":false)?> <?php echo ($ordem==20?"saiu":false)?>"><a href="cartela.php?numero_cartela=<?php echo $numero_cartela; ?>" title="Abrir cartela nº <?php echo $numero_cartela; ?>"><?php echo $numero_cartela. " - <b>".str_pad($ordem, 2, '0', STR_PAD_LEFT); ?></b></a></li>
						<?php } ?>
					</ul>
				<?php } else { ?>
					<div class="aviso">Nenhuma cartela cadastrada.</div>
				<?php } ?>
				<?php if($dezenas = lista_dezenas()){ ?>
					<div class="bolas_chamadas">
						<span class="bolas_chamadas"><?php echo count($dezenas)?> bola(s) lançada(s).</span>
			  			<ul class="dezenas_sorteadas">
				  			<?php foreach($dezenas as $dezena){ ?>
								<li class="dezena">
									<a href="excluir_incluir_dezena.php?dezena=<?php echo $dezena; ?>" title="Excluir dezena"><?php echo $dezena; ?></a>
								</li>
							<?php } ?>
						</ul>
					</div>
				<?php } ?>
				
				<div class="acoes">
					<a href="excluir_lancamentos.php" class="btn btn-success" title="EXCLUIR LANCAMENTOS">EXCLUIR LANCAMENTOS</a>
					<a href="gerar_cartela.php" class="btn btn-success" title="GERAR CARTELAS">GERAR CARTELAS</a>
				</div>