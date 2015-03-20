<?php
	require_once("../../inc/config.php");
	require_once("../../inc/classes/class.mob.php");
	
	$mob = new mob($_POST["url"],"name,level,mobid,url");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<img src="<?php echo $mob->getCachedIcon(); ?>" style="max-width: 300px" />
		<p><strong>Nome: </strong><?php echo $mob->getName(); ?></p>
		<p><strong>Nível: </strong><?php echo $mob->getLevel(); ?></p>
	</body>
</html>