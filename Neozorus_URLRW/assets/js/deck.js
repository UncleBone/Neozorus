$(function(){
	$('.bottomButtons input[value=Voir]').click(function(event){
		event.preventDefault();
		id = $('form select option').val();
		window.location.replace('.?controller=carte&action=displayDeckCards&deckId='+id);
	});
	$('.bottomButtons input#PvP').click(function(event){
		event.preventDefault();
		id = $('form select option').val();
		window.location.replace('.?controller=game&action=wait&id='+id);
	});
	$('.bottomButtons input#solo').click(function(event){
		event.preventDefault();
		id = $('form select option').val();
		window.location.replace('.?controller=game&action=playVsIA&id='+id);
	});
});