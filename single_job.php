<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.skill.php");
	require_once("./inc/classes/class.searchEngine.php");
	$searchEngine = new searchEngine;
	$noError = true;
	$job = $_GET["url"];
	$jobId = $searchEngine->getJobIdByUrl($job);
	$jobName = $searchEngine->getJobById($jobId);
	
	if($jobId == null) $noError = false;
?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title><?php echo $jobName; ?> | MapleRoad</title>
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
				
					<?php
						$jobId = $searchEngine->getJobIdByUrl($job);
						$skillsForJob = $searchEngine->getSkillByJobId($jobId);
						$count = 0;
					?>
					<ol class="breadcrumb">
					  <li><a href="#">Database</a></li>
					  <li><a href="#">Classes</a></li>
					  <li class="active"><?php echo $searchEngine->getJobById($jobId); ?></li>
					</ol>
					<?php
						$job = substr($jobId, 0, 1);
						
						//Find how much jobs
						$jobNum = 0; for($i=0;$i<3;$i++) { if($searchEngine->getJobById($job*100*$i) != "" ) $jobNum++; }
					?>
					
					
					<table class="table borderless result_item" style="text-align:center;border:1px solid #ddd">
						<?php 
							$fColor = "";
							for($i=0;$i<$jobNum;$i++) {
								$firstJob = ($job*100);
								echo "<tr>";
									if($i == 0) {
										if($firstJob == $jobId) $fColor = "bold";
										echo "<td class='$fColor' rowspan='".$jobNum."'><a href='".LOCAL_PATH."classe/".$searchEngine->getJobUrlById($firstJob)."'>".$searchEngine->getJobById($firstJob)."</a></td>";
									}
									for($j=0;$j<3;$j++) {
										echo "<td>></td>";
										$secondJob = $firstJob+1*$j;
										$thirdJob = $secondJob+10*($i+1);
										if($thirdJob == $jobId) $fColor = "bold";
										else $fColor = "";
										echo "<td class='$fColor'><a href='".LOCAL_PATH."classe/".$searchEngine->getJobUrlById($thirdJob)."'>".$searchEngine->getJobById($thirdJob)."</a></td>";
									}
								echo "</tr>";
							}
						?>
					</table>
					
					<?php
						foreach($skillsForJob as $skills) {
							$skill = new skill($skills["skillid"],"",$skills);
							?>
							
							<?php
								if($count < 0) {
							?>
							<table class="table table-bordered result_item">
								<tr>
									<th class="table_image-item"><img src="data:image/png;base64,<?php echo $skill->getIcon(); ?>" /></th>
									<th><?php echo $skill->getBookName(); ?></th>
								</tr>
							</table>
							<?php
								} else {
							?>
							<table class="table table-bordered result_item">
								<tr>
									<td rowspan="2" class="table_image-item"><img src="data:image/png;base64,<?php echo $skill->getIcon(); ?>" /></td>
									<td colspan="2"><strong><?php echo $skill->getName(); ?></strong></td>
								</tr>
								<tr>
									<td><strong>Nível Máximo: </strong><?php echo $skill->getMasterLevel(); ?></td>
									<td><strong>Tipo: </strong>Passivo</td>
								</tr>
								<tr>
									<td colspan="3" class="align-center"><strong>Descrição: </strong><?php echo $skill->getRdesc(); ?></td>
								</tr>
								
								<?php
									for($i=0;$i<30;$i++) {
								?>
									<?php 
										if(call_user_func(array( $skill, "getH".($i+1)."" ))) {
									?>
									<tr>
										<td class="skill-line_level" colspan="3"><strong>Level <?php echo $i+1; ?>: </strong><?php echo call_user_func(array( $skill, "getH".($i+1)."" )); ?></td>
									</tr>
									<?php
										} 
									?>
								<?php 
									}
								?>
							</table>
							<?php } ?>
						<?php	
							$count++;
						}
					?>
				<div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_HOST'].$_SERVER["REQUEST_URI"]; ?>" data-numposts="15" data-colorscheme="light" data-width="100%"></div>
				<?php } else { ?>
					<h1>Classe não encontrada</h1>
				<?php } ?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
<div class="monster_hover" style="position:absolute;top:0;left:0;display:none;background: white;text-align: center;border: 1px solid #CCC"></div>

<script type="text/javascript">
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