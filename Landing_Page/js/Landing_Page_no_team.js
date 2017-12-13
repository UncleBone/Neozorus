		btnDinos.addEventListener('click',dinos);		/* lance la fonction "dinos" au click sur le bouton dinos */
		btnMatrix.addEventListener('click',matrix);		/* lance la fonction "matrix" au click sur le bouton matrix */

		var backgroundSlideOver=false;		/* Variable de contrôle de fin d'animation de glissement du background */
		var logoSlideOver=false;		/* Variable de contrôle de fin d'animation de déplacement du logo */
		var team='';		/* Variable du choix de l'équipe pour la redirection */

		/* fonction lancée au click sur le bouton "dinos" */
		function dinos()
		{
			team='dinos';
			backgroundSlideD();
			logoSlideUp();
		}

		/* fonction lancée au click sur le bouton "matrix" */
		function matrix()
		{	
			team='matrix';
			backgroundSlideU();
			logoSlideUp();
		}

		/* fonction de glissement du BG vers le bas */
		function backgroundSlideD()
		{
			var y = 0;
			var I = setInterval(slideDown,1);		
			function slideDown()
			{
				if(y==90){
					clearInterval(I);
					backgroundSlideOver=true;
					redirect();
				}else{
					y++;
					divHaut.style.bottom = '-'+y+'vh';
					divBas.style.top = y+'vh';
					imgHaut.style.bottom = (y-1)*Math.cos(angle*Math.PI/180)+'vh';
					imgHaut.style.left = y*Math.sin(angle*Math.PI/180)+'vh';
					imgBas.style.top = -(y+1)*Math.cos(angle*Math.PI/180)+'vh';
					imgBas.style.right = -(y*Math.sin(angle*Math.PI/180))+'vh';
				}
			}	
		}

		/* fonction de glissement du BG vers le haut */
		function backgroundSlideU()
		{
			var y = 0;
			var I = setInterval(slideUp,1);		
			function slideUp()
			{
				if(y==90){
					clearInterval(I);
					backgroundSlideOver=true;
					redirect();
				}else{
					y++;
					divHaut.style.bottom = y+'vh';
					divBas.style.top = '-'+y+'vh';
					imgHaut.style.bottom = -(y+1)*Math.cos(angle*Math.PI/180)+'vh';
					imgHaut.style.left = -y*Math.sin(angle*Math.PI/180)+'vh';
					imgBas.style.top = (y-1)*Math.cos(angle*Math.PI/180)+'vh';
					imgBas.style.right = (y*Math.sin(angle*Math.PI/180))+'vh';
				}
			}	
		}
		
		/* fonction de déplacement du logo vers le haut + effacement des boutons */
		function logoSlideUp()
		{
			var y = 50;
			var I = setInterval(logoSlideU,20);
			function logoSlideU()
			{
				if(y==10){
					clearInterval(I);
					btnDinos.style.visibility = 'hidden';
					btnMatrix.style.visibility = 'hidden';
					logoSlideOver=true;
					redirect();
				}else{
					y--;
					logo.style.marginTop = y+'vh';
					btnDinos.style.opacity = (y-10)/40;
					btnMatrix.style.opacity = (y-10)/40;
				}
			}	
		}

		/* fonction de redirection */
		function redirect()
		{
			if(backgroundSlideOver===true && logoSlideOver===true){ /* la redirection ne se fait qu'après que les 2 animations soient terminées */
				if (team=='dinos') {
					window.location.replace('Landing_Page_dinos.php');
				}
				if (team=='matrix') {
					window.location.replace('Landing_Page_matrix.php');
				}
			}
		}