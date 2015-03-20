<!DOCTYPE html>

<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.equip.php");
	require_once("./inc/classes/class.mob.php");
	require_once("./inc/classes/class.searchEngine.php");
	
	$searchEngine = new searchEngine;
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>MapleRoad - Layout demo</title>
	<?php require_once("./inc/website_includes/common-head-includes.php"); ?>
  </head>
  
  <body>
		<?php require_once("./inc/website_includes/header.php"); ?>
		
		<div class="container site-container">
			<?php require_once("./inc/website_includes/sidebar-menu.php"); ?>
			<div class="col-md-8" style="margin-top: 15px">
				<?php
					if(isset($_GET["type"])) $queryType = $_GET["type"];
					else $queryType = "";
					
					if(isset($_GET["sub"])) $queryType = $_GET["sub"];
					else $sub = "";
					
					if(isset($_GET["job"])) $queryJob = $_GET["job"];
					else $queryJob = "";
					
					switch ($queryType) {
						case "brincos":
							$bread = "Brincos";
							$query = "islot like '%Ae%' and cash=0";
							break;
						case "acessorios_para_face":
							$bread = "Acessórios Para Face";
							$query = "islot like '%Af%' and cash=0";
							break;
						case "acessorios_para_olho":
							$bread = "Acessórios Para Olho";
							$query = "islot like '%Ay%' and cash=0";
							break;
						case "cintos":
							$bread = "Cintos";
							$query = "islot like '%Be%' and cash=0";
							break;
						case "medalhas":
							$bread = "Medalhas";
							$query = "islot like '%Me%' and cash=0";
							break;
						case "pingentes":
							$bread = "Pingentes";
							$query = "islot like '%Pe%' and cash=0";
							break;
						case "aneis":
							$bread = "Anéis";
							$query = "islot like '%Ri%' and cash=0";
							break;
						//Fim Acessórios
						//Começo Vestimento
						case "chapeus":
							$bread = "Chapéus";
							$query = "islot like '%Cp%' and cash=0";
							break;
						case "luvas":
							$bread = "Luvas";
							$query = "islot like '%Gv%' and cash=0";
							break;
						case "casacos":
							$bread = "Casacos";
							$query = "islot='Ma' and cash=0";
							break;
						case "macacoes":
							$bread = "Macacões";
							$query = "islot like '%MaPn%' and cash=0";
							break;
						case "calcas":
							$bread = "Calças";
							$query = "islot = 'Pn' and cash=0";
							break;
						case "escudos":
							$bread = "Escudos";
							$query = "islot = 'Si' and cash=0";
							break;
						case "sapatos":
							$bread = "Sapatos";
							$query = "islot = 'So' and cash=0";
							break;
						case "capas":
							$bread = "Capas";
							$query = "islot = 'Sr' and cash=0";
							break;
						case "montarias":
							$bread = "Montarias";
							$query = "islot = 'Tm' and cash=0";
							break;
						case "selas":
							$bread = "Selas";
							$query = "islot = 'Sd' and cash=0";
							break;
						//Fim Vestimento
						case "espadas_de_uma_mao":
							$bread = "Espadas de Uma Mão";
							$query = "(itemId / 10000) % 100 like '30.%'";
							break;
						case "espadas_de_duas_maos":
							$bread = "Espadas de Duas Mãos";
							$query = "(itemId / 10000) % 100 like '40.%'";
							break;
						case "machados_de_uma_mao":
							$bread = "Machados de Uma Mão";
							$query = "(itemId / 10000) % 100 like '31.%'";
							break;
						case "machados_de_duas_maos":
							$bread = "Machados de Duas Mãos";
							$query = "(itemId / 10000) % 100 like '41.%'";
							break;
						case "macas_de_uma_mao":
							$bread = "Maças de Uma Mão";
							$query = "(itemId / 10000) % 100 like '32.%'";
							break;
						case "macas_de_duas_maos":
							$bread = "Maças de Duas Mãos";
							$query = "(itemId / 10000) % 100 like '42.%'";
							break;
						case "lancas":
							$bread = "Lanças";
							$query = "(itemId / 10000) % 100 like '43.%'";
							break;
						case "lancas_de_batalha":
							$bread = "Lança de Batalha";
							$query = "(itemId / 10000) % 100 like '44.%'";
							break;
						case "arcos":
							$bread = "Arcos";
							$query = "(itemId / 10000) % 100 like '45.%'";
							break;
						case "bestas":
							$bread = "Bestas";
							$query = "(itemId / 10000) % 100 like '46.%'";
							break;
						case "varinhas":
							$bread = "Varinhas";
							$query = "(itemId / 10000) % 100 like '37.%'";
							break;
						case "cajados":
							$bread = "Cajados";
							$query = "(itemId / 10000) % 100 like '38.%'";
							break;
						case "garras":
							$bread = "Garras";
							$query = "(itemId / 10000) % 100 like '47.%'";
							break;
						case "adagas":
							$bread = "Adagas";
							$query = "(itemId / 10000) % 100 like '33.%'";
							break;
						case "armas":
							$bread = "Armas";
							$query = "(itemId / 10000) % 100 like '49.%'";
							break;
						case "soqueiras":
							$bread = "Soqueiras";
							$query = "(itemId / 10000) % 100 like '48.%'";
							break;
						default:
							$bread = "Todos";
							$query = "1=1";
							break;
					}
					$queryWithoutJob = $query;
					if($queryJob != "") $query.= $searchEngine->getQueryReqJob($queryJob);
					
					//Pagination
					if(isset($_GET["page"])) {
						if(is_numeric($_GET["page"])) $page = $_GET["page"];
						else $page = 1;
					} else {
						$page = 1;
					}
					$perPage = 10;
					
					?>
					<ol class="breadcrumb">
					  <li><a href="<?php echo LOCAL_PATH; ?>">Database</a></li>
					  <li><a href="<?php echo LOCAL_PATH; ?>equipamentos/geral">Equipmentos</a></li>
					  <li class="active"><?php echo $bread; ?></li>
					</ol>
					<?php
						$reqJobs = $searchEngine->getAllJobsForEquip($queryWithoutJob);
						$jobs = Array();
						foreach($reqJobs as $job) {
							switch ($job[0]) {
								case "0":
									if(!in_array("Comum", $jobs)) array_push($jobs,"Comum");
									break;
								case "1":
									if(!in_array("Guerreiro", $jobs)) array_push($jobs,"Guerreiro");
									break;
								case "2":
									if(!in_array("Mago", $jobs)) array_push($jobs,"Mago");
									break;
								case "3":
									if(!in_array("Guerreiro", $jobs)) array_push($jobs,"Guerreiro");
									if(!in_array("Mago", $jobs)) array_push($jobs,"Mago");
									break;
								case "4":
									if(!in_array("Arqueiro", $jobs)) array_push($jobs,"Arqueiro");
									break;
								case "5":
									if(!in_array("Guerreiro", $jobs)) array_push($jobs,"Guerreiro");
									if(!in_array("Arqueiro", $jobs)) array_push($jobs,"Arqueiro");
									break;
								case "8":
									if(!in_array("Gatuno", $jobs)) array_push($jobs,"Gatuno");
									break;
								case "9":
									if(!in_array("Guerreiro", $jobs)) array_push($jobs,"Guerreiro");
									if(!in_array("Gatuno", $jobs)) array_push($jobs,"Gatuno");
									break;
								case "10":
									if(!in_array("Mago", $jobs)) array_push($jobs,"Mago");
									if(!in_array("Gatuno", $jobs)) array_push($jobs,"Gatuno");
									break;
								case "13":
									if(!in_array("Guerreiro", $jobs)) array_push($jobs,"Guerreiro");
									if(!in_array("Arqueiro", $jobs)) array_push($jobs,"Arqueiro");
									if(!in_array("Gatuno", $jobs)) array_push($jobs,"Gatuno");
									break;
								case "16":
									if(!in_array("Pirata", $jobs)) array_push($jobs,"Pirata");
									break;
							}
						}
						
						if(count($jobs) > 1) {
							echo "<table class='table table-bordered'>";
							echo "<tr>";
							echo "<td><a href='".LOCAL_PATH."list/equipamentos/".$queryType."/1'>Todos</a></td>";
							foreach($jobs as $job) {
								echo "<td><a href='".LOCAL_PATH."list/equipamentos/".$queryType."/".strtolower($job)."/1'>".$job."</a></td>";
							}
							echo "</tr>";
							echo "</table>";
						}
					
					
					
					try {
					$equips = $searchEngine->getEquipsLimited($query, $page-1,$perPage);
					$resultCount = $equips[0]["resultCount"];
					foreach($equips as $equip) {
						$equipInstance = new Equip($equip["itemid"],"",$equip); 
					?>
						<table class="table table-bordered result_item">
						  <tr>
							<td class="table_image-item"><img src="<?php echo $equipInstance->getCachedIcon(); ?>" /></td>
							<td colspan="2"><a href="<?php echo $equipInstance->getSingleLink(); ?>"><?php if($equipInstance->getName() != "") { echo $equipInstance->getName(); } else { echo "Nome Indisponível"; } ?></a></td>
							<td><strong>Nível Mínimo:</strong> <?php echo $equipInstance->getReqLevel(); ?></td>
							<td class="table_rightinfo-item"><strong>Vendido Por:</strong> <?php echo $equipInstance->getPrice(); ?> Mesos</td>
						  </tr>
						  <?php if($equipInstance->getDescr() != "") { ?>
							<tr>
								<td colspan="5"><strong>Descrição: </strong><?php 
									$descr = $equipInstance->getDescr(); 
									$finalString = "";
									$descr = str_replace("\\r\\n","<br />",$descr);
									$descr = str_replace("\\n","<br />",$descr);
									preg_match('~#c(.*?)#~', $descr, $output);
									if(isset($output[1])) {
										$finalString = str_replace("#c".$output[1]."#","",$descr);
										$finalString .= "<span class='string_c'> ".$output[1]."</span>";
									} else {
										$finalString = $descr;
									}
									echo $finalString;
									?>
								</td>
							</tr>
							<?php } ?>
							<tr>
								<?php 
								$requisitos = Array();
								if($equipInstance->getReqSTR() != 0) array_push($requisitos, Array("FOR",$equipInstance->getReqSTR()) );
								if($equipInstance->getReqDEX() != 0) array_push($requisitos, Array("DES",$equipInstance->getReqDEX()) );
								if($equipInstance->getReqINT() != 0) array_push($requisitos, Array("INT",$equipInstance->getReqINT()) );
								if($equipInstance->getReqLUK() != 0) array_push($requisitos, Array("SOR",$equipInstance->getReqLUK()) );
								if($equipInstance->getReqPOP() != 0) array_push($requisitos, Array("FAMA",$equipInstance->getReqPOP()) );
								
								$atributos = Array();
								if($equipInstance->getIncSTR() != 0) array_push($atributos, Array("FOR",$equipInstance->getIncSTR()) );
								if($equipInstance->getIncDEX() != 0) array_push($atributos, Array("DES",$equipInstance->getIncDEX()) );
								if($equipInstance->getIncINT() != 0) array_push($atributos, Array("INT",$equipInstance->getIncINT()) );
								if($equipInstance->getIncLUK() != 0) array_push($atributos, Array("SOR",$equipInstance->getIncLUK()) );
								if($equipInstance->getIncMHP() != 0) array_push($atributos, Array("HP",$equipInstance->getIncMHP()) );
								if($equipInstance->getIncMMP() != 0) array_push($atributos, Array("MP",$equipInstance->getIncMMP()) );
								
								$efeitos = Array();
								if($equipInstance->getIncPAD() != 0) array_push($efeitos, Array("Atq. Arma",$equipInstance->getIncPAD()) );
								if($equipInstance->getIncMAD() != 0) array_push($efeitos, Array("Atq. Mágica",$equipInstance->getIncMAD()) );
								if($equipInstance->getIncPDD() != 0) array_push($efeitos, Array("Def. Arma",$equipInstance->getIncPDD()) );
								if($equipInstance->getIncMDD() != 0) array_push($efeitos, Array("Def. Mágica",$equipInstance->getIncMDD()) );
								if($equipInstance->getIncEVA() != 0) array_push($efeitos, Array("Esquiva",$equipInstance->getIncEVA()) );
								if($equipInstance->getIncACC() != 0) array_push($efeitos, Array("Precisão",$equipInstance->getIncACC()) );
								if($equipInstance->getIncSpeed() != 0) array_push($efeitos, Array("Velocidade",$equipInstance->getIncSpeed()) );
								if($equipInstance->getIncJump() != 0) array_push($efeitos, Array("Pular",$equipInstance->getIncJump()) );
							?>
								<td colspan="5" style="font-size: 12px">
									<p><strong>Classe: </strong>
										<?php
											if($equipInstance->getReqJob() == "0") echo "Todas";
											if($equipInstance->getReqJob() == "1") echo "Guerreiro";
											if($equipInstance->getReqJob() == "2") echo "Mago";
											if($equipInstance->getReqJob() == "3") echo "Guerreiro e Mago";
											if($equipInstance->getReqJob() == "4") echo "Arqueiro";
											if($equipInstance->getReqJob() == "5") echo "Guerreiro e Arqueiro";
											if($equipInstance->getReqJob() == "8") echo "Gatuno";
											if($equipInstance->getReqJob() == "9") echo "Gurreiro e Gatuno";
											if($equipInstance->getReqJob() == "10") echo "Mago e Gatuno";
											if($equipInstance->getReqJob() == "13") echo "Guerreiro, Arqueiro e Gatuno";
											if($equipInstance->getReqJob() == "16") echo "Pirata";
										?>
									</p>
									<?php if(!empty($requisitos)) { ?>
										<p><strong>Requisitos: </strong>
											<?php for($i=0; $i<count($requisitos);$i++) {
												$stringFinal = "";
												if($i == count($requisitos)-1) {
													$stringFinal .= $requisitos[$i][0].": ".$requisitos[$i][1].". ";
												} else {
													$stringFinal .= $requisitos[$i][0].": ".$requisitos[$i][1].", ";
												}
												echo $stringFinal;
											}
											?>
										</p>
									<?php } ?>
									<?php if(!empty($atributos)) { ?>
										<p><strong>Atributos: </strong>
											<?php for($i=0; $i<count($atributos);$i++) {
												$stringFinal = "";
												if($i == count($atributos)-1) {
													$stringFinal .= $atributos[$i][0]." +".$atributos[$i][1].". ";
												} else {
													$stringFinal .= $atributos[$i][0]." +".$atributos[$i][1].", ";
												}
												echo $stringFinal;
											}
											?>
										</p>
									<?php } ?>
									<?php if(!empty($efeitos)) { ?>
										<p><strong>Efeitos: </strong>
											<?php for($i=0; $i<count($efeitos);$i++) {
												$stringFinal = "";
												if($i == count($efeitos)-1) {
													$stringFinal .= $efeitos[$i][0]."+ ".$efeitos[$i][1].". ";
												} else {
													$stringFinal .= $efeitos[$i][0]."+ ".$efeitos[$i][1].", ";
												}
												echo $stringFinal;
											}
											?>
										</p>
									<?php } ?>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<strong>Dropado Por: </strong>
										<?php
											$dropperList = $searchEngine->getDropListByItemId($equipInstance->getItemId());
											if(!empty($dropperList)) {
												$pos = 1;
												foreach($dropperList as $drop) {
													if($pos <= 10) {
														$mob = new mob($drop["mobid"],"",$drop);
														if($pos == count($dropperList)) echo '<a href="'.$mob->getSingleLink().'" class="monster_link" attr-url="'.$mob->getUrl().'">'.$mob->getName().'</a> ';
														else echo '<a href="'.$mob->getSingleLink().'" class="monster_link" attr-url="'.$mob->getUrl().'" href="#">'.$mob->getName().'</a>, ';
													} else {
														echo '<a href="'.$equipInstance->getSingleLink().'">(...)</a>';
														break;
													}
													$pos++;
												}
											} else {
												echo " Nenhum Monstro";
											}
											
										?>
								</td>
							</tr>
							<tr>
								<td colspan="5">
									<strong>Observações: </strong>
									<ul>
										<?php if($equipInstance->getTuc() == 0) { echo '<li>Este item não pode ser atualizado</li>'; } else { echo '<li>Número de atualizações disponíveis: '.$equipInstance->getTuc().'</li>'; } ?>
										<?php if($equipInstance->getOnly() != 0) { echo '<li>Você pode só pode ter uma unidade deste item no inventário</li>'; } ?>
										<?php if($equipInstance->getTradeBlock() != 0 || $equipInstance->getNotSale() != 0 || $equipInstance->getTradeAvailable() != 0 ) { echo '<li>Este item não pode ser trocado</li>'; } ?>
										<?php if($equipInstance->getEquipTradeBlock() != 0) { echo '<li>A troca é desativado quando o item é equipado</li>'; } ?>
										<?php if($equipInstance->getExpireOnLogout() != 0) { echo '<li>Este item desaparece ao sair do jogo</li>'; } ?>
										<?php if($equipInstance->getQuest() != 0) { echo '<li>Item de Missão</li>'; } ?>
									</ul>
								</td>
							</tr>
							<tr>
								<td colspan="5"><a href="<?php echo $equipInstance->getSingleLink(); ?>" style="font-size: 13px">Ver Tudo Sobre Este Item</a></td>
							</tr>
						</table>
					<?php
					}
					$showing = count($equips);
					$numOfPages = ceil( $resultCount/$perPage );
					$nextPage = $page+1;
					$prevPage = $page-1;
					$link = $_SERVER["REQUEST_URI"]."/";
					if(isset($_GET["page"])) {
						if($_GET["page"] > 0) $link = "";
						else $link = $_SERVER["REQUEST_URI"];
					}
				?>
				<span>Página <span style="color: #337ab7"><?php echo $page; ?></span> de <span style="color: #337ab7"><?php echo $numOfPages; ?></span>. <span style="color: #337ab7"><?php echo $resultCount; ?></span> Resultados</span>
				<nav class="pull-right">
				  <ul class="pagination">
					  <?php if($page > 1) { ?>
					<li>
					  <a href="<?php echo $link.$prevPage; ?>" aria-label="Previous">
						<span aria-hidden="true">&laquo; Anterior</span>
					  </a>
					</li>
					  <?php } ?>
					 <?php if($page < $numOfPages) { ?>
					<li>
					  <a href="<?php echo $link.$nextPage; ?>" aria-label="Next">
						<span aria-hidden="true">Próxima &raquo;</span>
					  </a>
					</li>
					<?php } ?>
				  </ul>
				</nav>
				<?php } catch(Exception $e) {
					echo "<h1>Nada encontrado</h1>";
				}
				?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
<div class="monster_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>

<script type="text/javascript">
	var actived = false;
	$(document).ready(function(){
		$(".monster_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/monster_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
				if(actived == true) {
					$( ".monster_hover" ).html( data );
					$( ".monster_hover" ).stop().fadeIn(100);
				}
			});
		});
		$(".monster_link").mouseout( function() {
			actived=false;
			$( ".monster_hover" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.monster_hover').css({
		   left:  e.pageX+10,
		   top:   e.pageY+10
		});
	});
</script>
</html>