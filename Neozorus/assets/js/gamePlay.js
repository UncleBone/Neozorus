$(function(){
    if(currentPlayer != jeton){
        gameWaitingTurn();
    }else {
        gamePlay(jeton, att, cible, abilite, eog);
    }
});

function ajax(nom,data,fct){
    $.getJSON('.?controller=game&action='+nom+data+"&ajax=1", function(result){
        if(result != null){
            fct(result);
        }
    });
}

/************Fonction active pendant le tour du joueur actif**************/

function gamePlay(jet, att, cible, abilite, eog){
    var jeton = jet;
    var timerFB;
    // console.log('jet:'+jet+', att:'+att+', cible:'+cible+', abilite:'+abilite+' eog:'+eog);
    historique();   // mise en forme de l'historique

    /*** si la partie n'est pas terminée ***/
    if(eog != '1'){
        var carteMain = $('.carteMain');

        if($('.error').length != 0) fade($('.error'));  // fade sur message d'erreur
        $('.sommeil').remove(); // retrait des animations de sommeil sur les cartes inactives
        $('#plateau :not(.carte)').off('click'); // réinitialisation de l'event click
        $('main').css('cursor','auto'); // réinitialisation du curseur
        $('.ciblage').remove(); // effacement des animations de ciblage
        flickeringBorder($('#bottomPlateau .carte').find('img'), 'off');    // effacement de la bordure clignotante

        reqAjaxCarteMain(jeton, att);
        reqAjaxCartePlateau(jeton, att, abilite);
        reqAjaxJoueur(jeton,att, abilite);
        

        /* si mode attaque activé: sélection désactivée au click sur le plateau ou sur cette même carte */
        if($.isNumeric(att)) {
            $('#plateau :not(.carte)').click(function(){
                console.log($(this));
                $('.message').remove();
                gamePlay(jeton, '', '', abilite, eog);
            });
        }


        /****************** animation et zoom sur les cartes de la main *******************/

        carteMain.each(function(){
            let id = $(this).attr('data_id');
            let indice = $(this).attr('data_indice');
            let gameId = $(this).attr('data_gameid');
            $(this).off('mouseenter mouseleave');   // désactivation du hover
            $(this).find('img').css('outline','none');  // effacement des bordures
            
            /*** si le mode attaque n'est pas activé ***/
            if(!$.isNumeric(att)){
                $(this).css('top',"0"); // remise à niveau des cartes
                let timer;
                /** surélévation et zoom au survol **/
                $(this).hover(function(e){
                    $(this).css('top','-20px');
                    var target = $(this);
                    timer = setTimeout(zoom, 1000, target);
                }, function(){
                    $(this).css('top',"0");
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });
                /** effacement du zoom au click **/
                $(this).click(function(){
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });
            /*** si le mode attaque est activé par une carte sort de la main ***/
            }else if(att == gameId){
                flickeringBorder($(this).find('img'), 'on');    // activation de la bordure clignotante
            }
        });

        /****************** animations et zoom sur les cartes du plateau *******************/

        $('.carte').each(function(){
            let timer;
            let target = $(this);
            let id = $(this).attr('data_id');
            let index = $(this).find('.indice span').text();
            let gameId = $(this).attr('data_gameid');

            if(target.attr('data_active') == 0 ){
                sommeil(target);    // animation sommeil sur les cartes inactives du plateau
            }
            
            target.css('cursor','auto');    // réinitialisation du curseur
            $(this).off('mouseenter mouseleave');   // désactivation du hover

            /*** Si aucune carte n'est sélectionnée pour attaquer: border au survol + zoom ***/
            if(!$.isNumeric(att)){ 
                $(this).hover(function(e){     
                    target.find('img').css('outline', '1px solid white');
                    timer = setTimeout(zoom, 1000, target);
                }, function(){
                    $(this).find('img').css('outline',"none");
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });
                /** effacement du zoom au click **/
                $(this).click(function(){
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });

            /*** Si mode attaque activé: animation pour les cibles + bordure clignotante pour la carte attaquante ***/
            }else{ 

                if (att != gameId){
                    $('main').css('cursor','url(assets/img/cursor/cursorCross.png), auto'); // curseur croix par défaut
                    if(target.parent().attr('id') == 'topPlateau' && target.attr('data_visable') == '1'){
                        ciblage(target.find('img'));    // animation de ciblage pour les cibles potentielles
                    }else{
                        target.css('cursor','url(assets/img/cursor/cursorCross.png), auto');
                    }
                }else{
                    flickeringBorder(target.find('img'), 'on');
                }
            }
        });

        /***************** Changement de jeton au click sur le bouton 'fin de tour' ******************/

        $('#end').css('cursor','pointer').attr('title','Fin de tour');
        $('#end img').click(function(){
            ajax("play", "&jeton="+(1-jeton), function(result) {
                var contenu = $('#contenu');
                contenu.html(result['view']);
                chgTurnMssg(1); // message de chgt de tour
                gameWaitingTurn();  // passage en mode attente
            });
        });
    /*** si la partie est terminée ***/
    }else{
        $('.carteMain').off('click hover');
        $('.carteMain').css('cursor','auto');
        $('.carteMain').removeAttr('href');
    }
}

