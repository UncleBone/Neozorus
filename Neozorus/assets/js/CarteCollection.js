$(function(){
	function callback(){
	}
	let Card = $('.mesGabarits img');
	//Requete AJAX, au changement d'un select, on recharge la div de classe affichagecarte
	$('select').on('change',function(){
		let idHero = $('#hero').val();
		let type = $('#type').val();
		let coutMana = $('#mana').val();
		let idPouvoir = $('#pouvoir').val();
		let tri = $('#tri').val();
		$('.affichageCarte').load('index.php?controller=carte&action=afficherCollectionCarte&ajax=1&idHero='+idHero+'&type='+type+'&mana='+coutMana+'&idPouvoir='+idPouvoir+'&tri='+tri,callback);
	})

	Card.hover(function(){
		$(this).toggleClass('hoverCard');
	});
});