<?php
	require_once("../../inc/config.php");
	require_once("../../inc/classes/class.item.php");
	require_once("../../inc/classes/class.equip.php");
	
	if($_POST["tipo"] == "item") {
		try {
			$item = new item($_POST["url"],"name,url");
		} catch(Exception $e) {
			echo "Não encontrado";
		}
	} else if($_POST["tipo"] == "equip") {
		try {
			$item = new equip($_POST["url"],"name,url");
		} catch(Exception $e) {
			echo "Não encontrado";
		}
	} else {
		echo "Não encontrado";
		exit;
	}
	
	//$mob = new mob($_POST["url"],"name,level,mobid,url");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<img src="<?php echo $item->getCachedIcon(); ?>" style="max-width: 300px" />
		<p><strong>Nome: </strong><?php echo $item->getName(); ?></p>
	</body>
</html>