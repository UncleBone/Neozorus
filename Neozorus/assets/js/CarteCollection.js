$(function(){

	function refreshView(data){
		$('.affichageCarte').html('');
		for(let carte in data){
			$('<div class="mesGabarits"><img src="'+carte.c_gabarit+'">');
		}
	}

	$('select').on('change',function(){
		let idHero = $('#hero').val();
		let type = $('#type').val();
		let coutMana = $('#mana').val();
		let idPouvoir = $('#pouvoir').val();
		$('.affichageCarte').load('index.php?controller=carte&action=afficherCollectionCarte&ajax=1&idHero='+idHero+'&type='+type+'&mana='+coutMana+'&idPouvoir='+idPouvoir);
	})
});