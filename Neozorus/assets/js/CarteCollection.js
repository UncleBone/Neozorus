$(function(){

	//  Ajoute la classe selected au filtre cliqué ou la retire si elle y est déjà 
	$('.select').children().click(function(){

		if($(this).hasClass('selected')){
			$(this).removeClass('selected');
		}else{
			$(this).siblings().each(function(){		// déselectionne les autres filtres de la même catégorie
				if($(this).hasClass('selected')){
					$(this).removeClass('selected');
				}
			});
			$(this).addClass('selected');
		}
		
		loadFilteredView();

		});

	// fonction de chargement des cartes en fonction des paramtres sélectionnés
	function loadFilteredView(){
		let parameters = '';
		$('#filter').children().find('.selected').each(function(){
			parameters += '&' + $(this).parent().attr('id') + '=' + $(this).attr('data');
		});
		$('.affichageCarte').load('.?controller=carte&action=afficherCollectionCarte&ajax=1'+parameters);
	}

});