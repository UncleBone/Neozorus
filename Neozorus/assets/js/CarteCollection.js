$(function(){
	//fonction aui affiche aune aura au survol d'une carte
	function cardStyle(card){
		$(card).toggleClass('hoverCard');
	}
	//permet de cliker sur une image pour l'agrandir
	function callback(){
		//on recupere toutes nos images et on applique une aura au survol
		$('.mesGabarits img').hover(function(){
			cardStyle($(this));
		});
		//Si on clique sur une image...
		$('.mesGabarits').on('click',function(){
			//On recupere dans un tableau les enfants de la div (soit 1 image et 3 spans pour les creature et speciale, ou 2 span pour les sorts)
			let mesSpan = $(this).children();
			//on supprime la div zoomCard si elle existe deja
			$('#zoomCard').remove();
			//On affiche un effet de flou en arriere plan
			$('#conteneur').css('filter','blur(5px)');
			//on recupere l'image de la div
			let img =$(mesSpan[0]);
			//Si on clic sur la div qui affiche l'image en gros...
			$('<div id="zoomCard"></div>').click(function(){
				//on supprime la div
				$('#zoomCard').remove();
				//on enleve l'effet de flou
				$('#conteneur').css('filter','blur(0px)');
			}).appendTo($('body'));//enfin on implemente cette div dans le body
			img.clone().appendTo($('#zoomCard'));//on clone l'image de la miniature et on la clone dans la div Zoom
			//on regarde si la carte est une carte speciale ou non, car en fonction les stats ne sont pas affiché au meme endroit
			if($(mesSpan[1]).attr('data-speciale') == 'non'){
				//on ajoute les span qui affiche les stats, en recuperant les valeurs dans les span de la div minaiture
				$('<span class="stat1Zoom">'+$(mesSpan[1]).text()+'</span>').appendTo('#zoomCard');
				$('<span class="stat2Zoom">'+$(mesSpan[2]).text()+'</span>').appendTo('#zoomCard');
				//Si c'est un sort il n'y a pas de stat 3 , donc on verifie
				if(mesSpan.length == 4){
					$('<span class="stat3Zoom">'+$(mesSpan[3]).text()+'</span>').appendTo('#zoomCard');
				}
			}
			else{
				//on ajoute les span qui affiche les stats, en recuperant les valeurs dans les span de la div minaiture
				$('<span class="stat1SpecialeZoom">'+$(mesSpan[1]).text()+'</span>').appendTo('#zoomCard');
				$('<span class="stat2SpecialeZoom">'+$(mesSpan[2]).text()+'</span>').appendTo('#zoomCard');	
				$('<span class="stat3SpecialeZoom">'+$(mesSpan[3]).text()+'</span>').appendTo('#zoomCard');		
			}
		});
	}
	//Requete AJAX, au changement d'un select, on recharge la div de classe affichagecarte
	$('select').on('change',function(){
		let idHero = $('#hero').val();
		let type = $('#type').val();
		let coutMana = $('#mana').val();
		let idPouvoir = $('#pouvoir').val();
		let tri = $('#tri').val();
		$('.affichageCarte').load('index.php?controller=carte&action=afficherCollectionCarte&ajax=1&idHero='+idHero+'&type='+type+'&mana='+coutMana+'&idPouvoir='+idPouvoir+'&tri='+tri,callback);
	})
	//On appelle la fonction qui gere les effets dynaliques sur les cartes
	callback();
});