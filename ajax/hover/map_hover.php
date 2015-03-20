<?php
	require_once("../../inc/config.php");
	require_once("../../inc/classes/class.map.php");
	
	$map = new map($_POST["url"],"mapName,url,mapid");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<img src="<?php echo $map->getCachedIcon(); ?>" style="max-width: 300px" />
		<p><strong>Nome: </strong><?php echo $map->getMapName(); ?></p>
	</body>
</html>