/*
 * Gestion des cartes de la main en ajax
 */
function reqAjaxCarteMain(jeton, att){
    var carteMain = $('.carteMain');
    carteMain.each(function(){
        $(this).css('cursor',"pointer");
        $(this).off('click');   // désactivation des évenements click
        $(this).click(function(e){
            e.preventDefault();
            let carte = $(this);
            carte.off('hover'); // désactivation du hover
            $('[class^=zoom]').remove();    // effacement du zoom
            let id = $(this).attr('data_gameid');
            ajax("play", "&jouer="+id, function(result) {
                console.log(id);
                /*** si le serveur renvoie un message d'erreur ***/
                if(result['error'] != null){
                    $('.error').remove();   // effacement des messages antérieurs
                    $('.message').remove();

                    /** si mana insuffisant **/
                    if(result['error'] == "Vous n'avez pas assez de mana!" ){
                        let error = $('<p>').addClass('error').text(result['error']);
                        $('main').append(error);
                        fade(error);

                    /** si c'est une carte sort **/
                    }else if(result['error'] == "Choisissez la cible" ){    
                        let message = $('<p>').addClass('message').text(result['error']);
                        $('main').append(message);
                        let attCarte = id;
                        let abilite = [];
                        let abiliteCarte = 0;
                        abilite.push(carte.attr('data_abilite'));
                        abilite.push(carte.attr('data_abilite_2'));
                        for(ab of abilite){
                            if(ab != 0) abiliteCarte = ab;
                        }
                        gamePlay(jeton,attCarte,'',abiliteCarte,eog);   // on relance le script en mode attaque
                    }

                /*** si pas de message d'erreur, rafraîchit la page et relance le script ***/
                }else{                   
                    var contenu = $('#contenu');
                    contenu.html(result['view']);
                    var infoBox = $('#infoBox');
                    if (infoBox.length != 0) infoBox.remove();
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                }
            });
        });

        //Méthode 2:
        // const create = data => function(){ console.log(data); };
        // carte.addEventListener('click', create(href));

        //Méthode 3:
        /*carte.addEventListener('click', function(data) {
            return function(){
                console.log(data);
            }
        }(href));*/
    });
}

/*
 * Gestion des cartes du plateau en ajax
 */
function reqAjaxCartePlateau(jeton,att,abilite){
    var cartePlateau = $('.carte');

    cartePlateau.each(function(){
        let parentId = $(this).parent().attr('id');

        if(parentId == 'bottomPlateau' && currentPlayer == jeton && $(this).attr('data_active') == 1){
            let attCarte = $(this).attr('data_gameid');
            bottomPlateau($(this),attCarte,abilite,jeton,cible,eog);
        }else if(parentId == 'topPlateau' && currentPlayer == jeton && $.type(att) != 'undefined' && att != '' && $(this).attr('data_visable') == 1){
            let cibleCarte = $(this).attr('data_gameid');
            console.log('cible'+cibleCarte);
            topPlateau($(this),att,abilite,jeton,cibleCarte,eog);
        }
    });
}

/********************* Gestion des cartes du joueur actif *********************/

function bottomPlateau(carte,attCarte,abilite,jeton,cible,eog){
    carte.off('click');
    carte.css('cursor',"pointer");
    carte.click(function(e){
        e.preventDefault();
        e.stopPropagation();
        ajax("play", "&att="+attCarte+"&abilite="+abilite, function(result) {
            /** si le serveur renvoie un message (ciblage) **/        
            if(result['error'] != null){
                $('.error').remove();
                $('.message').remove();
                let message = $('<p>').addClass('message').text(result['error']);
                $('main').append(message);
                gamePlay(jeton,attCarte,cible,abilite,eog);
            }else{
                console.log('erreur bottomPlateau');
            }
            
        });
    });
}

