<?php
	require_once("../../inc/config.php");
	require_once("../../inc/classes/class.npc.php");
	
	$npc = new npc($_POST["url"],"name,url,npcid");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<img src="<?php echo $npc->getCachedIcon(); ?>" style="max-width: 300px" />
		<p><strong>Nome: </strong><?php echo $npc->getName(); ?></p>
	</body>
</html>