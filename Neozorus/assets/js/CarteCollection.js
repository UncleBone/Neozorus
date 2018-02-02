$(function(){

	zoom();
	editDeckName();

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
		
		loadFilteredView();	// charge la vue

	});

	// Gère l'édition du nom de deck
	function editDeckName(){
		// au click, transforme le champ du nom en input éditable
		$('#deckName span').click(function(){
			let name = $(this).text();
			let input = $('<input>').val(name).attr('data_origin', name).css('cursor','default');
			$(this).replaceWith(input);
			input.focus();
			// à l'édition, activation et mise en forme du bouton 'modifier'
			input.on('input',function(){ 
				if($(this).val() != name){
					$('#deckName button').css('cursor', 'pointer').css('color', 'rgb(194,210,1)').hover(function(){
						$(this).css('color', 'white');
					}, function(){
						$(this).css('color', 'rgb(194,210,1)');
					});
					let newName = $(this).val();
					// $('#deckName button').click( { 'newName' :  newName }, submitName);
					console.log(newName);
					$('#deckName button').off('click');
					$('#deckName button').click( function(){
						
						console.log(newName+'click');
						$.post('.?controller=deck&action=changeName&deckId='+$('#deckName').attr('data_id'), { 'newName' :  newName }, function(result){
							resetDeckName('', newName);
							// if(!$.isArray(result)){
							// 	resetDeckName('', newName);
							// }else{
							// 	console.log(result);
							// }			
						});
					});

				}else{
					$('#deckName button').css('cursor', 'default').css('color', 'rgb(150,150,150)').hover(function(){
						$(this).css('color', 'rgb(150,150,150)');
					}, function(){
						$(this).css('color', 'rgb(150,150,150)');
					});
				}
				// editDeckName();
			});

			$('#deckName input').focusout(function(event){
				resetDeckName(event,name);
			});
		});	
	}

	// désactive l'input modifiable + mise en forme bouton
	function resetDeckName(event,name){
		if(event == '' || $(event.relatedTarget).prop('nodeName') != 'BUTTON'){
			let span = $('<span>').text(name);
			$('#deckName input').replaceWith(span);
			$('#deckName button').css('cursor', 'default').css('color', 'rgb(150,150,150)').hover(function(){
					$(this).css('color', 'rgb(150,150,150)');
				}, function(){
					$(this).css('color', 'rgb(150,150,150)');
				});
		}
		editDeckName();
	}

	// envoir la requête ajax pour un changement de nom de deck et gère la réponse
	// function submitName(e,name){
	// 	console.log(name);
	// 	$.post('.?controller=deck&action=changeName', name, function(result){
	// 		console.log(result);
	// 	});
	// }

	// fonction de chargement des cartes sélectionnées + mise en forme des boutons de filtre
	function loadFilteredView(){
		let parameters = '';
		
		$('#filter').find('.selected').each(function(){
			parameters += '&' + $(this).parent().attr('id') + '=' + $(this).attr('data');
		});
		if($('#deckName').length > 0 ){
			$('#cartes').load('.?controller=carte&action=displayDeckCards&deckId='+$('#deckName').attr('data_id')+'&ajax=1'+parameters,zoom);
		}else{
			$('#cartes').load('.?controller=carte&action=displayCards&ajax=1'+parameters,zoom);
		}
		styleFilters();
	}

	// Mise en forme des boutons en fonction de leur état (sélectionné ou nom) + effet de click 
	function styleFilters(){
		
		// image des boutons type
		$('#type').children().each(function(){
			let src = $(this).attr('src');
			let regex = new RegExp('(.*_)[123](\.png)', 'i');
			if($(this).hasClass('selected')){
				$(this).attr('src', src.replace(regex, '$1'+1+'$2'));
			}else{
				$(this).attr('src', src.replace(regex, '$1'+3+'$2'));
			}
		});

		// effet de click sur les boutons type
		$('#type').children().mousedown(function(){
			let src = $(this).attr('src');
			let regex = new RegExp('(.*_)[123](\.png)', 'i');

			$(this).attr('src', src.replace(regex, '$1'+2+'$2'));			
		});

		// image des boutons mana
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

	// Zoom sur les cartes survolées
	function zoom(){
	var timer;

	$('.carte').hover(function(){
		var target = $(this);
		timer = setTimeout(function(){
			let src = target.find('img').attr('src');
			let regex = new RegExp('carte (.*)', 'i');
			let type = target.attr('class').replace(regex, '$1');
			let pv =  target.find('.pv').text();
			let puissance =  target.find('.puissance').text();
			let manaCost =  target.find('.manaCost').text();
			let leftOrigin = target.position().left;
			let topOrigin = target.position().top;
			
			let newDiv = $('<div>');
			let newImg = $('<img>');
			let newSpanPv = $('<span>');
			let newSpanPuissance = $('<span>');
			let newSpanMana = $('<span>');

			newImg.attr('src', src);
			newImg.css('max-width', '100%');
			newSpanPv.text(pv);
			newSpanPv.addClass('pv');
			newSpanPuissance.text(puissance);
			newSpanPuissance.addClass('puissance');
			newSpanMana.text(manaCost);
			newSpanMana.addClass('manaCost');

			newDiv.append(newImg);
			newDiv.append(newSpanPv);
			newDiv.append(newSpanPuissance);
			newDiv.append(newSpanMana);
			newDiv.css('position', 'absolute');
			if(parseInt(leftOrigin+target.width()/2) < $(window).width()/2){
				newDiv.css('left', parseInt(leftOrigin+220)+'px');
			}else{
				if($(window).height()>500){
					newDiv.css('left', parseInt(leftOrigin-300)+'px');
				}else{
					newDiv.css('left', parseInt(leftOrigin-250)+'px');
				}
			}
			if($(window).height()>500){
				newDiv.css('width', '300px');
				newDiv.css('top', '20vh');
				newDiv.addClass('zoom');
			}else{
				newDiv.css('width', '200px');
				newDiv.css('top', '50vh');
				newDiv.css('transform', 'translateY(-50%)');
				newDiv.addClass('zoom_200');
			}
			
			newDiv.css('z-index', '1');
			newDiv.addClass(type);
			
			$('main').append(newDiv);
		}, 1000);
	}, function(){
		$('[class^=zoom]').remove();
		clearTimeout(timer);
	});
	}	
});