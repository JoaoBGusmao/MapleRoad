<!DOCTYPE html>

<?php
	require_once("./inc/config.php");
	require_once("./inc/classes/class.item.php");
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
					if(isset($_GET["type"])) $type = $_GET["type"];
					else $type = "";
					if(isset($_GET["sub"])) $sub = $_GET["sub"];
					else $sub = "";
					?>
					<ol class="breadcrumb">
					  <li><a href="<?php echo LOCAL_PATH; ?>">Database</a></li>
					  <li class="active">Itens</li>
					</ol>
					<?php if($type == "itens") { ?>
						<?php
						if($sub == "pergaminhos") { ?>
							<div style="text-align: center">
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-10" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/pergaminho-para-defesa-com-o-capacete2.png">10%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-15" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/pergaminho-para-defesa-com-a-parte-de-baixo-da-roupa5.png">15%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-20" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/5yranniv-scroll-for-cape-for-luk-20.png">20%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-30" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/scroll-for-helmet-for-dex-30.png">30%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-40" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/4o-aniv-pergaminho-para-ataque-com-a-maca-de-uma-mao.png">40%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-50" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/scroll-for-helmet-for-hp-50.png">50%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-60" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/pergaminho-para-hp-com-o-acessorio-de-rosto1.png">60%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-65" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/scroll-for-topwear-for-hp-65.png">65%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-70" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/pergaminho-negro-para-esquiva-com-o-acessorio-de-rosto1.png">70%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-100" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/pergaminho-para-defesa-com-o-capacete.png">100%</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos-outros" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/balrogs-twilight-scroll-5.png"> Outros</a>
								<a href="<?php echo LOCAL_PATH; ?>list/itens/pergaminhos" class="btn btn-default sub_opt-bt" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/pergaminho-branco.png">Todos</a>
							</div>
						<?php } ?>
						
						<?php
						if($sub == "livros") { ?>
							<div style="text-align: center">
							<a href="<?php echo LOCAL_PATH; ?>list/itens/livros_de_pericia" class="btn btn-default sub_opt-bt2" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/livro-de-pericia-heroi-maple.png"> Livros de Perícia</a>
							<a href="<?php echo LOCAL_PATH; ?>list/itens/livros_de_maestria" class="btn btn-default sub_opt-bt2" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/livro-de-maestria-monstro-de-Ima.png"> Livros de Maestria</a>
							</div>
						<?php } ?>
						<?php
						if($sub == "recarregaveis") { ?>
							<div style="text-align: center">
							<a href="<?php echo LOCAL_PATH; ?>list/itens/shurikens" class="btn btn-default sub_opt-bt3" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/shuriken-ilbi.png"> Shurikens</a>
							<a href="<?php echo LOCAL_PATH; ?>list/itens/arcos" class="btn btn-default sub_opt-bt3" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/flecha-de-bronze-para-arco.png"> Arcos</a>
							<a href="<?php echo LOCAL_PATH; ?>list/itens/balas" class="btn btn-default sub_opt-bt3" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/shiner-bullet.png"> Balas</a>
							</div>
						<?php } ?>
					<?php } ?>
					
					<?php if($type == "equipamentos") { ?>
						<?php
						if($sub == "acessorios") { ?>
							<div style="text-align: center">
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/brincos" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/brincos-de-ametista.png"> Brinco</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/acessorios_para_face" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/picole-de-morango.png"> Acessório Para Face</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/acessorios_para_olho" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/Oculos-do-arqueologista1.png"> Acessório Para Olho</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/cintos" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/faixa-vermelha.png"> Cinto</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/medalhas" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/medalha-das-aventuras-de-verao-de-2009-masculino-.png"> Medalha</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/pingentes" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/colar-de-cauda-com-chifre.png"> Pingente</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/aneis" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/gold-heart-ring-1carats.png"> Anel</a>
							</div>
						<?php } ?>
						
						<?php
						if($sub == "vestimento") { ?>
							<div style="text-align: center">
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/chapeus" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/incrivel-capacete-marrom.png"> Chapéu</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/luvas" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/luvas-de-trabalho.png"> Luva</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/casacos" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/camiseta-linha-Unica-azul.png"> Casaco</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/macacoes" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/roupao-de-sauna-azul.png"> Macacão</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/calcas" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/calca-de-artes-marciais-marrom.png"> Calça</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/escudos" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/certa-gatuna.png"> Escudo</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/sapatos" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/bota-aroa-verde.png"> Sapatos</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/capas" class="btn btn-default sub_opt-bt4" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/capa-gaia-vermelha.png"> Capa</a>
							</div>
						<?php } ?>
						
						<?php
						if($sub == "armas") { ?>
							<div style="text-align: center">
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/espadas_de_uma_mao" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/espada-cutlus.png"> Espada de Uma Mão</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/espadas_de_duas_maos" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/zard.png"> Espada de Duas Mãos</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/machados_de_uma_mao" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/balrogs-vifennis-.png"> Machado de Uma Mão</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/machados_de_duas_maos" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/machado-colonial.png"> Machado de Duas Mãos</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/macas_de_uma_mao" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/timeless-flame.png"> Maça de Uma Mão</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/macas_de_duas_maos" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/taco-de-madeira1.png"> Maça de Duas Mãos</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/lancas" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/garfo-no-palito.png"> Lança</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/lancas_de_batalha" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/alabarda-guan-yu.png"> Lança de Batalha</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/arcos" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/hinkel-vermelho.png"> Arco</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/bestas" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/corvo-dourado.png"> Besta</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/varinhas" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/varinha-dimon.png"> Varinha</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/cajados" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/cajado-circular.png"> Cajado</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/garras" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/maple-skanda.png"> Garra</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/adagas" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/cauda-de-dragao.png"> Adaga</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/armas" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/1492008.png"> Arma</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/soqueiras" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/steel-knuckle.png"> Soqueira</a>
							</div>
						<?php } ?>
						
						<?php
						if($sub == "montarias") { ?>
							<div style="text-align: center">
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/montarias" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/porco.png"> Montaria</a>
								<a href="<?php echo LOCAL_PATH; ?>list/equipamentos/selas" class="btn btn-default sub_opt-bt5" aria-expanded="false"><img src="<?php echo LOCAL_PATH; ?>img/equips/icon/sela.png"> Selas</a>
							</div>
						<?php } ?>
					<?php } ?>
			</div>
			
			<?php require_once("./inc/website_includes/sidebar-ad.php"); ?>
		</div>
		
		<?php require_once("./inc/website_includes/footer.php"); ?>
  </body>
</html>