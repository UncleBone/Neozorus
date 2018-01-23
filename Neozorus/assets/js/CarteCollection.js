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

	// fonction de chargement des cartes en fonction des paramètres sélectionnés
	function loadFilteredView(){
		let parameters = '';
		
		$('#filter').find('.selected').each(function(){
			parameters += '&' + $(this).parent().attr('id') + '=' + $(this).attr('data');
		});
		$('.affichageCarte').load('.?controller=carte&action=afficherCollectionCarte&ajax=1'+parameters);

		styleFilters();
	}

	function styleFilters(){

		$('#type').children().each(function(){
			let src = $(this).attr('src');
			let regex = new RegExp('(.*_)[123](\.png)', 'i');
			if($(this).hasClass('selected')){
				$(this).attr('src', src.replace(regex, '$1'+1+'$2'));
			}else{
				$(this).attr('src', src.replace(regex, '$1'+3+'$2'));
			}
		});

		$('#type').children().mousedown(function(){
			let src = $(this).attr('src');
			let regex = new RegExp('(.*_)[123](\.png)', 'i');

			$(this).attr('src', src.replace(regex, '$1'+2+'$2'));			
		});

		$('#mana').children().each(function(){
			let src = $(this).find('img').attr('src');
			let regex = new RegExp('(.*pilluleBleue).*(\.png)', 'i');

			if($(this).hasClass('selected')){
				$(this).find('img').attr('src', src.replace(regex, '$1$2'));
			}else{
				$(this).find('img').attr('src', src.replace(regex, '$1Vide$2'));
			}
		});
	}
});