/********************* Gestion des cartes du joueur adverse *********************/

function topPlateau(carte,att,abilite,jeton,cible,eog){
    carte.off('click');
    cible = carte.attr('data_gameid');
    carte.click(function(e){
        e.stopPropagation();
        e.preventDefault();
        // console.log('prehit att'+att);
        hitAnimation($(this),att);  // animation de coup
        setTimeout(function(){  // fct de délais pour laisser à l'animation le temps de se dérouler
            ajax("play", "&att="+att+"&cible="+cible+"&abilite="+abilite, function(result) {
                let contenu = $('#contenu');
                contenu.html(result['view']);             
                gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
            });
        }, 1000);
    });
}

/********************* Gestion du héros du joueur adverse *********************/

function reqAjaxJoueur(jet, att, abilite){
    let jeton = jet;
    let joueurAdverse = $('#topHeros');
    joueurAdverse.css('cursor','auto'); // réinitialisation du curseur
    joueurAdverse.off('click'); // désactivation de l'event
    if($.isNumeric(att) && joueurAdverse.attr('data_visable') == 1){
        ciblage(joueurAdverse.find('img'));
        let cible = joueurAdverse.attr('data_cible');
        joueurAdverse.click(function(e){
            e.preventDefault();
            hitAnimation($(this),att);  // animation de coup
            setTimeout(function(){  // fct de délais pour laisser à l'animation le temps de se dérouler
                ajax("play", "&att="+att+"&cible="+cible+"&abilite="+abilite, function(result) {
                    let contenu = $('#contenu');
                    contenu.html(result['view']);
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                });
            },1000);
        });

    }else if ($.isNumeric(att) && joueurAdverse.attr('data_visable') == 0) {
        joueurAdverse.css('cursor','url(assets/img/cursor/cursorCross.png), auto');
    }
}


function abiliteTexte(ab){
    switch(ab){
        case '1':
            return 'Bouclier';
        case '2':
            return 'Pioche 1 carte';
        case '3':
            return 'Pioche 2 cartes';
        default:
        return '';
    }
}

/************Fonction active pendant le tour du joueur passif**************/
/*  Recharge la vue toutes les secondes
    Si le jeton change, lance la fonction 'Gameplay'
 */

function gameWaitingTurn(){
    var interval;
    let action;
    historique();
    if($('#topHeros').attr('data_otherplayer') == 1){
        gameWaitingTurnSoloMode();
    }else{
        action = 'refreshViewAjax';
    }

    interval = window.setInterval(function(){   // fct de répétition qui interroge le serveur toutes les secondes
        ajax(action, "", function(result) {
            let contenu = $('#contenu');
            let j = result['jeton'];
            let lastEvent = result['lastEvent'];
            let oldLastEvent = $('.event').last().attr('data_event_id');
            console.log('waiting, lastEvent:'+lastEvent+', oldLastEvent:'+oldLastEvent);

            /*** si il y a un nouvel évènement dans l'historique ***/
            if(lastEvent != oldLastEvent){

                /** si l'évènement est de type attaque carte ou attaque joueur **/
                if(result['lastEventType'] == 2 || result['lastEventType'] == 3){ 
                    clearInterval(interval);    // arrêt de la fonction de répétition 
                    hitAnimationJoueurPassif(result);   //  animation d'attaque pour le joueur passif
                    setTimeout(function(){  // fonction de délais pour laisser le temps à l'animation de se dérouler
                        contenu.html(result['view']);   // rafraîchissement de la vue
                        historique();   // mise en forme de l'historique
                        gameWaitingTurn();  // relance de la fonction 
                    }, 1100);

                /** si l'évènement n'est pas de type attaque **/
                }else{
                    contenu.html(result['view']);
                    historique();
                }               
            }

            /*** si la partie n'est pas terminée ***/
            if(!result['eog']){

                /** si le tour du joueur est venu et que sa jauge de mana est chargée **/
                if(j == currentPlayer && result['PeM'] == 1 && (result['mana'] == result['tour'] || result['mana'] == 10)){
                    contenu.html(result['view']);
                    historique();
                    chgTurnMssg(0);
                    gamePlay(j,result['att'],result['cible'],result['abilite'],result['eog']);
                    clearInterval(interval);     
                }
            /*** si la partie est terminée, arrêt de la fct ***/   
            }else{       
                clearInterval(interval);  
            }
        })
    },1000);
}

