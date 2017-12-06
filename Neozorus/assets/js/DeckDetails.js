$(function(){

	function blocAppears(message){
		let bloc = $('<div class="popMessage" hidden >'+message+'</div>').appendTo('body');
		bloc.fadeIn(500).fadeOut(1000,function(){
			bloc.remove();
		});

	}
	//Si le nom du deck a ete changé en BDD, on modifie le nom du deck sur la page
	function changedNameCallback(result){
		let newName = JSON.parse(result);
		if(newName != ''){
			blocAppears('changement effectué');
			$('h1').text(newName);
			baseName = newName;
		}
	}

	function cardStyle(card){
		$(card).toggleClass('hoverCard');
	}

	$('.mesGabarits img').hover(function(){
		//on recupere toutes nos images et on applique une aura au survol
		cardStyle($(this));

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
				if(mesSpan.length == 5){
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
	});

	let baseName =$('#nameDeck').val();//On recupere le nom de base du deck

	//Quand on clic sur le boutton, on regarde la valeur de l'input et on effectue plusieurs verifications, si tout est Ok, 
	//on change le nom du deck en base de donné en AJAX
	$('#nameButton').on('click',function(){
		//On verifie que le nouveau nom soit different du nom de base
		if( $('#nameDeck').val()!= baseName){
			//On verifie que le nouveau nom ne soit pas vide
			if($('#nameDeck').val()!=''){
				//On verifie que le nouveau nom soit alphanumerique avec tirets et/ ou underscore, compris entre 3 et 60 caracteres
				if($('#nameDeck').val().match("^[a-zA-Z0-9-_]{"+DECK_NAME_MIN+","+DECK_NAME_MAX+"}$")){
					//On fait une requete AJAX pour changer le nom en BDD
					$.post('index.php?controller=deck&action=changeNameDeck&deck='+id,{newName:$('#nameDeck').val()},changedNameCallback);
				}
				else{
					alert('Le nom d\'un deck contient uniquement des caractères alphanumériques ou des tirets, et doit être compris entre '+DECK_NAME_MIN+' et '+DECK_NAME_MAX+' caractères');
				}
			}
			else{
				alert('Le nom d\'un deck ne doit pas être vide');
				$('#nameDeck').val(baseName);
			}
		}
		else{
			alert('Vous n\'avez pas changé de nom!');
		}
	});
	//Si on appuie sur Entree quand le focus est dans l'input, on declenche le changement de nom
	$('#nameDeck').on('focus',function(){
		$(this).on('keypress',function(e){
			if(e.which == 13){
				$('#nameButton').trigger('click');
			}
		});
	});
});