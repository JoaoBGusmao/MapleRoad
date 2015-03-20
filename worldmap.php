<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.equip.php");
	require_once("./inc/classes/class.map.php");
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
    <title>Teste - Equipamentos | MapleRoad</title>
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
				<style>
					.map_dot {
						position: absolute;
						border-radius: 9px;
					}
				</style>
				<ol class="breadcrumb">
				  <li><a href="#">Database</a></li>
				  <li><a href="<?php echo LOCAL_PATH; ?>mapas/">Mapas</a></li>
				  <li class="active">Mundo</li>
				</ol>
				<script>
				$(document).ready(function(){
					$(".obj").mouseover( function() {
						$(this).css({opacity:"1"});
					});
					$(".obj").mouseout( function() {
						$(this).css({opacity:"0"});
					});
					$(".obj").click( function() {
						$(".worldmap_"+$(this).attr("data-worldmap")).hide();
						$(".worldmap_"+$(this).attr("data-linkmap")).show();
					});
					
					function goBack(event,element) {
						if(element.attr("data-parent_map") != "") {	
							element.hide();
							$(".worldmap_"+element.attr("data-parent_map")).show();
						}
						return true;
					}
					
					$('.worldmap_base').mousedown(function(event) {
						$(this).bind("contextmenu", function(e) {
							e.preventDefault();
						});
						if(event.button == 2) {
							goBack(event,$(this));
						return false;
						}
					});
					$('.goBack').click(function(event) {
						//alert($(this).parent().attr("data-parent_map"));
						goBack(event,$(this).parent());
					});
				});
				</script>
					
					
				
				<?php
					$maps = $searchEngine->getAllWorldMaps();
					
					foreach($maps as $map) {
				?>
						<div class="worldmap_base worldmap_<?php echo $map["worldmap"]; ?>" data-parent_map="<?php echo $map["parentMap"] ; ?>" style="<?php if($map["worldmap"] != "WorldMap") { echo "display: none"; } ?>;margin: 0 auto;width: 640px;height:470px;position: relative;background-image:url()">
							<?php
								try {
									$links = $searchEngine->getWorldMap_Links($map["worldmap"]);
									foreach($links as $link) {
										$x = $link["originX"]*-1;
										$y = $link["originY"]*-1;
										echo '<a><img class="obj" data-worldmap="'.$link["worldmap"].'" data-linkmap="'.$link["linkMap"].'" style="opacity:0;position: absolute;top:235px;left:320px;margin-left:'.$x.'px;margin-top:'.$y.'px" src="data:image/jpg;base64,'.$link["linkImg"].'" /></a>';
									}
								} catch(Exception $e) {
									
								}
							
								$dots = $searchEngine->getWorldMap($map["worldmap"]);
								foreach($dots as $dot) {
								if($dot["type"] == "0") {
									$backgroundImage = "url(".LOCAL_PATH."img/maps/etc/minimap_dot0.png)";
									$styleWidth = "20px";
									$styleHeight = "20px";
									$w = 20;
								} else if($dot["type"] == "1") {
									$backgroundImage = "url(".LOCAL_PATH."img/maps/etc/minimap_dot1.png)";
									$styleWidth = "14px";
									$styleHeight = "14px";
									$w = 14;
								} else if($dot["type"] == "2") {
									$backgroundImage = "url(".LOCAL_PATH."img/maps/etc/minimap_dot2.png)";
									$styleWidth = "20px";
									$styleHeight = "20px";
									$w = 20;
								} else if($dot["type"] == "3") {
									$backgroundImage = "url(".LOCAL_PATH."img/maps/etc/minimap_dot3.png)";
									$styleWidth = "13px";
									$styleHeight = "13px";
									$w = 13;
								} else  {
									$backgroundImage = "red";
									$styleWidth = "14px";
									$styleHeight = "14px";
									$correcao = 0;
								}
								$x = $dot["spotX"]-($w/2); //Top
								$y = $dot["spotY"]-($w/2); //Left
								$mapInstance = new map(91000000,"mapid,url,mapName",$dot);
								
							?>
								<a href="<?php echo $mapInstance->getSingleLink(); ?>" class="map_dot" attr-url="<?php echo $mapInstance->getUrl(); ?>" style="top:235px;left:320px;margin-left:<?php echo $x; ?>px;margin-top:<?php echo $y; ?>px;background:<?php echo $backgroundImage; ?>;width:<?php echo $styleWidth; ?>;height:<?php echo $styleWidth; ?>"></a>
							<?php } ?>
							<?php if($map["worldmap"] != "WorldMap") { ?><span class="glyphicon glyphicon-arrow-left goBack" style="cursor:pointer;position: absolute;left: 23px;top: 14px;font-size: 23px;color: white;background: rgb(255, 127, 86);padding: 6px;border-radius: 30px;"></span><?php } ?>
							<img src="<?php echo LOCAL_PATH; ?>img/maps/worldmap/<?php echo strtolower($map["worldmap"]); ?>.png" style="width:640px;height: 470px"/>
						</div>
				
				<?php
					}
				?>
				
				<p><strong>Dica: </strong>Navegue através dos continentes clicando neles, ou clique nos pontos para entrar diretamente no mapa.<br />Clique com o botão direito sobre o mapa para voltar ao mapa anterior</p>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
<div class="map_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC;"></div>

<script type="text/javascript">
	var actived = false;
	$(document).ready(function(){
		$(".map_dot").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/map_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
				if(actived == true) {
					$( ".map_hover" ).html( data );
					$( ".map_hover" ).stop().fadeIn(100);
				}
			});
		});
		$(".map_dot").mouseout( function() {
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