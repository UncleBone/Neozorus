$(checkOrientation);
$(window).resize(checkOrientation);

function checkOrientation(){
	/**********************Déclaration des variables***************************/

		var width = $(window).width();			/* Largeur de la fenêtre du navigateur */
		var height = $(window).height();		/* Hauteur de la fenêtre du navigateur */

	/************************Vérification de l'orientation de l'écran*******************************/

	if(height > width){
		if($('body').find('#messageOrientation').length == 0){
			$('body').children().css('display', 'none');
			$('body').css('background-image', 'none');
			$('body').css('background-color', 'rgb(20,20,20)');
			$('body').css('color', 'white').css('font-family', 'fira_code');
			var p = $('<p></p>').attr('id','messageOrientation').text('Veuillez tourner votre écran').css('text-align', 'center');
			$('body').append(p);
			p.css('margin-top', '50vh').css('transform','translateY(-50%)');
		}	
	}else{

		if($('body').find('#messageOrientation').length > 0){
			$('body').find('#messageOrientation').remove();
			if($('.message .data_id').length >= 0){
				$('body').css('background-image', 'url("assets/img/plateau/plateau_alt.png")');
			}else{
				$('body').css('background-image', 'url("assets/img/fond_mixte.png")');
			}
			$('body').children().css('display', 'block');	
		}
	}
}