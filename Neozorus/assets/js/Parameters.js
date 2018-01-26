$(function(){
	$('#changeMail').click(function(){
		let form = $('<form>').addClass('formChange');
		let inputNewEmail = $('<input>').attr('type','email').attr('name', 'newEmail').attr('placeholder', 'Nouvelle adresse email');
		let confirmNewEmail = $('<input>').attr('type','email').attr('name', 'confirmNewEmail').attr('placeholder', 'Confirmee la nouvelle adresse email');
		let inputPassword = $('<input>').attr('type','password').attr('name', 'password').attr('placeholder', 'Mot de passe');
		let submit = $('<input>').attr('type','submit').attr('value','Valider');
		let cancel = $('<input>').attr('type','submit').attr('value','Annuler');

		$('#parameters').children().remove();

		form.append(inputNewEmail).append(confirmNewEmail).append(inputPassword).append(submit).append(cancel);
		$('#parameters').append(form);
	});
});