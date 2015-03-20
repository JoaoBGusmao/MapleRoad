$(document).ready(function(){
	$(".monster_link").mouseover( function() {
		$.post( "<?php echo LOCAL_PATH; ?>ajax/hover/monster_hover.php", {url: $(this).attr("attr-url") } ,function( data ) {
		  $( ".monster_hover" ).html( data );
		  $( ".monster_hover" ).stop().fadeIn();
		});
	});
	$(".monster_link").mouseout( function() {
		$( ".monster_hover" ).stop().fadeOut("fast");
	});
	$(".result_item").mouseout( function() {
		$( ".monster_hover" ).stop().fadeOut("fast");
	});
});
$(document).on('mousemove', function(e){
	$('.monster_hover').css({
	   left:  e.pageX+10,
	   top:   e.pageY+10
	});
});