$(function(){
	$('.formChange input[value=Annuler], .formChange input[value=Cancel]').click(function(event){
		event.preventDefault();
		window.location.replace('.?controller=parameters&action=display');
	});
});

function changeEmail(){

	$('.formChange input[name=newEmail]').focusout(function(){
		let input = $(this);
		$.getJSON('?controller=parameters&action=checkEmailValidity&newEmail='+$(this).val(), function(result){
			if(result != true){
				error(result);
			}else{
				$('.error').remove();
				$('.formChange input[name=confirmNewEmail]').focusout(function(){
					console.log($(this).val());
					if ($(this).val() != $('.formChange input[name=newEmail]').val()){
						error('Erreur: les entrées ne correspondent pas');
					}

				});
			}
			// changeEmail();
		});
	});

}

function error(message){
	error = $('<div>').addClass('error').html('<p>'+message+'</p>');
	$('#parameters').append(error);
}