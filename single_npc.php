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
	require_once("./inc/classes/class.npc.php");
	require_once("./inc/classes/class.map.php");
	require_once("./inc/classes/class.quest.php");
	require_once("./inc/classes/class.searchEngine.php");
	$searchEngine = new searchEngine;
	
	try {
		$npcInstance = new npc($_GET["url"],"name,url,npcid,func");
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
    <title><?php if(isset($npcInstance)) { echo $npcInstance->getName(); } else { echo "NPC não encontrado"; } ?> - Database de NPCs | MapleRoad</title>
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
				  <li><a href="<?php echo LOCAL_PATH; ?>npcs/">NPCs</a></li>
				  <li class="active"><?php echo $npcInstance->getName(); ?></li>
				</ol>
				<table class="table table-bordered result_item">
					<tr>
						<td class="text-center"><strong><?php echo $npcInstance->getName(); ?><?php if($npcInstance->getFunc() != "") { echo " - ".$npcInstance->getFunc(); } ?></strong></td>
					</tr>
					
					<tr>
						<td class="table_image-item text-center"><img src="<?php echo $npcInstance->getCachedIcon(); ?>" /></td>
					</tr>
				<tr>
					<td class="map-info_single_map" style="width: 360px;vertical-align: top !important;">
						<p><strong>Encontrado em: </strong>	
							<?php 
							try {
								$maps = $searchEngine->getMapLocationForNpc($npcInstance->getNpcId());
								$pos = 1;
								foreach($maps as $map) {
									$mapInstance = new map($map["mapid"],"mapName,url,mapid",$map);
									if($pos == count($maps)) echo '<a href="'.$mapInstance->getSingleLink().'" class="map_link" attr-url="'.$mapInstance->getUrl().'">'.$mapInstance->getMapName().'</a>.';
									else echo '<a href="'.$mapInstance->getSingleLink().'" class="map_link" attr-url="'.$mapInstance->getUrl().'">'.$mapInstance->getMapName().'</a>, ';
									$pos++;
								}
							} catch(Exception $e) {
								echo " Nenhum lugar";
							}
						?>
						</p>
					</td>
				</tr>
				
				<tr>
					<td colspan="5">
					<strong>Envolvido com a Missão: </strong>
						<?php
							$questList = $searchEngine->getInvolvedWith($npcInstance->getNpcid());
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
					<h1>Mapa não encontrado</h1>
				<?php } ?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
<div class="monster_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>
<div class="item_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>
<div class="npc_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>
<div class="map_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>

<script type="text/javascript">
	var actived = false;
	$(document).ready(function(){
		$(".map_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/map_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
				if(actived == true) {
					$( ".map_hover" ).html( data );
					$( ".map_hover" ).stop().fadeIn(100);
				}
			});
		});
		$(".map_link").mouseout( function() {
			actived=false;
			$( ".map_hover" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.map_hover').css({
		   left:  e.pageX+10,
		   top:   e.pageY+10
		});
	});
</script>
</html>