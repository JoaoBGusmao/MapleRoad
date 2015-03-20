<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.news.php");
	
	try {
		$newsInstance = new news($_GET["url"],"title,date,author,content");
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
    <title><?php if(isset($newsInstance)) { echo $newsInstance->getTitle(); } else { echo "Notícia não encontrada"; } ?> - Notícias | MapleRoad</title>
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
				  <li><a href="#">Notícias</a></li>
				  <li class="active"><?php echo $newsInstance->getTitle(); ?></li>
				</ol>
				
				<div class="news">
					<div class="news-title"><h1 class="entry-title"><?php echo $newsInstance->getTitle(); ?></h1></div>
					<div class="news-header">Postado por <strong><?php echo $newsInstance->getAuthor();?></strong> em <strong> <?php echo $newsInstance->getDateString();?></strong></div>
					<div class="news-content"><?php echo $newsInstance->getContent(); ?></div>
				</div>
				
				<h3>Comente!</h3>
				
				<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" data-numposts="15" data-colorscheme="light" data-width="100%"></div>
				<?php } else { ?>
					<h1>Notícia não encontrada</h1>
				<?php } ?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
</html>