function gameWaitingTurnSoloMode(){
    ajax('play', "", function(result) {
            let contenu = $('#contenu');
            let j = result['jeton'];
            let lastEvent = result['lastEvent'];
            let oldLastEvent = $('.event').last().attr('data_event_id');
            console.log('waiting, lastEvent:'+lastEvent+', oldLastEvent:'+oldLastEvent);
            /*** si il y a un nouvel évènement dans l'historique ***/
            if(lastEvent != oldLastEvent){

                /** si l'évènement est de type attaque carte ou attaque joueur **/
                if(result['lastEventType'] == 2 || result['lastEventType'] == 3){ 
                    // clearInterval(interval);    // arrêt de la fonction de répétition 
                    hitAnimationJoueurPassif(result);   //  animation d'attaque pour le joueur passif
                    setTimeout(function(){  // fonction de délais pour laisser le temps à l'animation de se dérouler
                        contenu.html(result['view']);   // rafraîchissement de la vue
                        historique();   // mise en forme de l'historique
                        gameWaitingTurnSoloMode();  // relance de la fonction 
                    }, 1100);

                /** si l'évènement n'est pas de type attaque **/
                }else{
                    contenu.html(result['view']);
                    historique();
                }               
            }

            /*** si la partie n'est pas terminée ***/
            if(!result['eog']){
                console.log('jeton:'+j+', PeM:'+result['PeM']+', mana:'+result['mana']+', tour:'+result['tour']);
                /** si le tour du joueur est venu et que sa jauge de mana est chargée **/
                if(j == currentPlayer && result['PeM'] == 1 && (result['mana'] == result['tour'] || result['mana'] == 10)){
                    contenu.html(result['view']);
                    historique();
                    chgTurnMssg(0);
                    gamePlay(j,result['att'],result['cible'],result['abilite'],result['eog']);
                    // clearInterval(interval);     
                }else{
                    gameWaitingTurnSoloMode();
                }
            /*** si la partie est terminée, arrêt de la fct ***/   
            }else{       
                // clearInterval(interval);  
            }
        })
}

/*****************Fonction de fade out**********************/
function fade(element) {
    var op = 1;  // opacité initiale
    var t = 0;  // nb d'itérations
    var interval = setInterval(function () {
        if (op <= 0.1){
            clearInterval(interval);
            $(element).css('display', 'none');
        }else{
            $(element).css('opacity',op);
            $(element).css('filter','alpha(opacity=' + op * 100 + ")");
            op -= op * 0.1*t/15;
            t = t >= 15 ? 15 : t+0.1;
        }

    }, 50);
}

/***************************** active ou désactive une bordure clignotante **********************************/
function flickeringBorder(element, swtch){
    let cpt = 0;
    if(swtch == 'on'){
        timerFB = setInterval(function () {
            // console.log(cpt);
            if(cpt % 2 == 0){
                $(element).css('outline', '1px solid white');
            }else{
                $(element).css('outline', '1px solid transparent');
            }
            cpt++;
        }, 500);
    }else{
        if(typeof(timerFB) != 'undefined')  clearInterval(timerFB);
        $(element).css('outline', 'none');
    }
}

/**********************Affichage d'un message de changement de tour***********************/
function chgTurnMssg(t){
    var message;
    if(t==0){
        message = 'A vous de jouer';
    }else{
        message = 'Tour du joueur adverse';
    }
    $('.messageBox').remove();
    var messageBox = $('<div></div>');
    messageBox.html('<p>'+message+'</p>');
    messageBox.css('padding','20px');
    messageBox.css('font-family','godzilla');
    messageBox.css('font-size','5vh');
    messageBox.css('color','white');
    messageBox.css('background-color','rgba(0,0,0,0.7)');
    messageBox.css('position','absolute');
    messageBox.css('top','50vh').css('left','50vw').css('z-index',50);
    messageBox.css('transform','translate(-50%,-60%)');
    messageBox.css('border-radius','5px');
    messageBox.addClass('messageBox');

    $('body').append(messageBox);
    fade(messageBox);
}

/********************** Fonction de zoom sur les cartes ***********************/

