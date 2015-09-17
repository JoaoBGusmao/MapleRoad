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
	require_once("./inc/classes/class.item.php");
	require_once("./inc/classes/class.mob.php");
	require_once("./inc/classes/class.searchEngine.php");
	
	$searchEngine = new searchEngine;
?>
<!DOCTYPE html>
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
					
					switch ($queryType) {
						case "pocoes":
							$bread = "Poções";
							$query = "hp >0 or mp > 0 or hpR>0 or mpR>0 or eva > 0 or mad > 0 or pad > 0 or acc > 0 or pdd > 0 or mdd > 0 or thaw > 0 or jump >0 or speed>0";
							break;
						case "teste":
							$bread = "Teste";
							$query = "";
							break;
						//Pergaminhos
						case "pergaminhos":
							$bread = "Pergaminhos";
							$query = "success > 0 or (name like '%pergaminho para%' or name like '%scroll for%')";
							break;
						case "pergaminhos-10":
							$bread = "Pergaminhos 10%";
							$query = "success = 10";
							break;
						case "pergaminhos-15":
							$bread = "Pergaminhos 15%";
							$query = "success = 15";
							break;
						case "pergaminhos-20":
							$bread = "Pergaminhos 20%";
							$query = "success = 20";
							break;
						case "pergaminhos-30":
							$bread = "Pergaminhos 30%";
							$query = "success = 30";
							break;
						case "pergaminhos-40":
							$bread = "Pergaminhos 40%";
							$query = "success = 40";
							break;
						case "pergaminhos-50":
							$bread = "Pergaminhos 50%";
							$query = "success = 50";
							break;
						case "pergaminhos-60":
							$bread = "Pergaminhos 60%";
							$query = "success = 60";
							break;
						case "pergaminhos-65":
							$bread = "Pergaminhos 65%";
							$query = "success = 65";
							break;
						case "pergaminhos-70":
							$bread = "Pergaminhos 70%";
							$query = "success = 70";
							break;
						case "pergaminhos-100":
							$bread = "Pergaminhos 100%";
							$query = "success = 100";
							break;
						case "pergaminhos-outros":
							$bread = "Outros Pergaminhos";
							$query = "success > 0 and success != 10 and success != 15 and success != 20 and success != 30 and success != 40 and success != 50 and success != 60 and success != 65 and success != 70 and success != 100";
							break;
						//Fim pergaminhos
						case "pergas_de_retorno":
							$bread = "Pergaminhos de Retorno";
							$query = "moveTo > 0";
							break;
						case "shurikens":
							$bread = "Shurikens";
							$query = "(itemid/10000) like '207%'";
							break;
						case "arcos":
							$bread = "Arcos";
							$query = "(itemid/1000) like '2061%' or (itemid/1000) like '2060%'";
							break;
						case "balas":
							$bread = "Balas";
							$query = "(itemid/10000) like '233%'";
							break;
						case "livros_de_pericia":
							$bread = "Livros de Perícia";
							$query = "masterlevel <=10 and masterlevel > 0";
							break;
						case "livros_de_maestria":
							$bread = "Livros de Maestria";
							$query = "masterlevel > 10";
							break;
						case "carta_de_monstro":
							$bread = "Cartas de Monstros";
							$query = "monsterBook >0";
							break;
						case "uso_outros":
							$bread = "Sem Categoria";
							$query = "itemtype='Consume' and itemid NOT IN(SELECT itemid FROM items where (hp >0 or mp > 0 or hpR>0 or mpR>0 or eva > 0 or mad > 0 or pad > 0 or acc > 0 or pdd > 0 or mdd > 0 or thaw > 0 or jump >0 or speed>0) or (success > 0) or ((itemid/10000) like '207%') or ((itemid/1000) like '2061%' or (itemid/1000) like '2060%') or ((itemid/10000) like '233%') or (recoveryHP > 0 or recoveryMP > 0) or (masterlevel <=10 and masterlevel > 0) or (masterlevel > 10)  or (moveTo>0) )";
							break;
						case "uso_todos";
							$bread = "Todos em Uso";
							$query = "itemType ='consume'";
							break;
						//Preparação
						case "cadeiras":
							$bread = "Cadeiras";
							$query = "recoveryHP > 0 or recoveryMP > 0";
							break;
						case "enfeites_de_natal";
							$bread = "Enfeites de Natal";
							$query = "itemid >= 3990000 and itemid <= 3992038";
							break;
						case "prep_outros":
							$bread = "Sem Categoria";
							$query = "itemtype='Install' and itemid NOT IN(SELECT itemid FROM items where (recoveryHP > 0 or recoveryMP > 0) or (itemid >= 3990000 and itemid <= 3992038) )";
							break;
						case "prep_todos";
							$bread = "Todos em Preparação";
							$query = "itemType ='install'";
							break;
						default:
							$bread = "Todos";
							$query = "1=1";
							break;
					}
					
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
					  <li><a href="<?php echo LOCAL_PATH; ?>items/geral">Itens</a></li>
					  <li class="active"><?php echo $bread; ?></li>
					</ol>
					<?php
					
					try {
					$items = $searchEngine->getItemsLimited($query, $page-1,$perPage);
					$resultCount = $items[0]["resultCount"];
					foreach($items as $item) {
						$itemInstance = new Item($item["itemid"],"",$item); 
					?>
						<table class="table table-bordered result_item">
						  <tr>
							<td rowspan="2" class="table_image-item"><img src="<?php echo $itemInstance->getCachedIcon(); ?>" /></td>
							<td rowspan="2"><a href="<?php echo $itemInstance->getSingleLink(); ?>"><?php if($itemInstance->getName() != "") { echo $itemInstance->getName(); } else { echo "Nome Indisponível"; } ?></a></td>
							<td class="table_rightinfo-item"><strong>Vendido Por:</strong> <?php echo $itemInstance->getPrice(); ?> Mesos</td>
						  </tr>
						  <tr>
							<td class="table_rightinfo-item"><strong>Máximo Por Slot:</strong> <?php if($itemInstance->getSlotMax() > 0) { echo $itemInstance->getSlotMax(); } else { echo "100"; } ?></td>
						  </tr>
						  <?php if($itemInstance->getDescr() != "") { ?>
							<tr>
								<td colspan="3"><strong>Descrição: </strong><?php 
									$descr = $itemInstance->getDescr(); 
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
									?></td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="3">
									<strong>Dropado Por: </strong>
										<?php
											$dropperList = $searchEngine->getDropListByItemId($itemInstance->getItemId());
											if(!empty($dropperList)) {
												$pos = 1;
												foreach($dropperList as $drop) {
													if($pos <= 10) {
														$mob = new mob($drop["mobid"],"",$drop);
														if($pos == count($dropperList)) echo '<a href="'.$mob->getSingleLink().'" class="monster_link" attr-url="'.$mob->getUrl().'">'.$mob->getName().'</a> ';
														else echo '<a href="'.$mob->getSingleLink().'" class="monster_link" attr-url="'.$mob->getUrl().'" href="#">'.$mob->getName().'</a>, ';
													} else {
														echo '<a href="'.$itemInstance->getSingleLink().'">(...)</a>';
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
								<td colspan=3><a href="<?php echo $itemInstance->getSingleLink(); ?>" style="font-size: 13px">Ver Tudo Sobre Este Item</a></td>
							</tr>
						</table>
					<?php
					}
					$showing = count($items);
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