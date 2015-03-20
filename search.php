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
					<ol class="breadcrumb">
					  <li><a href="#">Database</a></li>
					  <li>Pesquisa</a></li>
					  <li class="active"><?php echo htmlspecialchars($_GET['query']); ?></li>
					</ol>
					<div class="loading-content" style="text-align:center">
						<h1 style="display: inline-block;position: relative;top: -15px;">Carregando...</h1>
						<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-4… codebase=" http:="" download.macromedia.com…="" width="800" height="270">
							<param name="movie" value="Anima/topo.swf">
							<param name="quality" value="high">
							<param name="wmode" value="transparent">
							<embed wmode="transparent" src="http://brasilmaplestory.com//img/animacoes/mush.swf" quality="high" pluginspage="http://www.macromedia.com/s… type=" application="" x-shockwave-flash"="" width="84" height="61" >
						</object>
					</div>
					
					<div class="error_EXCEDED_NUMBER_OF_TERMS" style="display: none">
						<h3>Ops... Seja mais específico. A sua busca está muito grande!</h3>
					</div>
					<script type="text/javascript">			
						$(document).ready(function() {
							$.getJSON( "<?php echo LOCAL_PATH; ?>ajax/search.php", {query: "<?php echo $_GET['query']; ?>"},  function( data ) {
								var mobs = [];
								var items = [];
								var equips = [];
								var maps = [];
								var npcs = [];
								var wz_questdata = [];
								
								$.each( data, function( key, val ) {
									switch(val["type"]) {
										case "error":
											if(val["error_type"] == "EXCEDED_NUMBER_OF_TERMS") {
												$(".error_EXCEDED_NUMBER_OF_TERMS").show();
												$(".loading-content").hide();
											}
										break;
										case "mobs":
											mobs.push(val);
											break;
										case "items":
											items.push(val);
											break;
										case "equips":
											equips.push(val);
											break;
										case "maps":
											maps.push(val);
											break;
										case "npcs":
											npcs.push(val);
											break;
										case "wz_questdata":
											wz_questdata.push(val);
											break;
										default:
										break;
									}
								});
								
								var mobsHtml = "";
								if( mobs != "" ) {
									mobsHtml += "<div class='result-content'><div class='result_type_header'>RESULTADOS PARA MONSTROS <span class='glyphicon glyphicon-collapse-down pull-right' style='margin-right: 10px;margin-top: 2px;'></span></div><div class='result_type_results'>";
									for(var i=0;i < mobs.length;i++) {
										mobsHtml += '<table class="table table-bordered result_item"><tr><td class="table_image-item"><img src="'+mobs[i]["cachedIcon"]+'" /></td><td colspan="2"><a href="'+mobs[i]["singleLink"]+'">'+mobs[i]["name"]+'</a></td></tr><tr><td colspan="3"><a href="'+mobs[i]["singleLink"]+'" style="font-size: 13px">Ver Tudo Sobre Este Monstro</a></td></tr></table>';
									}
									mobsHtml += "</div></div>";
								}
								var itemsHtml = [];
								if(items != "") {
									itemsHtml += "<div class='result-content'><div class='result_type_header'>RESULTADOS PARA ITENS <span class='glyphicon glyphicon-collapse-down pull-right' style='margin-right: 10px;margin-top: 2px;'></span></div><div class='result_type_results'>";
									for(var i=0;i < items.length;i++) {
										itemsHtml += '<table class="table table-bordered result_item"><tr><td class="table_image-item"><img src="'+items[i]["cachedIcon"]+'" /></td><td colspan="2"><a href="'+items[i]["singleLink"]+'">'+items[i]["name"]+'</a></td></tr><tr><td colspan="3"><a href="'+items[i]["singleLink"]+'" style="font-size: 13px">Ver Tudo Sobre Este Item</a></td></tr></table>';
									}
									itemsHtml += "</div></div>";
								}
								var equipsHtml = [];
								if(equips != "") {
									equipsHtml += "<div class='result-content'><div class='result_type_header'>RESULTADOS PARA EQUIPAMENTOS <span class='glyphicon glyphicon-collapse-down pull-right' style='margin-right: 10px;margin-top: 2px;'></span></div><div class='result_type_results'>";
									for(var i=0;i < equips.length;i++) {
										equipsHtml += '<table class="table table-bordered result_item"><tr><td class="table_image-item"><img src="'+equips[i]["cachedIcon"]+'" /></td><td colspan="2"><a href="'+equips[i]["singleLink"]+'">'+equips[i]["name"]+'</a></td></tr><tr><td colspan="3"><a href="'+equips[i]["singleLink"]+'" style="font-size: 13px">Ver Tudo Sobre Este Item</a></td></tr></table>';
									}
									equipsHtml += "</div></div>";
								}
								var mapsHtml = [];
								if(maps != "") {
									mapsHtml += "<div class='result-content'><div class='result_type_header'>RESULTADOS PARA MAPAS <span class='glyphicon glyphicon-collapse-down pull-right' style='margin-right: 10px;margin-top: 2px;'></span></div><div class='result_type_results'>";
									for(var i=0;i < maps.length;i++) {
										mapsHtml  += '<table class="table table-bordered result_item"><tr><td class="table_image-item"><img src="'+maps[i]["cachedIcon"]+'" /></td><td colspan="2"><a href="'+maps[i]["singleLink"]+'">'+maps[i]["mapName"]+'</a></td></tr><tr><td colspan="3"><a href="'+maps[i]["singleLink"]+'" style="font-size: 13px">Ver Tudo Sobre Este Item</a></td></tr></table>';
									}
									mapsHtml += "</div></div>";
								}
								var npcsHtml = [];
								if(npcs != "") {
									npcsHtml += "<div class='result-content'><div class='result_type_header'>RESULTADOS PARA NPCS <span class='glyphicon glyphicon-collapse-down pull-right' style='margin-right: 10px;margin-top: 2px;'></span></div><div class='result_type_results'>";
									for(var i=0;i < npcs.length;i++) {
										npcsHtml += '<table class="table table-bordered result_item"><tr><td class="table_image-item"><img src="'+npcs[i]["cachedIcon"]+'" /></td><td colspan="2"><a href="'+npcs[i]["singleLink"]+'">'+npcs[i]["name"]+'</a></td></tr><tr><td colspan="3"><a href="'+npcs[i]["singleLink"]+'" style="font-size: 13px">Ver Tudo Sobre Este Item</a></td></tr></table>';
									}
									npcsHtml+= "</div></div>";
								}
								var wz_questdataHtml = [];
								if(wz_questdata != "") {
									wz_questdataHtml += "<div class='result-content'><div class='result_type_header'>RESULTADOS PARA MISSÕES <span class='glyphicon glyphicon-collapse-down pull-right' style='margin-right: 10px;margin-top: 2px;'></span></div><div class='result_type_results'>";
									for(var i=0;i < wz_questdata.length;i++) {
										wz_questdataHtml += '<table class="table table-bordered result_item"><tr><td colspan="3"><a href="'+wz_questdata[i]["singleLink"]+'">'+wz_questdata[i]["name"]+'</a></td></tr><tr><td colspan="3"><a href="'+wz_questdata[i]["singleLink"]+'" style="font-size: 13px">Ver Tudo Sobre Este Item</a></td></tr></table>';
									}
									wz_questdataHtml += "</div></div>";
								}
								
								$(".loading-content").hide();
								
								if(equips == "" && items == "" && maps == "" && mobs == "" && npcs == "" && wz_questdata == "") {
									$(".response").html("<h3>Nenhum resultado encontrado</h3>");
								} else {
									$(".response").html(mobsHtml+itemsHtml+equipsHtml+mapsHtml+npcsHtml+wz_questdataHtml);
								}
								
								$(".result_type_header").on("click",function() {
									$(this).next().stop().slideToggle();
								});
							});
						});
					</script>
					
					<div class="response"></div>
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