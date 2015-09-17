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
	require_once("./inc/classes/class.mob.php");
	require_once("./inc/classes/class.npc.php");
	require_once("./inc/classes/class.map.php");
	require_once("./inc/classes/class.searchEngine.php");
	$searchEngine = new searchEngine;
	
	try {
		$mapInstance = new map($_GET["url"],"mapMark,streetName,mapName,url,continent,mapDesc,returnMap,mapid");
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
    <title><?php if(isset($mapInstance)) { echo $mapInstance->getMapName(); } else { echo "Monstro não encontrado"; } ?> - Database de Mapas | MapleRoad</title>
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
				  <li><a href="<?php echo LOCAL_PATH; ?>mapas/">Mapas</a></li>
				  <li class="active"><?php echo $mapInstance->getMapName(); ?></li>
				</ol>
				<table class="table table-bordered result_item">
					<tr>
						<td class="text-center"><strong><?php echo $mapInstance->getMapName(); ?></strong></td>
					</tr>
					
					<tr>
						<td class="table_image-item text-center"><img src="<?php echo $mapInstance->getCachedIcon(); ?>" /></td>
					</tr>
				<tr>
					<td class="map-info_single_map" style="width: 360px;vertical-align: top !important;">
						<p><strong>Continente: </strong>
							<?php
								switch ($mapInstance->getContinent()) {
									case 0:
										echo "Ilha Maple";
										break;
									case 1:
										echo "Ilha Victoria";
										break;
									/*case 2:
										echo "Mt.El Nath";
										break;
									case 3:
										echo "Lago Ludus";
										break;
									case 4:
										echo "Estrada Aqua";
										break;
									case 5:
										echo "Floresta Minar";
										break;
									case 6:
										echo "Mureung";
										break;
									case 7:
										echo "Deserto de Nihal";
										break;
									case 8:
										echo "Templo do Tempo";
										break;
									case 9:
										echo "Ereve";
										break;
									case 10:
										echo "Rien";
										break;*/
									default:
										echo "Indefinido";
										break;
								}
							?>
						</p>
						<?php if($mapInstance->getMapDesc() != "") { ?><p><strong>Descrição: </strong><?php echo $mapInstance->getMapDesc(); ?></p><?php } ?>
						<p><strong>Mapa de Retorno: </strong><?php 
							$return = new map($mapInstance->getReturnMap(),"mapName,url,mapid");
							echo '<a href="'.$return->getSingleLink().'">'.$return->getMapName().'</a>';
						?></p>
					</td>
				</tr>
				<tr>
					<td style="width: 360px;vertical-align: top !important;">
						<strong>NPCs: </strong>
						<?php
							try {
								$npcs = $searchEngine->getAllNpcsFromMap($mapInstance->getMapid());
								$pos = 1;
								foreach($npcs as $npc) {
									$npcInstance = new npc($npc["npcid"],"npcid,name",$npc);
									if($pos == count($npcs)) echo '<a href="'.$npcInstance->getSingleLink().'" class="npc_link" attr-url="'.$npcInstance->getUrl().'">'.$npcInstance->getName().'</a>.';
									else echo '<a href="'.$npcInstance->getSingleLink().'" class="npc_link" attr-url="'.$npcInstance->getUrl().'">'.$npcInstance->getName().'</a>, ';
									$pos++;
								}
							} catch (Exception $e) {
								echo "Nenhum";
							}
						?>
					</td>
				</tr>
				<tr>
					<td style="width: 360px;vertical-align: top !important;">
						<strong>Monstros: </strong>
						<?php
							try {
								$mobs = $searchEngine->getAllMobsFromMap($mapInstance->getMapid());
								$pos = 1;
								foreach($mobs as $mob) {
									$mobInstance = new mob($mob["mobid"],"mobid,name",$mob);
									if($pos == count($mobs)) echo '<a href="'.$mobInstance->getSingleLink().'" class="monster_link" attr-url="'.$mobInstance->getUrl().'" >'.$mobInstance->getName().'</a> (x'.$mob["mobQtd"].') .';
									else echo '<a href="'.$mobInstance->getSingleLink().'" class="monster_link" attr-url="'.$mobInstance->getUrl().'">'.$mobInstance->getName().'</a> (x'.$mob["mobQtd"].'), ';
									$pos++;
								}
							} catch (Exception $e) {
								echo "Nenhum";
							}
						?>
					</td>
				</tr>
				
				<tr>
					<td style="width: 360px;vertical-align: top !important;">
						<strong>Portais: </strong>
						<?php
								$portals = $searchEngine->getAllPortalsFromMap($mapInstance->getMapid());
							try {
								$pos = 1;
								foreach($portals as $portal) {
									$mapInstance = new map($portal["mapid"],"mapid,name",$portal);
									if($pos == count($portals)) echo '<a href="'.$mapInstance->getSingleLink().'" class="map_link" attr-url="'.$mapInstance->getUrl().'">'.$mapInstance->getMapName().'</a>.';
									else echo '<a href="'.$mapInstance->getSingleLink().'" class="map_link" attr-url="'.$mapInstance->getUrl().'">'.$mapInstance->getMapName().'</a>, ';
									$pos++;
								}
							} catch (Exception $e) {
								echo "Nenhum";
							}
						?>
					</td>
				</tr>
				</table>
				<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" data-numposts="15" data-colorscheme="light" data-width="100%"></div>
				<?php } else { ?>
					<h1>Mapa não encontrado</h1>
				<?php } ?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
<div class="hover_card" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>

<script type="text/javascript">
	var actived = false;
	$(document).ready(function(){
		$(".item_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/item_hover.php", {url: $(this).attr("attr-url"), tipo: $(this).attr("attr-tipo") } ,function( data ) {
			  if(actived == true) {
				$( ".hover_card" ).html( data );
				$( ".hover_card" ).stop().fadeIn(100);
				} else {
					console.log("Previniiu");
				}
			});
		});
		$(".item_link").mouseout( function() {
			actived=false;
			$( ".hover_card" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.hover_card').css({
		   left:  e.pageX+10,
		   top:   e.pageY+10
		});
	});
	
	var actived = false;
	$(document).ready(function(){
		$(".monster_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/monster_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
				if(actived == true) {
					$( ".hover_card" ).html( data );
					$( ".monster_hover" ).stop().fadeIn(100);
				}
			});
		});
		$(".monster_link").mouseout( function() {
			actived=false;
			$( ".hover_card" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.hover_card').css({
		   left:  e.pageX+10,
		   top:   e.pageY+10
		});
	});
	
	var actived = false;
	$(document).ready(function(){
		$(".npc_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/npc_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
				if(actived == true) {
					$( ".hover_card" ).html( data );
					$( ".hover_card" ).stop().fadeIn(100);
				}
			});
		});
		$(".npc_link").mouseout( function() {
			actived=false;
			$( ".hover_card" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.hover_card').css({
		   left:  e.pageX+10,
		   top:   e.pageY+10
		});
	});
	
	var actived = false;
	$(document).ready(function(){
		$(".map_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/map_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
				if(actived == true) {
					$( ".hover_card" ).html( data );
					$( ".hover_card" ).stop().fadeIn(100);
				}
			});
		});
		$(".map_link").mouseout( function() {
			actived=false;
			$( ".hover_card" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.hover_card').css({
		   left:  e.pageX+10,
		   top:   e.pageY+10
		});
	});
</script>
</html>