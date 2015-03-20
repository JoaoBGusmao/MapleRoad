<script type="text/javascript">
	$(".main-sidebar-ul a").click( function() {
		var subItem = $(this).parent().children().next();
		if(subItem != "undefined") {
			subItem.stop().slideToggle();
			//alert(subItem.attr("class"));
		}
	});
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-24355935-8', 'auto');
  ga('send', 'pageview');

</script>

<div class="row rodape">
	<div class="container">
		<p>Copyright ©2014 MapleRoad.</p>
		<p>Parte das imagens utilizadas neste website são de propriedades de Nexon Corp.</p>
	</div>
</div>