function zoom(target){
    let localisation = target.parent().attr('id');
    let src = target.find('img').attr('src');
    if(localisation == 'main'){
        var regex = new RegExp('carteMain (.*)', 'i');
    }else{
        var regex = new RegExp('carte (.*)', 'i');
    }
    let type = target.attr('class').replace(regex, '$1');
    let pv =  target.find('.pv').text();
    let puissance =  target.find('.puissance').text();
    let mana =  target.find('.mana').text();
    let indice = target.find('.indice').text();

    let leftOrigin = target.offset().left;
    let topOrigin = target.offset().top;
    let width = target.width();
    let height = target.height();
    
    let newDiv = $('<div>');
    let newImg = $('<img>');
    let newSpanPv = $('<span>');
    let newSpanPuissance = $('<span>');
    let newSpanMana = $('<span>');
    let newIndice = $('<span>').text(indice);
    newIndice.addClass('indice');
    let zoomWidth = ($(window).height() > 600 ? 200 : 150);

    newImg.attr('src', src);
    newImg.css('max-width', '100%');
    newSpanPv.text(pv);
    newSpanPv.addClass('pv');
    newSpanPuissance.text(puissance);
    newSpanPuissance.addClass('puissance');
    newSpanMana.text(mana);
    newSpanMana.addClass('manaCost');

    newDiv.append(newImg);
    newDiv.append(newSpanPv);
    newDiv.append(newSpanPuissance);
    newDiv.append(newSpanMana);
    newDiv.append(newIndice);

    newDiv.css('position', 'absolute');
    if(parseInt(leftOrigin+target.width()/2) < $(window).width()/2){
        newDiv.css('left', parseInt(leftOrigin+width+2)+'px');
    }else{
        newDiv.css('left', parseInt(leftOrigin-zoomWidth-2)+'px');
    }
    
    newDiv.css('width', zoomWidth+'px');
    if(localisation == 'main'){
        newDiv.css('bottom', '10vh');
    }else{
        newDiv.css('top', '50vh');
        newDiv.css('transform','translateY(-50%)');
    }
    newDiv.addClass('zoom');
   
    newDiv.css('z-index', '2');
    newDiv.css('overflow', 'visible');
    newDiv.addClass(type);
    
    $('main').append(newDiv);

    /** si c'est une carte de la main, ajout d'une infobox précisant ses nom et abilités **/
    if(localisation == 'main'){
        let libelle = target.attr('data_libelle');
        let abilite1 = target.attr('data_abilite');
        let abilite2 = target.attr('data_abilite_2');
        let infoBox = $('<div></div>');
        let oldInfoBox = $('#infoBox');
        if(oldInfoBox.length != 0)  oldInfoBox.remove();
    
        infoBox.attr('id','infoBox');
        infoBox.css('background-color','rgba(0,0,0,0.7)');
        infoBox.css('color','white');
        infoBox.css('position','absolute');
        infoBox.css('top','0');
        infoBox.css('left', parseInt(zoomWidth+2)+'px');
        infoBox.css('font-family','fira_code');
        infoBox.css('padding','0 10px');
        infoBox.css('border-radius','5px');
        infoBox.html('<p class="libelle">'+libelle+'</p>');
        if(abilite1 != '0'){
            infoBox.html(infoBox.html()+'<p class="abilite">'+abiliteTexte(abilite1)+'</p>');
            if(abilite2 != '0'){
                infoBox.html(infoBox.html()+'<p class="abilite">'+abiliteTexte(abilite2)+'</p>');
            }
        }
        newDiv.append(infoBox);
    }
}

/************************* Animation des cartes inactives (avec le css) *********************************/

function sommeil(target){
    let span = $('<span>');
    let targetTop = target.offset().top;
    let targetLeft = target.offset().left;
    let targetWidth = target.width();
    let targetHeight = target.height();

    span.text('Z');
    span.addClass('sommeil');
    span.css('position','absolute').css('top',parseInt(targetTop+targetHeight/4)+'px').css('left',parseInt(targetLeft+targetWidth/2)+'px');

    $('main').append(span);
}

/************************* Animation des éléments ciblées *********************************/

function ciblage(target){
    let div = $('<div>');
    let targetTop = target.offset().top;
    let targetLeft = target.offset().left;
    let targetWidth = target.width();
    let targetHeight = target.height();
    let targetZ = target.css('z-index');

    div.addClass('ciblage');
    div.css('position', 'absolute').css('top', '0').css('left', '0').css('width', targetWidth).css('height',targetHeight);
    div.css('z-index', parseInt(targetZ+1)).css('cursor','url(assets/img/cursor/cursorTarget.png), auto');
    if(target.parent().hasClass('Heros')){
        div.css('border-radius', '50% 50% 40% 40%');
    }else{
        div.css('border-radius', '10px');
    }
    let gradient = 0;
    let timer;
    div.hover(function(){
        timer = setInterval(function(){
        div.css('background-image', 'repeating-linear-gradient(45deg,transparent '+gradient+'%, rgba(250,250,250,0.6) '+parseInt(gradient+50)+'%, transparent '+
            parseInt(gradient+70)+'%)');
        gradient++;
    },20);
    },function(){
        clearInterval(timer);
        div.css('background-image', 'none');
    });
    
    $('main').append(div);
    target.parent().append(div);
}

