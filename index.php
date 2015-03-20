<!DOCTYPE html>
<?php 
	require_once("./inc/config.php");
	require_once("./inc/classes/class.news.php");
	require_once("./inc/classes/class.searchEngine.php");
	
	$searchEngine = new searchEngine;
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>MapleRoad - Database Oficial do Brasil MapleStory</title>
	<?php require_once("./inc/website_includes/common-head-includes.php"); ?>
  </head>
  <body>
		<?php require_once("./inc/website_includes/header.php"); ?>
		
		<div class="container site-container">
			<?php require_once("./inc/website_includes/sidebar-menu.php"); ?>
			<div class="col-md-8">
				<?php
					$top5News = $searchEngine->getLatestsNews(5);
					foreach($top5News as $new) {
						$news = new news($new["id"],"",$new);
				?>
				<div class="updates">
					<h2 class="update-title"><?php echo $news->getTitle();?></h2>
					<p class="update-tag">Postado por <strong><?php echo $news->getAuthor();?></strong> em <strong> <?php echo $news->getDateString();?></strong></p>
					<p class="update-content"><?php 
					$string = strip_tags($news->getContent());
					if (strlen($string) > 500) {
						// truncate string
						$stringCut = substr($string, 0, 500);
						// make sure it ends in a word so assassinate doesn't become ass...
						$string = substr($stringCut, 0, strrpos($stringCut, ' '));
					}
					echo $string;
						
					?>
					</p>
					<p><a href="<?php echo $news->getSingleLink(); ?>">Notícia Completa</a></p>
				</div>
				<?php
					}
				?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
</html>