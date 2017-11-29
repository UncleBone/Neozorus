$(function(){
	//Si le nom du deck a ete changé en BDD, on modifie le nom du deck sur la page
	function changedNameCallback(result){
		let newName = JSON.parse(result);
		if(newName != ''){
			$('h1').text(newName);
			baseName = newName;
		}
	}

	let baseName =$('#nameDeck').val();//On recupere le nom de base du deck

	//Quand on clic sur le boutton, on regarde la valeur de l'input et on effectue plusieurs verifications, si tout est Ok, 
	//on change le nom du deck en base de donné en AJAX
	$('#nameButton').on('click',function(){
		//On verifie que le nouveau nom soit different du nom de base
		if( $('#nameDeck').val()!= baseName){
			//On verifie que le nouveau nom ne soit pas vide
			if($('#nameDeck').val()!=''){
				//On verifie que le nouveau nom soit alphanumerique avec tirets et/ ou underscore, compris entre 3 et 60 caracteres
				if($('#nameDeck').val().match("^[a-zA-Z0-9-_]{3,60}$")){
					//On fait une requete AJAX pour changer le nom en BDD
					$.post('index.php?controller=deck&action=changeNameDeck&deck='+id,{newName:$('#nameDeck').val()},changedNameCallback);
				}
				else{
					alert('Le nom d\'un deck contient uniquement des caractères alphanumériques ou des tirets, et doit être compris entre 3 et 60 caractères');
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