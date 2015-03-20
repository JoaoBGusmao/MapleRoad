<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.mob.php");
	require_once("./inc/classes/class.npc.php");
	require_once("./inc/classes/class.quest.php");
	require_once("./inc/classes/class.equip.php");
	require_once("./inc/classes/class.item.php");
	require_once("./inc/classes/class.searchEngine.php");
	$searchEngine = new searchEngine;
	
	try {
		$questInstance = new quest($_GET["url"]);
		$noError = true;
	} catch(Exception $e) {
		$noError = false;
		//echo $e;
	}
	
	try {
		if(isset($questInstance)) {
			$questInstance->loadReqData();
			$questInstance->loadActData();
			$noError2 = true;
		}
	} catch(Exception $e) {
		$noError2 = false;
		//echo $e;
	}
	
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php if(isset($questInstance)) { echo $questInstance->getName(); } else { echo "Missão não encontrada"; } ?> - Database de Missões | MapleRoad</title>
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
				  <li><a href="<?php echo LOCAL_PATH; ?>list/missoes">Missões</a></li>
				  <li class="active"><?php if(isset($questInstance)) { echo $questInstance->getName(); } else { echo "Missão não encontrada"; } ?></li>
				</ol>
				<table class="table table-bordered result_item">
					<tr>
						<td class="text-center">
							<strong><?php echo $questInstance->getName(); ?></strong>
						</td>
					</tr>
					<tr>
						<td class="text-center">
							<?php
								//First NPC
								try {
									$npcid = $questInstance->getReqInfo("npc",0);
									$fNpc = new npc($npcid["stringStore"],"name,url,npcid");
								} catch (Exception $e) {
									$fNpc = null;
								}
							?>
							<a href="<?php echo $fNpc->getSingleLink(); ?>"><img src="<?php echo $fNpc->getCachedIcon(); ?>" /></a>
						</td>
					</tr>
					<?php if($noError2) { ?>
					<tr>
						<td>
							<strong>Informações: </strong>
							<ul>
								<li><strong>Nível Mínimo: </strong> <?php if($questInstance->getReqInfo("lvmin") == null) { echo "0"; } else { $lvmin = $questInstance->getReqInfo("lvmin"); echo $lvmin["stringStore"]; } ?></li>
								<li><strong>Nível Máximo: </strong> <?php if($questInstance->getReqInfo("lvmax") == null) { echo "200"; } else { $lvmax = $questInstance->getReqInfo("lvmax"); echo $lvmax["stringStore"]; } ?></li>
								<?php if($questInstance->getActInfo("nextQuest", 1) != null) { ?>
								<li>
									<?php
										$nxquest = $questInstance->getActInfo("nextQuest", 1);
										$nextQuest = new quest($nxquest[0]["intStore"]);
										echo "<strong>Próxima Missão:</strong> <a href='".$nextQuest->getSingleLink()."'>".$nextQuest->getName()."</a>";
									?>
								</li>
								<?php } ?>
							</ul>
						</td>
					</tr>
					
					<tr>
						<td>
							<strong>O que você precisa para iniciar a missão: </strong>
							<ul>
								<?php
									if($questInstance->getReqInfo("item",0) != null) {
										$items1 = $questInstance->getReqInfo("item",0); $items = $items1["intStoresFirst"];
										$itemsCount1 = $questInstance->getReqInfo("item",0); $itemsCount = $itemsCount1["intStoresSecond"];
										$items = explode(",",$items);
										$itemsCount = explode(",",$itemsCount);
										$itemsString = "";
										$itemsNum = 1;
										foreach($items as $item) {
											try {
												$tipo = "item";
												$itemInstance = new item($item,"name,url,itemid");
											} catch (Exception $e) {
												try {
													$tipo = "equip";
													$itemInstance = new equip($item,"name,url,itemid");
												} catch (Exception $e) {
													
												}
											}
											if($itemsCount[$itemsNum-1] > 1) $itemString = "<strong>".$itemsCount[$itemsNum-1]."</strong> unidades de ";
											else $itemString = " <strong>1</strong> unidade de ";
											$itemString .= "<a class='item_link' href='".$itemInstance->getSingleLink()."' attr-url='".$itemInstance->getUrl()."' attr-tipo='".$tipo."'>".$itemInstance->getName()."</a>";
											
											if(count($items) == $itemsNum) $itemString.=".";
											else if(count($items)-1 == $itemsNum) $itemString.= " e ";
											else $itemString.=", ";
											
											$itemsString.=$itemString;
											
										$itemsNum++;
										}
										echo '<li>Requer que você tenha: '.$itemsString.'</li>';
									}
								?>
								<?php 
									if($questInstance->getReqInfo("quest",0) != null) {
										$questsReq1 = $questInstance->getReqInfo("quest",0); $questsReq = $questsReq1["intStoresFirst"];
										$questsStatus1 = $questInstance->getReqInfo("quest",0); $questsStatus = $questsStatus1["intStoresSecond"];
										$questsReq = explode(",",$questsReq);
										$questsStatus = explode(",",$questsStatus);
										
										$pos = 0;
										foreach($questsReq as $req) {
											$questToDo = new quest($req);
											if($questsStatus[$pos] == 0) {
												echo "<li>Requer que você não tenha iniciado a missão <a href='".$questToDo->getSingleLink()."'>".$questToDo->getName()."</a></li>";
											} else if($questsStatus[$pos] == 1) {
												echo "<li>Requer que você tenha iniciado a missão <a href='".$questToDo->getSingleLink()."'>".$questToDo->getName()."</a></li>";
											} else if($questsStatus[$pos] == 2) {
												echo "<li>Requer que você tenha completado a missão <a href='".$questToDo->getSingleLink()."'>".$questToDo->getName()."</a></li>";
											}
											$pos++;
										}
									}
								?>
								<?php
									if($questInstance->getReqInfo("job",0) != null) {
										echo "<li>";
										$jobs1 = $questInstance->getReqInfo("job",0); $jobs = $jobs1["intStoresSecond"];
										$jobs = explode(",",$jobs);
										
										$jobNum = 1;
										$jobString = "<strong>Você precisa ser: </strong> ";
										foreach($jobs as $job) {
											$jobRequested = $searchEngine->getJobByID( intval($job) );
											if($jobRequested != null) {
												$jobString .= $jobRequested;
												if(count($jobs) == $jobNum) $jobString.=".";
												else if(count($jobs)-1 == $jobNum) $jobString.= " ou ";
												else $jobString.=", ";
											}
										$jobNum++;
										}
										echo $jobString;
										echo "</li>";
									}
								?>
							</ul>
						</td>
					</tr>
					
					<tr>
						<td>
							<strong>Como completar esta missão: </strong>
							<ul>
								<li>Inicie a missão falando com o NPC <a class="npc_link" href="<?php echo $fNpc->getSingleLink(); ?>" attr-url="<?php echo $fNpc->getUrl(); ?>"><?php echo $fNpc->getName(); ?></a></li>
								<?php
									if($questInstance->getActInfo("item", 0) != null) {
										$items = $questInstance->getActInfo("item",0);
										$itemsString = "";
										$itemsNum = 1;
										foreach($items as $item) {
											try {
												$tipo = "item";
												$itemInstance = new item($item["itemid"],"name,url,itemid");
											} catch (Exception $e) {
												try {
													$tipo = "equip";
													$itemInstance = new equip($item["itemid"],"name,url,itemid");
												} catch (Exception $e) {
													
												}
											}
											if($item["count"] > 1) $itemString = "<strong>".$item["count"]."</strong> unidades de ";
											else $itemString = " <strong>1</strong> unidade de ";
											$itemString .= "<a class='item_link' href='".$itemInstance->getSingleLink()."' attr-tipo='".$tipo."' attr-url='".$itemInstance->getUrl()."'>".$itemInstance->getName()."</a>";
											
											if(count($items) == $itemsNum) $itemString.=".";
											else if(count($items)-1 == $itemsNum) $itemString.= " e ";
											else $itemString.=", ";
											
											$itemsString.=$itemString;
											
										$itemsNum++;
										}
										echo '<li>Ele te dará '.$itemsString.'</li>';
									}
								?>
								
								<?php
									if($questInstance->getReqInfo("mob",1) != null) {
										$mobs1 = $questInstance->getReqInfo("mob",1); $mobs = $mobs1["intStoresFirst"];
										$mobsCount1 = $questInstance->getReqInfo("mob",1); $mobsCount = $mobsCount1["intStoresSecond"];
										$mobs = explode(",",$mobs);
										$mobsCount = explode(",",$mobsCount);
										$mobsString = "";
										$mobsNum = 1;
										foreach($mobs as $mob) {
											try {
												$mobInstance = new mob($mob,"name,url,mobid");
											} catch (Exception $e) {
											
											}
											if($mobsCount[$mobsNum-1] > 1) $mobString = "<strong>".$mobsCount[$mobsNum-1]."</strong> unidades de ";
											else $mobString = " <strong>1</strong> unidade de ";
											$mobString .= "<a class='monster_link' href='".$mobInstance->getSingleLink()."' attr-url='".$mobInstance->getUrl()."'>".$mobInstance->getName()."</a>";
											
											if(count($mobs) == $mobsNum) $mobString.=".";
											else if(count($mobs)-1 == $mobsNum) $mobString.= " e ";
											else $mobString.=", ";
											
											$mobsString.=$mobString;
											
										$mobsNum++;
										}
										echo '<li>Elimine '.$mobsString.'</li>';
									}
								?>
								
								<?php
									if($questInstance->getReqInfo("item",1) != null) {
										$items1 = $questInstance->getReqInfo("item",1); $items = $items1["intStoresFirst"];
										$itemsCount1 = $questInstance->getReqInfo("item",1); $itemsCount = $itemsCount1["intStoresSecond"];
										$items = explode(",",$items);
										$itemsCount = explode(",",$itemsCount);
										$itemsString = "";
										$itemsNum = 1;
										foreach($items as $item) {
											try {
												$tipo = "item";
												$itemInstance = new item($item,"name,url,itemid");
											} catch (Exception $e) {
												try {
													$tipo = "equip";
													$itemInstance = new equip($item,"name,url,itemid");
												} catch (Exception $e) {
													
												}
											}
											if($itemsCount[$itemsNum-1] > 1) $itemString = "<strong>".$itemsCount[$itemsNum-1]."</strong> unidades de ";
											else $itemString = " <strong>1</strong> unidade de ";
											$itemString .= "<a class='item_link' href='".$itemInstance->getSingleLink()."' attr-url='".$itemInstance->getUrl()."' attr-tipo='".$tipo."'>".$itemInstance->getName()."</a>";
											
											if(count($items) == $itemsNum) $itemString.=".";
											else if(count($items)-1 == $itemsNum) $itemString.= " e ";
											else $itemString.=", ";
											
											$itemsString.=$itemString;
											
										$itemsNum++;
										}
										echo '<li>Colete '.$itemsString.'</li>';
									}
								?>
								
							<li>Termine a missão falando
							<?php
								$npcid = $questInstance->getReqInfo("npc",1);
								if($fNpc->getNpcid() == $npcid["stringStore"]) {
									$lNpc = $fNpc;
									echo " novamente com o NPC ";
								} else {
									echo " com o NPC ";
									try {
										$lNpc = new npc($npcid["stringStore"],"name,url,npcid");
									} catch (Exception $e) {
										$lNpc = null;
									}
								}
							?>
							<a class="npc_link" href="<?php echo $lNpc->getSingleLink(); ?>" attr-url="<?php echo $lNpc->getUrl(); ?>"><?php echo $lNpc->getName(); ?></a>
							</li>
							</ul>
						</td>
					</tr>
					
					<tr>
						<td>
							<strong>Recompensas</strong>
							<ul class="reward_list">
								<?php
									if($questInstance->getActInfo("exp", 1) != null) {
										$act = $questInstance->getActInfo("exp", 1);
										echo "<li><strong>EXP:</strong> ".$act[0]["intStore"]."</li>";
									}
									
									if($questInstance->getActInfo("money", 1) != null) {
										$act = $questInstance->getActInfo("money", 1);
										echo "<li><strong>Mesos:</strong> ".$act[0]["intStore"]."</li>";
									}
								?>
								<?php
									if($questInstance->getActInfo("item", 1) != null) {
										$items = $questInstance->getActInfo("item",1);
										$itemsString = "";
										$itemsNum = 1;
										foreach($items as $item) {
											try {
												$tipo = "item";
												$itemInstance = new item($item["itemid"],"name,url,itemid");
											} catch (Exception $e) {
												try {
													$tipo = "equip";
													$itemInstance = new equip($item["itemid"],"name,url,itemid");
												} catch (Exception $e) {
													
												}
											}
											if($item["count"] > 0) echo "<li><img src='".$itemInstance->getCachedIcon()."'><a class='item_link' href='".$itemInstance->getSingleLink()."' attr-tipo='".$tipo."' attr-url='".$itemInstance->getUrl()."'> ".$itemInstance->getName()."</a> (x".$item["count"].")</li>";
										}
									}
								?>
								<li class="no-results" style="display:none">Nenhuma</li>
							</ul>
							<script type="text/javascript">
								if( $(".reward_list li").length == 1) {
									$(".no-results").removeAttr("style");
								}
							</script>
						</td>
					</tr>
					<?php } else {
						echo "<tr><td>Sem informações adicionais</td></tr>";
					}
					?>
				</table>
				
				<?php } else { ?>
					<h1>Missão não encontrada</h1>
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
		$(".npc_link").mouseover( function() {
			actived = true;
			$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/npc_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
				if(actived == true) {
					$( ".npc_hover" ).html( data );
					$( ".npc_hover" ).stop().fadeIn(100);
				}
			});
		});
		$(".npc_link").mouseout( function() {
			actived=false;
			$( ".npc_hover" ).stop().fadeOut(100);
		});
	});
	$(document).on('mousemove', function(e){
		$('.npc_hover').css({
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