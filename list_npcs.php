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
	require_once("./inc/classes/class.searchEngine.php");
	
	$searchEngine = new searchEngine;
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Database de NPCs - MapleRoad</title>
	<?php require_once("./inc/website_includes/common-head-includes.php"); ?>
  </head>
  
  <body>
		<?php require_once("./inc/website_includes/header.php"); ?>
		
		<div class="container site-container">
			<?php require_once("./inc/website_includes/sidebar-menu.php"); ?>
			<div class="col-md-8" style="margin-top: 15px">
				<?php
					
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
					  <li class="active">NPCs</li>
					</ol>
					<?php
					
					try {
					$npcs = $searchEngine->getNpcsLimited($page-1,$perPage);
					$resultCount = $npcs[0]["resultCount"];
					foreach($npcs as $npc) {
						$npcInstance = new npc($npc["npcid"],"",$npc); 
					?>
						<table class="table table-bordered result_item">
							<tr>
								<td class="text-center"><strong><a href="<?php echo $npcInstance->getSingleLink(); ?>"><?php echo $npcInstance->getName(); ?><?php if($npcInstance->getFunc() != "") { echo " - ".$npcInstance->getFunc(); } ?></strong></a></td>
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
								<td><a href="<?php echo $npcInstance->getSingleLink(); ?>" style="font-size: 13px">Ver Tudo Sobre Este NPC</a></td>
							</tr>
						</table>
					<?php
					}
					$showing = count($npcs);
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