<?php
/*
	This file is part of MapleRoad
	Copyright (C) 2015 João Gusmão
	
	This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/
?>
<div class="col-md-2 sidebar">
	<div class="row">
		<ul class="nav nav-pills nav-stacked main-sidebar-ul">
			 <li role="presentation" class="active" style="margin-left: -15px;"><a>Database</a></li>
			  <li role="presentation"><a>Classes <span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></a>
				<ul class="nav nav-pills nav-stacked sub-cat" style="display: none">
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>classe/aprendiz">Aprendiz</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>classe/guerreiro">Guerreiro</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>classe/mago">Mago</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>classe/arqueiro">Arqueiro</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>classe/gatuno">Gatuno</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>classe/pirata">Pirata</a></li>
				</ul>
			  </li>
			  <li role="presentation"><a><img src="<?php echo LOCAL_PATH; ?>img/equips/iconRaw/espada-fraute.png" />Equipamentos <span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></a>
				<ul class="nav nav-pills nav-stacked sub-cat" style="display: none">
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>sub_opt/equipamentos/acessorios"><img src="<?php echo LOCAL_PATH; ?>img/equips/iconRaw/brincos-de-ouro.png" />Acessórios</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>sub_opt/equipamentos/vestimento"><img src="<?php echo LOCAL_PATH; ?>img/equips/iconRaw/camiseta-branca.png" />Vestimento</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>sub_opt/equipamentos/armas"><img src="<?php echo LOCAL_PATH; ?>img/equips/iconRaw/machado-de-aco-maple.png" />Armas</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>sub_opt/equipamentos/montarias"><img src="<?php echo LOCAL_PATH; ?>img/equips/iconRaw/porco.png" />Montaria</a></li>
				</ul>
			  </li>
			  <li role="presentation"><a><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/pocao-branca.png" />Uso <span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></span></a>
				<ul class="nav nav-pills nav-stacked sub-cat" style="display: none">
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/pocoes"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/pocao-vermelha.png" />Poções</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>sub_opt/itens/pergaminhos"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/pergaminho-para-defesa-com-o-capacete2.png" />Pergaminhos</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/pergas_de_retorno"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/pergaminho-de-retorno-cidade-mais-proxima.png" />Pergaminhos de Retorno</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>sub_opt/itens/recarregaveis"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/shuriken-tobi.png" />Recarregáveis</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>sub_opt/itens/livros"><img src="<?php echo LOCAL_PATH; ?>img/items/icon/livro-de-pericia-heroi-maple.png" />Livros</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/carta_de_monstro"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/snail-card.png" />Carta de Monstro</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/uso_outros"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/ponto-de-folia-1.png" />Outros</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/uso_todos"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/caldeirao-mistico-de-subani.png" />Todos</a></li>
				</ul>
			  </li>
			  <li role="presentation"><a><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/debaixo-da-Arvore-maple.png" />Preparação <span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></a>
				<ul class="nav nav-pills nav-stacked sub-cat" style="display: none">
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/cadeiras"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/travesseiro-de-foca-azul.png" />Cadeiras</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/enfeites_de_natal"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/enfeite-circular-de-Arvore.png" />Enfeites de Natal</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/prep_outros"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/chip-de-memoria-do-agente-w.png" />Outros</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/prep_todos"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/cristal-de-gelo.png" />Todos</a></li>
				</ul>
			  </li>
			  <!---<li role="presentation"><a><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/megamensagem.png" />CashShop <span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></a>
				<ul class="nav nav-pills nav-stacked sub-cat" style="display: none">
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/cadeiras"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/travesseiro-de-foca-azul.png" />Cadeiras</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/enfeites_de_natal"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/enfeite-circular-de-Arvore.png" />Enfeites de Natal</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/prep_outros"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/chip-de-memoria-do-agente-w.png" />Outros</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/itens/prep_todos"><img src="<?php echo LOCAL_PATH; ?>img/items/iconRaw/cristal-de-gelo.png" />Todos</a></li>
				</ul>
			  </li>--->
			  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>mapas/mundo"><img src="<?php echo LOCAL_PATH; ?>img/maps/worldMap/worldmap000.png" />Mapa Mundi</a></li>
			  <li role="presentation"><a><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/cogumelo.png" />Monstros <span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></a>
				<ul class="nav nav-pills nav-stacked sub-cat" style="display: none">
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/monstros/chefes"><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/manon.png" />Bosses</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros/1/10"><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/caracol-azul.png" />Nível 1~10</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros/10/30"><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/cogumelo-verde.png" />Nível 10~30</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros/30/80"><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/ursinho-de-pelucia.png" />Nível 30~80</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros/80/120"><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/kentauro-vermelho.png" />Nível 80~120</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros/130/160"><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/chief-oblivion-guardian.png" />Nível 120~160</a></li>
					  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/monstros/monstros/160/200"><img src="<?php echo LOCAL_PATH; ?>img/mobs/stand0/musculoso-de-pedra-negro.png" />Nível 160~200</a></li>
				</ul>
			  </li>
			  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/missoes"><img src="<?php echo LOCAL_PATH; ?>img/static/questIcon.png" />Missões</a></li>
			  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>list/npcs"><img src="<?php echo LOCAL_PATH; ?>img/npcs/default/cody.png" />NPCs</a></li>
		</ul>
		
		<ul class="nav nav-pills nav-stacked main-sidebar-ul">
			 <li role="presentation" class="active" style="margin-left: -15px;"><a>Guias</a></li>
			  <li role="presentation"><a href="<?php echo LOCAL_PATH; ?>paginas/tabela-de-experiencia">Tabela de Experiência</a></li>
			  <li role="presentation"><a>Missões de Grupo <span class="glyphicon glyphicon-chevron-right pull-right" aria-hidden="true"></a>
				<ul class="nav nav-pills nav-stacked sub-cat" style="display: none">
					  <li role="presentation"><a href=""><img src="<?php echo LOCAL_PATH; ?>img/npcs/default/tory.png" />HPQ</a></li>
					  <li role="presentation"><a href=""><img src="<?php echo LOCAL_PATH; ?>img/npcs/default/lakelis.png" />KPQ</a></li>
					  <li role="presentation"><a href=""><img src="<?php echo LOCAL_PATH; ?>img/npcs/default/spiegelmann.png" />CPQ</a></li>
					  <li role="presentation"><a href=""><img src="<?php echo LOCAL_PATH; ?>img/npcs/default/fada-wonky.png" />OPQ</a></li>
					  <li role="presentation"><a href=""><img src="<?php echo LOCAL_PATH; ?>img/npcs/default/shuang.png" />GPQ</a></li>
					  <li role="presentation"><a href=""><img src="<?php echo LOCAL_PATH; ?>img/npcs/default/so-gong.png" />DOJO</a></li>
				</ul>
			  </li>
		</ul>
	</div>
</div>