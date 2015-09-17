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
	require_once("./inc/classes/class.quest.php");
	require_once("./inc/classes/class.searchEngine.php");
	$searchEngine = new searchEngine;
	
	try {
		$itemInstance = new item($_GET["url"],"itemid,name,url,descr,price,slotMax,tradeblock,tradeAvailable,notSale,only,life,meso,stateChangeItem,quest,pquest,randstat");
		$noError = true;
	} catch(Exception $e) {
		$noError = false;
	}
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php if(isset($itemInstance)) { echo $itemInstance->getName(); } else { echo "Item não encontrado"; } ?> - Itens | MapleRoad</title>
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
				  <li><a href="#">Itens</a></li>
				  <li class="active"><?php echo $itemInstance->getName(); ?></li>
				</ol>
				<table class="table table-bordered result_item">
				  <tr>
					<td rowspan="2" class="table_image-item"><img src="<?php echo $itemInstance->getCachedIcon(); ?>" /></td>
					<td rowspan="2"><a href="#"><?php echo $itemInstance->getName(); ?></a></td>
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
					
					<?php
						if($itemInstance->getTradeBlock() != 0 || $itemInstance->getTradeAvailable() != 0 || $itemInstance->getNotSale() != 0 
						|| $itemInstance->getOnly() != 0 || $itemInstance->getLife() != 0 
						|| $itemInstance->getMeso() != 0 || $itemInstance->getStateChangeItem() != 0 
						|| $itemInstance->getQuest() != 0 || $itemInstance->getPquest() != 0 || $itemInstance->getRandStat() != 0) {
					?>
					<tr>
						<td colspan="3">
							<strong>Observações:</strong>
							<ul>
								<?php 
								if($itemInstance->getTradeBlock() != 0) echo '<li>Este item não pode ser trocado ou vendido</li>';
								if($itemInstance->getTradeAvailable() != 0) echo '<li>Este item não pode ser trocado ou vendido</li>';
								if($itemInstance->getNotSale() != 0) echo '<li>Este item não pode ser trocado ou vendido</li>';
								if($itemInstance->getOnly() != 0) echo '<li>Você só pode segurar uma unidade deste item em seu inventário</li>';
								if($itemInstance->getLife() != 0) echo '<li>'.$itemInstance->getLife().' dias de vida</li>';
								if($itemInstance->getMeso() != 0) echo '<li>Vale '.$itemInstance->getMeso().' Mesos</li>';
								if($itemInstance->getStateChangeItem() != 0) {
									$itemChange = new item($itemInstance->getStateChangeItem(),"name,url");
									echo '<li>Quando usado, este item assume os atributos de <a href="'.$itemChange->getSingleLink().'">'.$itemChange->getName().'</a></li>';
								}
								if($itemInstance->getQuest() != 0) echo '<li>Item de missão</li>';
								if($itemInstance->getPquest() != 0) echo '<li>Item de missão de grupo</li>';
								if($itemInstance->getRandStat() != 0) echo '<li>Os atributos alterado por este item são aleatórios</li>';
								?>
								
						</td>
					</tr>
					<?php } ?>
					
					<?php } ?>
					<tr>
						<td class="single_item-dropperList" colspan="3">
							<strong>Dropado Por: </strong>
								<?php
									$dropperList = $searchEngine->getDropListByItemId($itemInstance->getItemId());
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
						<td class="single_item-dropperList" colspan="3">
							<strong>Obtido através da missão: </strong>
								<?php
									$questList = $searchEngine->getWhereItemIsReward($itemInstance->getItemId());
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