/******************* animation des éléments touchés par une attaque *********************/

function hitAnimation(element,att,puissSort = null){
    let mask = element.find('.ciblage').off('hover').css('background-image', 'none').css('background-color','red');
    let cpt = 0;
    let topPosition = element.position().top;
    let timer = setInterval(function(){
        if(cpt < 100 ){
            let direction = (element.parent().attr('id') == 'bottomPlateau' || element.attr('id') == 'bottomHeros') ? 1 : -1;
            if(element.attr('class') != 'Heros'){
                element.css('top',direction*Math.sin(cpt*Math.PI/25)*200/cpt+'px');
            }else{
                element.css('top',parseInt(direction*Math.sin(cpt*Math.PI/25)*200/cpt+topPosition)+'px');
            }
            cpt++;
        }else{
            mask.remove();
            clearInterval(timer);
        }
    },5);
    mask.animate({opacity:0},300);

    /* indicateur de dommage */
    setTimeout(function(){
        let carteAtt = $('[data_gameid='+att+']');
        let puissanceAtt = $.type(puissSort) === 'null' ? carteAtt.find('.puissance').text() : puissSort;
        console.log('att:'+att+', puissanceAtt:'+puissanceAtt);
        let leftPvCible = element.find('.pv').position().left;
        let topPvCible = element.find('.pv').position().top;
        let heightAtt = carteAtt.find('.puissance').height();
        let damageCible = $('<span></span>').text('-'+puissanceAtt).addClass('damage');
        console.log('hit'+element.attr('class'));
        if(element.hasClass('carte') && !carteAtt.hasClass('sort') && $.type(puissSort) === 'null'){
            let leftPvAtt = carteAtt.find('.pv').position().left;
            let topPvAtt = carteAtt.find('.pv').position().top;
            let puissanceCible = element.find('.puissance').text();
            let damageAtt = $('<span></span>').text('-'+puissanceCible).addClass('damage');
            damageAtt.css('top',topPvAtt).css('left',leftPvAtt+heightAtt);
            carteAtt.append(damageAtt);
        }

        damageCible.css('top',topPvCible).css('left',leftPvCible+($.type(puissSort) === 'null' ? heightAtt : 10));

        element.append(damageCible);
        $('.damage').animate({left:'+=5'},500,'linear').animate({left:'+=5', opacity:'0'},500,function(){
            $(this).remove();
        });
    },500);
}

function hitAnimationJoueurPassif(result){
    let type = result['lastEventType'];
    let att = result['lastEventAtt'];
    let cible = type == 2 ? $('[data_gameid='+result['lastEventCible']+']') : $('#bottomHeros');

    if(result['lastEventAttType'] != 'sort')    $('[data_gameid='+att+']').find('img').css('outline','white 1px solid');
    ciblage(cible.find('img'));
    setTimeout(function(){
        if(result['lastEventAttType'] != 'sort'){
            hitAnimation(cible,att);
        }else{
            hitAnimation(cible,att, result['lastEventAttPuiss']);
        }
    },100);
}

/**************** Mise en forme de l'historique ************/

function historique(){
    $('#historique #events .event').each(function(){
        let img = $(this).attr('data_img');
        let eventId = $(this).attr('data_event_id');
        let top = $(this).offset().top;
        let left = $(this).offset().left;
        img = img.replace(/\\/g, '\\\\');

        $(this).css('background-image','url('+img+')').css('background-size','110%').css('background-position','center 20%');

        /* eventBox */
        let eventBox = $('.eventBox[data_event_id='+eventId+']');
        $(this).hover(function(){
            eventBox.css('display','inline-block');
            eventBox.css('top',top+$('#historique').height()+30+'px');
            eventBox.css('left',left+$(this).width()/2+'px');
            eventBox.css('transform','translateX(-50%)');
        },function(){
            eventBox.css('display','none');
        });
    });
}