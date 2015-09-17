<?php
/*
	This file is part of MapleRoad
	Copyright (C) 2015 João Gusmão
	
	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

	require_once("./inc/config.php");
	require_once("./inc/classes/class.equip.php");
	require_once("./inc/classes/class.mob.php");
	require_once("./inc/classes/class.quest.php");
	require_once("./inc/classes/class.searchEngine.php");
	
	
	try {
		$equipInstance = new equip($_GET["url"],"name,url,itemid,descr,tuc,only,tradeBlock,notSale,tradeAvailable,equipTradeBlock,expireOnLogout,quest,price,reqJob,reqLevel,reqSTR,reqDEX,reqINT,reqLUK,reqPOP,incSTR,incDEX,incINT,incLUK,incMMP,incMHP,incPAD, incMAD, incPDD, incMDD, incEVA, incACC, incSpeed, incJump");
		$noError = true;
	} catch(Exception $e) {
		$noError = false;
	}
	
	$searchEngine = new searchEngine;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php if(isset($equipInstance)) { echo $equipInstance->getName(); } else { echo "Item não encontrado"; } ?> - Equipamentos | MapleRoad</title>
	<?php require_once("./inc/website_includes/common-head-includes.php"); ?>
  </head>
  
  <body>
	  <div id="fb-root"></div>
		<script>(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.0";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<?php require_once("./inc/website_includes/header.php"); ?>
		
		<div class="container site-container">
			<?php require_once("./inc/website_includes/sidebar-menu.php"); ?>
			<div class="col-md-8" style="margin-top: 15px">
				
				<?php
					if($noError) {
						
				  ?>
				<ol class="breadcrumb">
				  <li><a href="#">Database</a></li>
				  <li><a href="#">Equipamentos</a></li>
				  <li class="active"><?php echo $equipInstance->getName(); ?></li>
				</ol>
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
										if($equipInstance->getReqJob() == "11") echo "Guerreiro, Arqueiro e Gatuno";
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
												$mob = new mob($drop["mobid"],"",$drop);
												if($pos == count($dropperList)) echo '<a href="'.$mob->getSingleLink().'" class="monster_link" attr-url="'.$mob->getUrl().'">'.$mob->getName().'</a> ';
												else echo '<a href="'.$mob->getSingleLink().'" class="monster_link" attr-url="'.$mob->getUrl().'" href="#">'.$mob->getName().'</a>, ';
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
							<td class="single_item-dropperList" colspan="5">
								<strong>Obtido através da missão: </strong>
									<?php
										$questList = $searchEngine->getWhereItemIsReward($equipInstance->getItemId());
										if(!empty($questList)) {
											$pos = 1;
											foreach($questList as $quest) {
												$quest = new quest($quest["questid"]);
												if($pos == count($questList)) echo '<a href="'.$quest->getSingleLink().'" >'.$quest->getName().'</a> ';
												else echo '<a href="'.$quest->getSingleLink().'">'.$quest->getName().'</a>, ';
												$pos++;
											}
										} else {
											echo " Nenhuma Missão";
										}
									?>
							</td>
						</tr>
					</table>
					<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" data-numposts="15" data-colorscheme="light" data-width="100%"></div>
				<?php } else { ?>
					<h1>Item não encontrado</h1>
				<?php } ?>
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