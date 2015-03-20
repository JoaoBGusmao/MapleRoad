<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.item.php");
	require_once("./inc/classes/class.equip.php");
	require_once("./inc/classes/class.mob.php");
	require_once("./inc/classes/class.map.php");
	require_once("./inc/classes/class.searchEngine.php");
	$searchEngine = new searchEngine;
	
	try {
		$mobInstance = new mob($_GET["url"],"name,url,mobid,level,maxHP,maxMP,PADamage,MADamage,PDDamage,MDDamage,Speed,acc,eva,exp");
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
    <title><?php if(isset($mobInstance)) { echo $mobInstance->getName(); } else { echo "Monstro não encontrado"; } ?> - Database de Monstros | MapleRoad</title>
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
				  <li><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros">Monstros</a></li>
				  <li class="active"><?php echo $mobInstance->getName(); ?></li>
				</ol>
				<table class="table table-bordered result_item">
				  <tr>
					<td colspan="2" class="text-center"><strong><?php echo $mobInstance->getName(); ?></strong></td>
				  </tr>
				  <tr>
					<td colspan="2" class="table_image-item text-center"><img src="<?php echo $mobInstance->getCachedIcon(); ?>" /></td>
				</tr>
				<tr>
					<td style="width: 360px;vertical-align: top !important;">
						<strong>Atributos:</strong>
						<ul>
							<li><strong>Nível: </strong> <?php echo $mobInstance->getLevel(); ?></li>
							<li><strong>Exp: </strong> <?php echo $mobInstance->getExp(); ?></li>
							<li><strong>HP: </strong> <?php echo $mobInstance->getMaxHP(); ?></li>
							<li><strong>MP: </strong> <?php echo $mobInstance->getMaxMP(); ?></li>
							<li><strong>Ataque: </strong> <?php echo $mobInstance->getPADamage(); ?></li>
							<li><strong>Defesa: </strong> <?php echo $mobInstance->getPDDamage(); ?></li>
							<li><strong>Ataque Mágico: </strong> <?php echo $mobInstance->getMADamage(); ?></li>
							<li><strong>Defesa Mágica: </strong> <?php echo $mobInstance->getMDDamage(); ?></li>
							<li><strong>Velocidade: </strong> <?php echo $mobInstance->getSpeed(); ?></li>
							<li><strong>Precisão: </strong> <?php echo $mobInstance->getAcc(); ?></li>
							<li><strong>Esquiva: </strong> <?php echo $mobInstance->getEva(); ?></li>
						</ul>
					</td>
					
					<td style="width: 360px;vertical-align: top !important;">
						<strong>Localização:</strong>
						<?php 
							try {
								$maps = $searchEngine->getMapLocationForMob($mobInstance->getMobId());
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
					</td>
				</tr>
				<tr>
					<td colspan="2" class="dropList_single_mob">
						<strong>Drops:</strong> 
						<?php
							$dropList = $searchEngine->getDropList($mobInstance->getMobId());
							if($dropList != null) {
								$useArray = Array();
								$equipArray = Array();
								$etcArray = Array();
								$setUpArray = Array();
								foreach($dropList as $drop) {
									if($drop["type"] == "item") {
										$item = new item($drop["itemid"],"name,url,itemtype",$drop);
										if($drop["itemtype"] == "Consume") {
											array_push($useArray,$item);
										} else if($drop["itemtype"] == "Install") {
											array_push($setUpArray,$item);
										} else if($drop["itemtype"] == "Etc") {
											array_push($etcArray,$item);
										}
									} else if($drop["type"] == "equip") {
										$equip = new equip($drop["itemid"],"name,url",$drop);
										array_push($equipArray,$equip);
									}
								}
								
								if(!empty($useArray)) {
									echo '<p style="margin-bottom: 0;">Uso:</p>';
									foreach($useArray as $item) {
										echo "<a href='".(LOCAL_PATH)."item/".$item->getUrl()."'><img class='item_link' attr-url='".$item->getUrl()."' attr-tipo='item' src='".$item->getCachedIcon()."' /></a>";
									}
								}
								if(!empty($etcArray)) {
									echo '<p style="margin-bottom: 0;">Etc:</p>';
									foreach($etcArray as $item) {
										echo "<a href='".(LOCAL_PATH)."item/".$item->getUrl()."'><img class='item_link' attr-url='".$item->getUrl()."' attr-tipo='item' src='".$item->getCachedIcon()."' /></a>";
									}
								}
								if(!empty($setUpArray)) {
									echo '<p style="margin-bottom: 0;">Preparação:</p>';
									foreach($setUpArray as $item) {
										echo "<a href='".(LOCAL_PATH)."item/".$item->getUrl()."'><img class='item_link' attr-url='".$item->getUrl()."' attr-tipo='item' src='".$item->getCachedIcon()."' /></a>";
									}
								}
								if(!empty($equipArray)) {
									echo '<p style="margin-bottom: 0;">Equipamentos:</p>';
									foreach($equipArray as $equip) {
										echo "<a href='".(LOCAL_PATH)."equipamento/".$equip->getUrl()."'><img class='item_link' attr-url='".$equip->getUrl()."' attr-tipo='equip' src='".$equip->getCachedIcon()."' /></a>";
									}
								}
							}
						?>
					</td>
				</tr>
				</table>
				<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" data-numposts="15" data-colorscheme="light" data-width="100%"></div>
				<?php } else { ?>
					<h1>Monstro não encontrado</h1>
				<?php } ?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
<div class="map_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>
<div class="item_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>

<script type="text/javascript">
	var actived = false;
	$(document).ready(function(){
		$(".item_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/item_hover.php", {url: $(this).attr("attr-url"), tipo: $(this).attr("attr-tipo") } ,function( data ) {
			  if(actived == true) {
				$( ".item_hover" ).html( data );
				$( ".item_hover" ).stop().fadeIn(100);
				} else {
					console.log("Previniiu");
				}
			});
		});
		$(".item_link").mouseout( function() {
			actived=false;
			$( ".item_hover" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.item_hover').css({
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