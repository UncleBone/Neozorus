/**********************Déclaration des variables***************************/

		var width = window.innerWidth;			/* Largeur de la fenêtre du navigateur */
		var height = window.innerHeight;		/* Hauteur de la fenêtre du navigateur */
		var divHaut = document.getElementById('haut');		/* bloc supérieur */
		var divBas = document.getElementById('bas');		/* bloc inférieur */
		var angle = (Math.atan(height/width))*180/Math.PI;		/* angle de la diagonale */
		var btnDinos = document.getElementById('btnDinos');			/* bouton Dinos */
		var btnMatrix = document.getElementById('btnMatrix');		/* bouton Matrix */
		var imgHaut = document.getElementById('imageHaut');		/* image background supérieure */
		var imgBas = document.getElementById('imageBas');		/* image background inférieure */
		var logo = document.getElementById('logo');				/* logo Neozorus + boutons */
		var logoNeozorus = document.getElementById('logoNeozorus');		/* logo Neozorus */	

/**********************Mise en place du background***************************/
		
		/* rotation des blocs */
		divHaut.style.transform = 'rotate(-'+angle+'deg)';		
		divBas.style.transform = 'rotate(-'+angle+'deg)';
		
		/* rotation inverse et dimensionnement des images de background */
		imgHaut.style.transform = 'rotate('+angle+'deg)';
		imgHaut.style.width = 100+'vw';
		imgHaut.style.height = 100+'vh';
		imgBas.style.transform = 'rotate('+angle+'deg)';
		imgBas.style.width = 100+'vw';
		imgBas.style.height = 100+'vh';

		/* positionnement des images par rapport aux blocs */
		imgHaut.style.bottom = -1*Math.cos(angle*Math.PI/180)+'vh';
		imgBas.style.top = -1*Math.cos(angle*Math.PI/180)+'vh';