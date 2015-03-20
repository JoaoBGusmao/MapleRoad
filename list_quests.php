<!DOCTYPE html>

<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.npc.php");
	require_once("./inc/classes/class.quest.php");
	require_once("./inc/classes/class.searchEngine.php");
	
	$searchEngine = new searchEngine;
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Database de Missões - MapleRoad</title>
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
					$perPage = 30;
					
					?>
					<ol class="breadcrumb">
					  <li><a href="<?php echo LOCAL_PATH; ?>">Database</a></li>
					  <li class="active">Missões</li>
					</ol>
					<?php
					
					try {
					$quests = $searchEngine->getQuestsLimited($page-1,$perPage);
					$resultCount = $quests[0]["resultCount"];
					echo '<table class="table table-bordered result_item">';
					foreach($quests as $quest) {
						$questInstance = new quest($quest["questid"],$quest); 
						$questInstance->loadReqData();
					?>
						<tr>
							<td><a href="<?php echo $questInstance->getSingleLink(); ?>"><?php echo $questInstance->getName(); ?></a>
							<span class="pull-right">
								<?php
									$lv = "Level ";
									if($questInstance->getReqInfo("lvmin",0) != null) {
										$lvmin = $questInstance->getReqInfo("lvmin",0);
										$lv.= $lvmin["stringStore"];
									} else $lv.=0;
									$lv.=" ~ ";
									if($questInstance->getReqInfo("lvmax",0) != null) {
										$lvmax = $questInstance->getReqInfo("lvmax",0);
										$lv.= $lvmax["stringStore"];
									} else $lv.=200;
									echo $lv;
								?>
							</span>
							</td>
						</tr>
					<?php
					}
					echo "</table>";
					$showing = count($quests);
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