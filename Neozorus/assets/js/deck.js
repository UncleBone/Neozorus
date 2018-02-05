$(function(){
	$('.bottomButtons input[value=Voir]').click(function(event){
		event.preventDefault();
		id = $('form select option').val();
		window.location.replace('.?controller=carte&action=displayDeckCards&deckId='+id);
	});
	$('.bottomButtons input[value=Jouer]').click(function(event){
		event.preventDefault();
		id = $('form select option').val();
		window.location.replace('.?controller=game&action=wait&id='+id);
	});
});