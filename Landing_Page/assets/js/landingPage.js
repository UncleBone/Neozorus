document.addEventListener("DOMContentLoaded", function(){
	
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
	var backgroundSlideOver = false;		/* Variable de contrôle de fin d'animation de glissement du background */
	var logoSlideOver = false;		/* Variable de contrôle de fin d'animation de déplacement du logo */

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

	if(page == "noteam"){

		btnDinos.addEventListener('click',dinos);		/* lance la fonction "dinos" au click sur le bouton dinos */
		btnMatrix.addEventListener('click',matrix);		/* lance la fonction "matrix" au click sur le bouton matrix */

	}else if(page == "matrix"){

		/* positionnement des blocs et images */
		divHaut.style.bottom = 90+'vh';
		divBas.style.top = -90+'vh';
		imgHaut.style.bottom = -(90+1)*Math.cos(angle*Math.PI/180)+'vh';
		imgHaut.style.left = -90*Math.sin(angle*Math.PI/180)+'vh';
		imgBas.style.top = (90-1)*Math.cos(angle*Math.PI/180)+'vh';
		imgBas.style.right = 90*Math.sin(angle*Math.PI/180)+'vh';

		/* disparition des boutons */
		btnDinos.style.visibility = 'hidden';
		btnMatrix.style.visibility = 'hidden';
		btnDinos.style.opacity = 0;
		btnMatrix.style.opacity = 0;

		/* positionnement du logo */
		logo.style.marginTop = 10+'vh';

		/* modification du curseur sur les éléments qui deviennent clickables */
		logo.style.cursor = "pointer";
		imgHaut.style.cursor = "pointer";

		/* coin supérieur au premier plan pour qu'il reste clickable */
		divHaut.style.zIndex = "2";

		var main = document.getElementById('page_matrix');


		/* Lancement de la fonction "dinosReverse au click sur le logo ou le coin supérieur */
		logoNeozorus.addEventListener('click',matrixReverse);
		imgHaut.addEventListener('click',matrixReverse);


	}else if(page == "dinos"){
		/* positionnement des blocs et images */
		divHaut.style.bottom = -90+'vh';
		divBas.style.top = 90+'vh';
		imgHaut.style.bottom = (90-1)*Math.cos(angle*Math.PI/180)+'vh';
		imgHaut.style.left = 90*Math.sin(angle*Math.PI/180)+'vh';
		imgBas.style.top = -(90+1)*Math.cos(angle*Math.PI/180)+'vh';
		imgBas.style.right = -90*Math.sin(angle*Math.PI/180)+'vh';

		/* disparition des boutons */
		btnDinos.style.visibility = 'hidden';
		btnMatrix.style.visibility = 'hidden';
		btnDinos.style.opacity = 0;
		btnMatrix.style.opacity = 0;

		/* positionnement du logo */
		logo.style.marginTop = 10+'vh';

		/* modification du curseur sur les éléments qui deviennent clickables */
		logo.style.cursor = "pointer";
		imgBas.style.cursor = "pointer";

		/* coin inférieur au premier plan pour qu'il reste clickable */
		divBas.style.zIndex = "2";

	    var main = document.getElementById('page_dinos');

		/* Lancement de la fonction "dinosReverse au click sur le logo ou le coin inférieur */
		logoNeozorus.addEventListener('click',dinosReverse);
		imgBas.addEventListener('click',dinosReverse);
		
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
					divHaut.style.bottom = '-'+y+'vh';
					divBas.style.top = y+'vh';
					imgHaut.style.bottom = (y-1)*Math.cos(angle*Math.PI/180)+'vh';
					imgHaut.style.left = y*Math.sin(angle*Math.PI/180)+'vh';
					imgBas.style.top = -(y+1)*Math.cos(angle*Math.PI/180)+'vh';
					imgBas.style.right = -(y*Math.sin(angle*Math.PI/180))+'vh';
				}else{
					divHaut.style.bottom = y+'vh';
					divBas.style.top = '-'+y+'vh';
					imgHaut.style.bottom = -(y+1)*Math.cos(angle*Math.PI/180)+'vh';
					imgHaut.style.left = -y*Math.sin(angle*Math.PI/180)+'vh';
					imgBas.style.top = (y-1)*Math.cos(angle*Math.PI/180)+'vh';
					imgBas.style.right = (y*Math.sin(angle*Math.PI/180))+'vh';					
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
			btnDinos.style.visibility = 'visible';
			btnMatrix.style.visibility = 'visible';
		}
		function lSlide()
		{
			if((direction == 'U' && y == 10) || (direction == 'D' && y == 50)){
				clearInterval(I);
				if(direction == 'U'){
					btnDinos.style.visibility = 'hidden';
					btnMatrix.style.visibility = 'hidden';
				}
				logoSlideOver=true;
				redirect();
			}else{
				if(direction == 'U'){
					y--;
				}else{
					y++;
				}
				logo.style.marginTop = y+'vh';
				btnDinos.style.opacity = (y-10)/40;
				btnMatrix.style.opacity = (y-10)/40;
			}
		}	
	}

	/* fonction d'animation pour le retour en page d'accueil */
	function dinosReverse()
	{
		main.style.display = "none";
		divBas.style.zIndex = "0";	
		backgroundSlideReverse('D')
		logoSlide('D');
	}

	/* fonction d'animation pour le retour en page d'accueil */
	function matrixReverse()
	{
		main.style.display = "none";
		divHaut.style.zIndex = "0";
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
					divHaut.style.bottom = y+'vh';
					divBas.style.top = '-'+y+'vh';
					imgHaut.style.bottom = -(y+1)*Math.cos(angle*Math.PI/180)+'vh';
					imgHaut.style.left = -y*Math.sin(angle*Math.PI/180)+'vh';
					imgBas.style.top = (y-1)*Math.cos(angle*Math.PI/180)+'vh';
					imgBas.style.right = (y*Math.sin(angle*Math.PI/180))+'vh';
				}else{
					divHaut.style.bottom = '-'+y+'vh';
					divBas.style.top = y+'vh';
					imgHaut.style.bottom = (y-1)*Math.cos(angle*Math.PI/180)+'vh';
					imgHaut.style.left = y*Math.sin(angle*Math.PI/180)+'vh';
					imgBas.style.top = -(y+1)*Math.cos(angle*Math.PI/180)+'vh';
					imgBas.style.right = -(y*Math.sin(angle*Math.PI/180))+'vh';
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
});
