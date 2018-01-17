// $(landingPage);
document.addEventListener("DOMContentLoaded", splitBackground);

$(window).resize(splitBackground);

function splitBackground(){

/**********************Déclaration des variables***************************/

	var width = $(window).width();			/* Largeur de la fenêtre du navigateur */
	var height = $(window).height();		/* Hauteur de la fenêtre du navigateur */
	var angle = (Math.atan(height/width))*180/Math.PI;		/* angle de la diagonale */
	var backgroundSlideOver = false;		/* Variable de contrôle de fin d'animation de glissement du background */
	var logoSlideOver = false;		/* Variable de contrôle de fin d'animation de déplacement du logo */

	var divHaut = $('#haut');		/* bloc supérieur */
	var divBas = $('#bas');			/* bloc inférieur */
	var btnDinos = $('#btnDinos');			/* bouton Dinos */
	var btnMatrix = $('#btnMatrix');		/* bouton Matrix */
	var imgHaut = $('#imageHaut');		/* image background supérieure */
	var imgBas = $('#imageBas');		/* image background inférieure */
	var logo = $('#logo');				/* logo Neozorus + boutons */
	var logoNeozorus = $('#logoNeozorus');		/* logo Neozorus */	


/************************Vérification de l'orientation de l'écran*******************************/

	if(height > width){
		if($('body').find('#messageOrientation').length == 0){
			$('body').children().css('display', 'none');
			$('body').css('background-color', 'rgb(20,20,20)');
			$('body').css('color', 'white').css('font-family', 'fira_code');
			var p = $('<p></p>').attr('id','messageOrientation').text('Veuillez tourner votre écran').css('text-align', 'center');
			$('body').append(p);
		}
		p.css('margin-top', '50vh').css('transform','translateY(-50%)');
	}else{

		if($('body').find('#messageOrientation').length > 0){
			$('body').find('#messageOrientation').remove();
			$('body').css('background-color', 'white');
			$('body').children().css('display', 'block');	
		}

	/**********************Mise en place du background***************************/
	// console.log(page.type);
	styleAdjust(typeof page !== 'undefined' ? page : '');

	// if(page == "noteam"){

	// 	btnDinos.click(dinos);		/* lance la fonction "dinos" au click sur le bouton dinos */
	// 	btnMatrix.click(matrix);		/* lance la fonction "matrix" au click sur le bouton matrix */

	// }else if(page == "matrix"){

	// 	var main = $('#page_matrix');
	
	// 	logoNeozorus.click(matrixReverse);	/* Lance la fonction "dinosReverse" au click sur le logo */
	// 	imgHaut.click(matrixReverse);		/* Lance la fonction "dinosReverse" au click sur le coin supérieur */


	// }else if(page == "dinos"){

	//     var main = $('#page_dinos');

	// 	logoNeozorus.click(dinosReverse);	/* Lance la fonction "dinosReverse" au click sur le logo */
	// 	imgBas.click(dinosReverse);			/* Lance la fonction "dinosReverse" au click sur le coin inférieur */
		
	// }

	function styleAdjust(page){

		/* rotation des blocs */
		divHaut.css('transform', 'rotate(-'+angle+'deg)');
		divBas.css('transform', 'rotate(-'+angle+'deg)');
		
		/* rotation inverse et dimensionnement des images de background */
		imgHaut.css('transform', 'rotate('+angle+'deg)');
		imgHaut.width(100+'vw');
		imgHaut.height(100+'vh');
		imgBas.css('transform', 'rotate('+angle+'deg)');
		imgBas.width(100+'vw');
		imgBas.height(100+'vh');

		/* positionnement des images par rapport aux blocs */
		imgHaut.css('bottom',-1*Math.cos(angle*Math.PI/180)+'vh');
		imgBas.css('top', -1*Math.cos(angle*Math.PI/180)+'vh');

		if(page == 'matrix'){

			/* positionnement des blocs et images */
			divHaut.css('bottom', 90+'vh');
			divBas.css('top', -90+'vh');
			imgHaut.css('bottom', -(90+1)*Math.cos(angle*Math.PI/180)+'vh');
			imgHaut.css('left', -90*Math.sin(angle*Math.PI/180)+'vh');
			imgBas.css('top', (90-1)*Math.cos(angle*Math.PI/180)+'vh');
			imgBas.css('right', 90*Math.sin(angle*Math.PI/180)+'vh');

			/* disparition des boutons */
			btnDinos.css('visibility', 'hidden');
			btnMatrix.css('visibility', 'hidden');
			btnDinos.css('opacity', 0);
			btnMatrix.css('opacity', 0);

			/* positionnement du logo */
			logo.css('marginTop', 10+'vh');

			/* modification du curseur sur les éléments qui deviennent clickables */
			logo.css('cursor', "pointer");
			imgHaut.css('cursor', "pointer");

			/* coin supérieur au premier plan pour qu'il reste clickable */
			divHaut.css('zIndex', "2");

		}else if(page == 'dinos'){

			/* positionnement des blocs et images */
			divHaut.css('bottom', -90+'vh');
			divBas.css('top', 90+'vh');
			imgHaut.css('bottom', (90-1)*Math.cos(angle*Math.PI/180)+'vh');
			imgHaut.css('left', 90*Math.sin(angle*Math.PI/180)+'vh');
			imgBas.css('top', -(90+1)*Math.cos(angle*Math.PI/180)+'vh');
			imgBas.css('right', -90*Math.sin(angle*Math.PI/180)+'vh');

			/* disparition des boutons */
			btnDinos.css('visibility', 'hidden');
			btnMatrix.css('visibility', 'hidden');
			btnDinos.css('opacity', 0);
			btnMatrix.css('opacity', 0);

			/* positionnement du logo */
			logo.css('margin-top', 10+'vh');

			/* modification du curseur sur les éléments qui deviennent clickables */
			logo.css('cursor', "pointer");
			imgBas.css('cursor', "pointer");

			/* coin inférieur au premier plan pour qu'il reste clickable */
			divBas.css('zIndex', "2");

		}
	}

	/* fonction lancée au click sur le bouton "dinos" */
	function dinos()
	{
		team='dinos';
		backgroundSlide('D');
		logoSlide('U');
	}

	/* fonction lancée au click sur le bouton "matrix" */
	function matrix()
	{	
		team='matrix';
		backgroundSlide('U');
		logoSlide('U');
	}

	/* fonction de glissement du BG */
	function backgroundSlide(direction)
	{
		var y = 0;
		var I = setInterval(slide,1);		
		function slide()
		{
			if(y==90){
				clearInterval(I);
				backgroundSlideOver=true;
				redirect();
			}else{
				y++;
				if(direction == 'D'){
					divHaut.css('bottom', '-'+y+'vh');
					divBas.css('top', y+'vh');
					imgHaut.css('bottom', (y-1)*Math.cos(angle*Math.PI/180)+'vh');
					imgHaut.css('left', y*Math.sin(angle*Math.PI/180)+'vh');
					imgBas.css('top', -(y+1)*Math.cos(angle*Math.PI/180)+'vh');
					imgBas.css('right', -(y*Math.sin(angle*Math.PI/180))+'vh');
				}else{
					divHaut.css('bottom', y+'vh');
					divBas.css('top', '-'+y+'vh');
					imgHaut.css('bottom', -(y+1)*Math.cos(angle*Math.PI/180)+'vh');
					imgHaut.css('left', -y*Math.sin(angle*Math.PI/180)+'vh');
					imgBas.css('top', (y-1)*Math.cos(angle*Math.PI/180)+'vh');
					imgBas.css('right', (y*Math.sin(angle*Math.PI/180))+'vh');					
				}
				
			}
		}	
	}

	/* fonction de déplacement du logo + visibilité des boutons */
	function logoSlide(direction)
	{
		var y = (direction == 'U' ? 50 : 10);
		var I = setInterval(lSlide,20);
		if(direction == 'D'){
			btnDinos.css('visibility', 'visible');
			btnMatrix.css('visibility', 'visible');
		}
		function lSlide()
		{
			if((direction == 'U' && y == 10) || (direction == 'D' && y == 50)){
				clearInterval(I);
				if(direction == 'U'){
					btnDinos.css('visibility', 'hidden');
					btnMatrix.css('visibility', 'hidden');
				}
				logoSlideOver=true;
				redirect();
			}else{
				if(direction == 'U'){
					y--;
				}else{
					y++;
				}
				logo.css('margin-top', y+'vh');
				btnDinos.css('opacity', (y-10)/40);
				btnMatrix.css('opacity', (y-10)/40);
			}
		}	
	}

	/* fonction d'animation pour le retour en page d'accueil */
	function dinosReverse()
	{
		main.css('display', "none");
		divBas.css('zIndex', "0");	
		backgroundSlideReverse('D')
		logoSlide('D');
	}

	/* fonction d'animation pour le retour en page d'accueil */
	function matrixReverse()
	{
		main.css('display', "none");
		divHaut.css('zIndex', "0");
		backgroundSlideReverse('U');
		logoSlide('D');
	}


	/* fonction de retour du BG en sens inverse */
	function backgroundSlideReverse(direction)
	{
		var y = 90;
		var I = setInterval(slide,1);		
		function slide()
		{
			if(y<=0){
				clearInterval(I);
				backgroundSlideOver=true;
				redirect();
			}else{
				y--;
				if(direction == 'U'){
					divHaut.css('bottom', y+'vh');
					divBas.css('top', '-'+y+'vh');
					imgHaut.css('bottom', -(y+1)*Math.cos(angle*Math.PI/180)+'vh');
					imgHaut.css('left', -y*Math.sin(angle*Math.PI/180)+'vh');
					imgBas.css('top', (y-1)*Math.cos(angle*Math.PI/180)+'vh');
					imgBas.css('right', (y*Math.sin(angle*Math.PI/180))+'vh');
				}else{
					divHaut.css('bottom', '-'+y+'vh');
					divBas.css('top', y+'vh');
					imgHaut.css('bottom', (y-1)*Math.cos(angle*Math.PI/180)+'vh');
					imgHaut.css('left', y*Math.sin(angle*Math.PI/180)+'vh');
					imgBas.css('top', -(y+1)*Math.cos(angle*Math.PI/180)+'vh');
					imgBas.css('right', -(y*Math.sin(angle*Math.PI/180))+'vh');
				}
			}
		}	
	}

	/* fonction de redirection */
	function redirect()
	{
		if(backgroundSlideOver===true && logoSlideOver===true){ /* la redirection ne se fait qu'après que les 2 animations soient terminées */
			if (page=='noteam') {
				window.location.replace('.?team='+team);
			}else{
				window.location.replace('.');
			}
		}
	}
}
};
