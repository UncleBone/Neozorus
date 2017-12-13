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
		var backgroundSlideOver=false;		/* Variable de contrôle de fin d'animation de glissement du background */
		var logoSlideOver=false;		/* Variable de contrôle de fin d'animation de déplacement du logo */

		/* Lancement de la fonction "dinosReverse au click sur le logo ou le coin supérieur */
		logoNeozorus.addEventListener('click',matrixReverse);
		imgHaut.addEventListener('click',matrixReverse);

		/* fonction d'animation pour le retour en page d'accueil */
		function matrixReverse()
		{
			main.style.display = "none";
			divHaut.style.zIndex = "0";
			backgroundSlideUReverse()
			logoSlideDown();
		}

		/* fonction de déplacement du logo vers le bas + apparition des boutons */
		function logoSlideDown()
		{
			var y = 10;
			var I = setInterval(logoSlideD,20);
			btnDinos.style.visibility = 'visible';
			btnMatrix.style.visibility = 'visible';
			function logoSlideD()
			{
				if(y==50){
					clearInterval(I);	
					logoSlideOver=true;
					redirect();
				}else{
					y++;
					logo.style.marginTop = y+'vh';
					btnDinos.style.opacity = (y-10)/40;
					btnMatrix.style.opacity = (y-10)/40;
				}
			}	
		}

		/* fonction de retour du BG vers le bas */
		function backgroundSlideUReverse()
		{
			var y = 90;
			var I = setInterval(slideDown,1);		
			function slideDown()
			{
				if(y<=0){
					clearInterval(I);
					backgroundSlideOver=true;
					redirect();
				}else{
					y--;
					divHaut.style.bottom = y+'vh';
					divBas.style.top = '-'+y+'vh';
					imgHaut.style.bottom = -(y+1)*Math.cos(angle*Math.PI/180)+'vh';
					imgHaut.style.left = -y*Math.sin(angle*Math.PI/180)+'vh';
					imgBas.style.top = (y-1)*Math.cos(angle*Math.PI/180)+'vh';
					imgBas.style.right = (y*Math.sin(angle*Math.PI/180))+'vh';
				}
			}	
		}

		/* fonction de redirection */
		function redirect()
		{
			if(backgroundSlideOver===true && logoSlideOver===true){ /* la redirection ne se fait qu'après que les 2 animations soient terminées */
				window.location.replace('Landing_Page.php');
			}
		}