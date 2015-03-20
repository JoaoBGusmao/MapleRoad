<!DOCTYPE html>

<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.mob.php");
	require_once("./inc/classes/class.searchEngine.php");
	
	$searchEngine = new searchEngine;
?>

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
					
					if(isset($_GET["lvStart"])) $lvStart = $_GET["lvStart"];
					else $lvStart = "";
					
					if(isset($_GET["lvEnd"])) $lvEnd = $_GET["lvEnd"];
					else $lvEnd = "";
					
					switch ($queryType) {
						case "monstros":
							$bread = "Todos os Monstros";
							$query = "1=1";
							break;
						case "chefes":
							$bread = "Chefes de Mapa";
							$query = "boss=1";
							break;
						default:
							$bread = "Todos";
							$query = "1=1";
							break;
					}
					
					if($lvStart != "" && $lvEnd != "") {
						if($queryType == "chefes") $boss=1;
						else $boss = 0;
						$query.= " and level >= $lvStart and level <= $lvEnd and boss = $boss";
						$bread.= " do Level ".$lvStart." até o ".$lvEnd;
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
					  <li><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros">Monstros</a></li>
					  <li class="active"><?php echo $bread; ?></li>
					</ol>
					<?php
					try {
					$mobs = $searchEngine->getMobsLimited($query, $page-1,$perPage);
					$resultCount = $mobs[0]["resultCount"];
					foreach($mobs as $mob) {
						$mobInstance = new mob($mob["mobid"],"",$mob); 
					?>
						<table class="table table-bordered result_item">
						  <tr>
							<td class="table_image-item"><img src="<?php echo $mobInstance->getCachedIcon(); ?>" /></td>
							<td colspan="2"><a href="<?php echo $mobInstance->getSingleLink(); ?>"><?php if($mobInstance->getName() != "") { echo $mobInstance->getName(); } else { echo "Nome Indisponível"; } ?></a></td>
						  </tr>
						  <tr>
							<td colspan="3">
							<ul style="margin-bottom: 0;list-style: none;padding-left: 0;">
								<li><strong>Level: </strong><?php echo $mobInstance->getLevel(); ?> </li>
								<li><strong>EXP: </strong><?php echo $mobInstance->getEXP(); ?> </li>
								<li><strong>HP: </strong><?php echo $mobInstance->getMaxHP(); ?> </li>
							</ul>
							</td>
						  </tr>
							<tr>
								<td colspan="3"><a href="<?php echo $mobInstance->getSingleLink(); ?>" style="font-size: 13px">Ver Tudo Sobre Este Monstro</a></td>
							</tr>
						</table>
					<?php
					}
					$showing = count($mobs);
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
</html>