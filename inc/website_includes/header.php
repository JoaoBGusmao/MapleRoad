<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand visible-xs" href="#">MapleRoad</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
			<li class="active"><a href="<?php echo LOCAL_PATH; ?>">Home</a></li>
			<li><a href="http://forum.brasilmaplestory.com" target="_blank">Fórum</a></li>
			<li><a href="http://brasilmaplestory.com.br" target="_blank">Brasil MapleStory2</a></li>
			<li><a href="">Sobre Nós</a></li>
			</ul>
			<form action="<?php echo LOCAL_PATH; ?>search/" method="GET" class="navbar-form navbar-right" role="search">
				
				
				<div class="input-group">
					<input type="text" name="query" <?php if(isset($_GET['query'])) echo "value='".htmlspecialchars($_GET['query'])."'"; ?> class="form-control" placeholder="Busque Por Algo">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button" style="border-color: white"><span class="glyphicon glyphicon-search" aria-hidden="true" style="color:#285638"></span></button>
					</span>
				</div><!-- /input-group -->
				
			</form>
		</div><!--/.nav-collapse -->
	</div>
</nav>

<div class="container site-header">
	<a href="<?php echo LOCAL_PATH; ?>"><img src="<?php echo LOCAL_PATH; ?>img/static/mapleroadlogo.png" /></a>
</div>