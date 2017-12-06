$(function(){
	//Un bloc apparait puis brievement au centre de l'ecran puis disparait et comporte le message en parametre
	function blocAppears(message){
		let bloc = $('<div class="popMessage" hidden >'+message+'</div>').appendTo('body');
		bloc.fadeIn(500).fadeOut(1000,function(){
			bloc.remove();
		});

	}
	//Un bloc apparait avec le message en parametre au centre de l'ecran, il faut appuyer sur Ok pour le faire disparaitre
	function blocError(message){
		let bloc = $('<div id="blocError" class="popMessage" hidden >'+message+'</div>').appendTo('body');
		$('<p><button id="buttonError">Ok</button></p>').appendTo('#blocError');
		bloc.fadeIn(100);
		$('#buttonError').on('click',function(){
			$('#blocError').remove();
		})
	}
	//Callback des requetes ajax pour modifier les inputs
	function changedCallback(result){
		let data = JSON.parse(result);
		if(data.newPseudo != undefined){
	   		blocAppears('changement effectué');
	    	$('#pseudo').val(data.newPseudo);
			pseudo = data.newPseudo;   		
		}

		else if(data.newNom != undefined){
	   		blocAppears('changement effectué');
	    	$('#nom').val(data.newNom);
			nom = data.newNom;
			   	
			
		}
		else if(data.newPrenom != undefined){
			blocAppears('changement effectué');
			$('#prenom').val(data.newPrenom);
			prenom = data.newPrenom;

		}
		else if(data.newMail != undefined){
	   		blocAppears('changement effectué');
	    	$('#mail').val(data.newMail);
			mail = data.newMail;
			
		}
		else if(data.error != undefined){
			blocError(data.error);
		}
	}
	//Callback de l'ajax pour modifier les formulaires mot de passe et question/reponse secrete
	function changedFormCallback(ajax){
		let data = JSON.parse(ajax);
		if(data.statement != undefined){
			blocAppears('Changement effectué!');
			$('#actualPassword').val('');
			$('#newPassword').val('');
			$('#conformNewPassword').val('');
			$('#passwordQuestion').val('');
			$('#actualAnswer').val('');
			$('#newQuestion').val('');
			$('#newAnswer').val('');
		}
		else if(data.invalidPassword != undefined){
			blocError(data.invalidPassword);
		}
		else if(data.newPassword != undefined){
			blocError(data.newPassword);
		}
		else if(data.confirmedNewPassword != undefined){
			blocError(data.confirmedNewPassword);
		}
		else if(data.wrongAnswer != undefined){
			blocError(data.wrongAnswer);
		}
		else if(data.newQuestion != undefined){
			blocError(data.newQuestion);
		}
		else if(data.newAnswer != undefined){
			blocError(data.newAnswer);
		}
		else if(data.errorDB != undefined){
			blocError(data.errorDB);
		}

	}

	let pseudo =$('#pseudo').val();
	let mail =$('#mail').val();
	let nom =$('#nom').val();
	let prenom =$('#prenom').val();

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

	function formChangeQuestionAnswerValid(actualPassword,actualAnswer,newQuestion,newAnswer){
		if(!isInputEmpty(actualPassword)){
			if(!isInputEmpty(actualAnswer)){
				if(!isInputEmpty(newQuestion)){
					if(isInputLengthBetween(newQuestion,QUESTION_MIN,QUESTION_MAX)){
						if(!isInputEmpty(newAnswer)){
							if(isInputLengthBetween(newQuestion,ANSWER_MIN,ANSWER_MAX)){
								return true;
							}
							else{
								blocError('La nouvelle reponse doit être compris entre '+ANSWER_MIN+' et '+ANSWER_MAX+' caractères');
								return false;
							}
						}
						else{
							blocError('La réponse ne doit pas être vide');
							return false;
						}		
					}
					else{
						blocError('La nouvelle question doit être compris entre '+QUESTION_MIN+' et '+QUESTION_MAX+' caractères');
						return false;
					}
				}
				else{
					blocError('Le champs "nouvelle question" secrete n\'est pas rempli');
					return false;
				}
			}
			else{
				blocError('Le champs reponse secrete n\'est pas rempli');
				return false;
			}
		}
		else{
			blocError('Le champs "mot de passe actuel" n\'est pas rempli');
			return false;
		}
	}

	function formChangePasswordValid(actualPassword,newPassword,conformNewPassword){
		if(!isInputEmpty(actualPassword)){
			if(isInputLengthBetween(newPassword,PASSWORD_MIN,PASSWORD_MAX)){
				if(newPassword == conformNewPassword){
					return true;
				}
				else{
					blocError('les champs ne sont pas identiques');
					return false;
				}
			}
			else{
				blocError('Le nouveau mot de passe doit être compris entre '+PASSWORD_MIN+' et '+PASSWORD_MAX+' caractères');
				return false;
			}
		}
		else{
			blocError('Le champs "mot de passe actuel" n\'est pas rempli');
			return false;
		}
	}
	//Verifie si un string est conforme aux attente (valeur, valeur au chargement de la page, fonction a appeler, borne min, borne max)
	function isInputValid(value,oldName,regex,min,max){
		if(isInputChanged(value, oldName)){
			if(!isInputEmpty(value)){
				if(isInputLengthBetween(value,min,max)){
					if(regex(value)){
						return true;
					}
					else{
						blocError('Le champs n\'a pas une forme valide');
						return false;
					}
				}
				else{
					blocError('Le champs doit être compris entre '+ min + ' et ' + max + ' caractères');
					return false;
				}
			}
			else{
				blocError('Le champs ne doit pas être vide');
				return false;
			}
		}
		else{
			blocError('Vous n\'avez pas changé le champs!');
			return false;
		}
	}
	//au clic sur le boutton correspondant, on effectue une requete ajax pour modifier le pseudo si les verifications cote client ont reussi
	$('#pseudoButton').on('click',function(){
		if(isInputValid($('#pseudo').val(),pseudo,isInputAlphaNumeric,PSEUDO_MIN,PSEUDO_MAX)){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newPseudo:$('#pseudo').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#pseudo').val(pseudo);
		}
	});

	//au clic sur le boutton correspondant, on effectue une requete ajax pour modifier le nom si les verifications cote client ont reussi
	$('#nomButton').on('click',function(){
		if(isInputValid($('#nom').val(),nom,isInputAlpha,NOM_MIN,NOM_MAX)){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newNom:$('#nom').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#nom').val(nom);
		}
	});
	
	//au clic sur le boutton correspondant, on effectue une requete ajax pour modifier le prenom si les verifications cote client ont reussi
	$('#prenomButton').on('click',function(){
		if(isInputValid($('#prenom').val(),prenom,isInputAlpha,PRENOM_MIN,PRENOM_MAX)){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newPrenom:$('#prenom').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#prenom').val(prenom);
		}
	});

	//au clic sur le boutton correspondant, on effectue une requete ajax pour modifier le mail si les verifications cote client ont reussi
	$('#mailButton').on('click',function(){
		if(isInputValid($('#mail').val(),mail,isInputMail,MAIL_MIN,MAIL_MAX)){
			$.post('index.php?controller=ParametersUser&action=changeDataUser',{newMail:$('#mail').val(),u_id:u_id},changedCallback);
		}
		else{
			$('#mail').val(mail);
		}
	});

	$('#blocQuestion').hide();

	//au clic sur le boutton correspondant, on affiche la div qui permet de modifier le mot de passe
	$('#passwordButton').on('click',function(){
		$('#blocPassword').show();
		$('#blocQuestion').hide();
	});

	//au clic sur le boutton correspondant, on affiche la div qui permet de modifier les question/reponse secretes
	$('#questionButton').on('click',function(){
		$('#blocPassword').hide();
		$('#blocQuestion').show();
	});

	//Au clic sur le boutton correspondant, on effectue une requete ajax pour modifier le mot de passe si les verifications cote client ont reussi
	$('#passwordValidForm').on('click',function(){
		let actualPassword = $('#actualPassword').val();
		let newPassword = $('#newPassword').val();
		let conformNewPassword = $('#conformNewPassword').val();
		if(formChangePasswordValid(actualPassword,newPassword,conformNewPassword)){
			$.post('index.php?controller=ParametersUser&action=changePassword',
			{
				password:actualPassword,
				newPassword:newPassword,
				confirmedNewPassword:conformNewPassword,
				u_id:u_id
			},
			changedFormCallback);
		}
	});
	//Au clic sur le boutton correspondant, on effectue une requete ajax pour modifier la question et reponse secrete si les verifications cote client ont reussi
	$('#questionValidForm').on('click',function(){
		let actualPassword = $('#passwordQuestion').val();
		let actualAnswer = $('#actualAnswer').val();
		let newQuestion = $('#newQuestion').val();
		let newAnswer = $('#newAnswer').val();
		if(formChangeQuestionAnswerValid(actualPassword,actualAnswer,newQuestion,newAnswer)){
			$.post('index.php?controller=ParametersUser&action=changeQuestionAnswer',
			{
				password:actualPassword,
				answer:actualAnswer,
				newQuestion:newQuestion,
				newAnswer:newAnswer,
				u_id:u_id
			},
			changedFormCallback);
		}
	});
});