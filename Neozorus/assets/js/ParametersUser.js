$(function(){

	function changedCallback(result){
		let data = JSON.parse(result);
		if(data.newPseudo != undefined){
			switch (data.error) {
			  case 1:
			    	alert('Pseudo non valide, ne modifiez pas le code Javascript!');
			    	$('#pseudo').val(pseudo);
			    break;
			   case undefined:
			    	$('#pseudo').val(data.newPseudo);
					pseudo = data.newPseudo;
			   	break;
			}			
		}
		else if(data.newNom != undefined){
			switch (data.error) {
			  case 1:
			    	alert('Pseudo non valide, ne modifiez pas le code Javascript!');
			    	$('#nom').val(nom);
			    break;
			   case undefined:
			    	$('#nom').val(data.newNom);
					nom = data.newNom;
			   	break;
			}
		}
		else if(data.newPrenom != undefined){
			switch (data.error){
			  case 1:
			    	alert('Pseudo non valide, ne modifiez pas le code Javascript!');
			    	$('#prenom').val(prenom);
			    break;
			   case undefined:
			    	$('#prenom').val(data.newPrenom);
					prenom = data.newPrenom;
			   	break;
			}
		}
		else if(data.newMail != undefined){
			switch (data.error){
			  case 1:
			    	alert('Pseudo non valide, ne modifiez pas le code Javascript!');
			    	$('#mail').val(mail);
			    break;
			   case 2:
			    	alert('Cette adresse mail est associé à un autre utilisateur!');
			    	$('#mail').val(mail);
			    break;
			   case undefined:
			    	$('#mail').val(data.newMail);
					mail = data.newMail;
			   	break;
			}
		}

	}

	let pseudo =$('#pseudo').val();
	let mail =$('#mail').val();
	let nom =$('#nom').val();
	let prenom =$('#prenom').val();
	let dateNaissance =$('#dateNaissance').val();
	let question =$('#question').val();

	function isInputChanged(value, oldValue){
		if(value != oldValue){
			return true;
		}
		return false;
	}

	function isInputEmpty(value){
		if(value == ''){
			return true;
		}
		return false;
	}

	function isInputAlphaNumeric(value){
		if(value.match("^[a-zA-Z0-9-_]+$")){
			return true;
		}
		return false;
	}

	function isInputAlpha(value){
		if(value.match("^[a-zA-Z-]+$")){
			return true;
		}
		return false;
	}

	function isInputLengthBetween(value,min,max){
		if(value.length >= min && value.length <= max){
			return true;
		}
		return false;
	}

	function isInputMail(value){
		if(value.match("^[a-z0-9\._-]+@[a-z0-9\._]{2,}\.[a-z]{2,4}$")){
			return true;
		}
		return false;
	}


	function isInputValid(value,oldName,regex,min,max,key){
		if(isInputChanged(value, oldName)){
			if(!isInputEmpty(value)){
				if(isInputLengthBetween(value,min,max)){
					if(regex(value)){
						return true;
					}
					else{
						alert('Le champs n\'a pas une forme valide');
						return false;
					}
				}
				else{
					alert('Le champs doit être compris entre '+ min + ' et ' + max + ' caractères');
					return false;
				}
			}
			else{
				alert('Le champs ne doit pas être vide');
				return false;
			}
		}
		else{
			alert('Vous n\'avez pas changé le champs!');
			return false;
		}
	}

	$('#pseudoButton').on('click',function(){
		if(isInputValid($('#pseudo').val(),pseudo,isInputAlphaNumeric,PSEUDO_MIN,PSEUDO_MAX,'newPseudo')){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newPseudo:$('#pseudo').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#pseudo').val(pseudo);
		}
	});

	$('#nomButton').on('click',function(){
		if(isInputValid($('#nom').val(),nom,isInputAlpha,NOM_MIN,NOM_MAX,'newNom')){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newNom:$('#nom').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#nom').val(nom);
		}
	});
	
	$('#prenomButton').on('click',function(){
		if(isInputValid($('#prenom').val(),prenom,isInputAlpha,PRENOM_MIN,PRENOM_MAX,'newPrenom')){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newPrenom:$('#prenom').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#prenom').val(prenom);
		}
	});

	$('#mailButton').on('click',function(){
		if(isInputValid($('#mail').val(),mail,isInputMail,MAIL_MIN,MAIL_MAX,'newMail')){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newMail:$('#mail').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#mail').val(mail);
		}
	});

});