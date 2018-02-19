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
/*  Déclenche le changement de jeton au click sur le bouton fin de tour
 */

function gamePlay(jet, att, cible, abilite, eog){
    var jeton = jet;
    // var eog = eog;
    // var att = att;
    // var cible = cible;
    // var abilite = abilite;
    var timerFB;
    console.log('jet:'+jet+', att:'+att+', cible:'+cible+', abilite:'+abilite+' eog:'+eog);
    historique();
    if(eog != '1'){
        $('#end').css('cursor','pointer').attr('title','Fin de tour');

        if($('.error').length != 0) fade($('.error'));
        $('.sommeil').remove();

        var carteMain = $('.carteMain');
  
        $('#plateau :not(.carte)').off('click'); // réinitialisation de l'event click
        $('main').css('cursor','auto'); // réinitialisation du curseur
        $('.ciblage').remove(); // effacement des animations de ciblage
        flickeringBorder($('#bottomPlateau .carte').find('img'), 'off');    // effacement de la bordure clignotante

        reqAjaxCarteMain(att);
        reqAjaxCartePlateau(jeton, att, abilite);
        reqAjaxJoueur(jeton,att, abilite);
        

        /* si mode attaque activé: sélection désactivée au click sur le plateau ou sur cette même carte */
        if($.isNumeric(att)) {
            $('#plateau :not(.carte)').click(function(){
                console.log($(this));
                $('.message').remove();
                gamePlay(jeton, '', '', abilite, eog);
            });
            // $('#plateau :not(.carte)').css('cursor','url(assets/img/cursor/cursorCross.png), auto');
        }
        // var cartePlateau = $('#bottomPlateau a.carte');

        /****************** animation et zoom sur les cartes de la main *******************/

        carteMain.each(function(){
            let id = $(this).attr('data_id');
            let indice = $(this).attr('data_indice');
            let gameId = $(this).attr('data_gameid');
            // console.log(att+' '+id+indice);
            $(this).off('mouseenter mouseleave');
            $(this).find('img').css('outline','none');
            // $(this).off('click');
            if(!$.isNumeric(att)){
                $(this).css('top',"40px");
                let timer;
                $(this).hover(function(e){
                    $(this).css('top','10px');
                    var target = $(this);
                    timer = setTimeout(zoom, 1000, target);
                }, function(){
                    $(this).css('top',"40px");
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });
                $(this).click(function(){
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });
            // }else if(att == id+indice){
            }else if(att == gameId){
                flickeringBorder($(this).find('img'), 'on');
            }
        });

        /****************** animations et zoom sur les cartes du plateau *******************/

        $('.carte').each(function(){
            let timer;
            let target = $(this);
            let id = $(this).attr('data_id');
            let index = $(this).find('.indice span').text();
            let gameId = $(this).attr('data_gameid');
// console.log(att+' '+gameId);
            if(target.attr('data_active') == 0 ){
                sommeil(target);
            }
            
            // console.log('att:'+att+', id+index:'+id+index);
            target.css('cursor','auto');    // réinitialisation du curseur
            $(this).off('mouseenter mouseleave');   // désactivation du hover

            /* Si aucune carte n'est sélectionnée pour attaquer: border au hover + zoom */
            if(!$.isNumeric(att)){ 
                $(this).hover(function(e){     
                    target.find('img').css('outline', '1px solid white');
                    timer = setTimeout(zoom, 1000, target);
                    // console.log('hover');
                }, function(){
                    $(this).find('img').css('outline',"none");
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });
                $(this).click(function(){
                    $('[class^=zoom]').remove();
                    clearTimeout(timer);
                });
            /* Si mode attaque activé: animation pour les cibles + bordure clignotante pour la carte attaquante */
            }else{ 

                // if (att != id+index){
                if (att != gameId){
                    $('main').css('cursor','url(assets/img/cursor/cursorCross.png), auto');
                    if(target.parent().attr('id') == 'topPlateau' && target.attr('data_visable') == '1'){
                        // target.css('cursor','url(assets/img/cursor/cursorTarget.png), auto');
                        ciblage(target.find('img'));
                    }else{
                        target.css('cursor','url(assets/img/cursor/cursorCross.png), auto');
                    }
                }else{

                // let width = target.width(); 
                // target.find('img').css('outline', 'none');

                flickeringBorder(target.find('img'), 'on');
                // target.css('width', parseInt(width+5)+'px');
                // target.find('img').css('box-shadow', '5px 5px 5px');

                }
            }
        });


        /***************** Changement de jeton au click sur le bouton 'fin de tour' ******************/

        $('#end img').click(function(){
            ajax("play", "&jeton="+(1-jeton), function(result) {
                var contenu = $('#contenu');
                contenu.html(result['view']);
                chgTurnMssg(1);
                gameWaitingTurn();
            });
        });
    }else{
        $('.carteMain').off('click hover');
        $('.carteMain').css('cursor','auto');
        $('.carteMain').removeAttr('href');
    }
}
/*
 * Gestion des cartes de la main en ajax
 */
function reqAjaxCarteMain(att){
    var att = att;
    var carteMain = $('.carteMain');
    carteMain.each(function(){
        let href = $(this).attr('href');
        // $(this).removeAttr('href');
        $(this).css('cursor',"pointer");
        $(this).off('click');
        $(this).click(function(e){
            e.preventDefault();
            let carte = $(this);
            carte.off('hover');
            $('[class^=zoom]').remove();
            let regex = new RegExp('.*jouer=(\\d+)$', 'i');
            let id = href.match(regex)[1];
            ajax("play", "&jouer="+id, function(result) {
                console.log(id);
                if(result['error'] != null){
                    $('.error').remove();
                    $('.message').remove();
                    if(result['error'] == "Vous n'avez pas assez de mana!" ){
                        let error = $('<p>').addClass('error').text(result['error']);
                        $('main').append(error);
                        fade(error);
                    }else if(result['error'] == "Choisissez la cible" ){
                        carte.addClass('att');
                        let message = $('<p>').addClass('message').text(result['error']);
                        $('main').append(message);
                        // let id = carte.find('img').attr('data_id');
                        // let indice = carte.find('img').attr('data_indice');
                        // let attCarte = id+indice;
                        let attCarte = id;
                        let abilite = [];
                        let abiliteCarte = 0;
                        abilite.push(carte.attr('data_abilite'));
                        abilite.push(carte.attr('data_abilite_2'));
                        for(ab of abilite){
                            if(ab != 0) abiliteCarte = ab;
                        }
                        gamePlay(jeton,attCarte,cible,abiliteCarte,eog);
                    }
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
function reqAjaxCartePlateau(jet,att,abilite){
    var jeton = jet;
    var att = att;
    var cartePlateau = $('.carte');
    cartePlateau.each(function(){
        // cartePlateau.off('click');
        let href = $(this).attr('href');
        // console.log(href);
        // $(this).removeAttr('href');
        // console.log(href);
        let regex = new RegExp('&att=(\\d+)(?:&cible=(\\d+))*&abilite=(\\d)$', 'i');
        if(typeof(href) != 'undefined'){
            var attCarte = href.match(regex)[1];
            var cibleCarte = href.match(regex)[2];
            var abiliteCarte = href.match(regex)[3];
        }

        let parentId = $(this).parent().attr('id');

        if(parentId == 'bottomPlateau' && currentPlayer == jeton && $(this).attr('data_active') == 1){
            bottomPlateau($(this),attCarte,abiliteCarte,jeton,cible,eog)
            // $(this).css('cursor',"pointer");
            // $(this).off('click');
            // $(this).click(function(e){
            //     e.preventDefault();
            //     e.stopPropagation();
                // console.log('click');
                // console.log($._data( $(this)[0], 'events' ));
                // console.log($(this));
                // $(this).off('mouseenter mouseleave');
                // $('[class^=zoom]').remove();
                // console.log($._data( $(this)[0], 'events' ));
                // ajax("play", "&att="+attCarte+"&abilite="+abiliteCarte, function(result) {
                // ajax("play", "&att="+att+"&abilite="+abilite, function(result) {
                    
                    // if(result['error'] != null){
                    //     $('.error').remove();
                    //     $('.message').remove();
                    //     let message = $('<p>').addClass('message').text(result['error']);
                    //     $('main').append(message);
                    //     gamePlay(jeton,attCarte,cible,abiliteCarte,eog);
                    // }else{
                    //     console.log('ligne 229');
                        // let contenu = $('#contenu');
                        // contenu.html(result['view']);
                        //  gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                    // }
                    
                // });
            // });
        }else if(parentId == 'topPlateau' && currentPlayer == jeton && att != '' ){
            topPlateau($(this),att,abilite,jeton,cibleCarte,eog)
            // $(this).css('cursor',"pointer");
            // $(this).click(function(e){
            //     e.preventDefault();
            //     e.stopPropagation();
                // console.log(cibleCarte);
                // let id = $(this).attr('data_id');
                // let index = $(this).find('.indice span').text();
                // // let anim = hitAnimation($(this));
                // hitAnimation($(this));
                // console.log('hit');
                // ajax("play", "&att="+att+"&cible="+cibleCarte+"&abilite="+abiliteCarte, function(result) {
                // if(anim == 'animationStop'){
                    // ajax("play", "&att="+att+"&cible="+id+index+"&abilite="+abilite, function(result) {
                    //     let contenu = $('#contenu');
                    //     hitAnimation($(this));

                    //     // contenu.html(result['view']);
                        
                    //     gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                    // });
                // }
            // });
        }
    });
}

/********************* Gestion des cartes du joueur actif *********************/

function bottomPlateau(carte,attCarte,abiliteCarte,jeton,cible,eog){
    carte.off('click');
    carte.css('cursor',"pointer");
    carte.click(function(e){
        e.preventDefault();
        e.stopPropagation();
        ajax("play", "&att="+attCarte+"&abilite="+abiliteCarte, function(result) {
          
            if(result['error'] != null){
                $('.error').remove();
                $('.message').remove();
                let message = $('<p>').addClass('message').text(result['error']);
                $('main').append(message);
                gamePlay(jeton,attCarte,cible,abiliteCarte,eog);
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
        // console.log('click');
        e.preventDefault();
        
        // let id = $(this).attr('data_id');
        // let index = $(this).find('.indice span').text();
        hitAnimation($(this),att);
        // console.log(cible);
        setTimeout(function(){
            ajax("play", "&att="+att+"&cible="+cible+"&abilite="+abilite, function(result) {
                let contenu = $('#contenu');
                contenu.html(result['view']);             
                gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
            });
        }, 1000);
        // console.log('hit');
        // ajax("play", "&att="+att+"&cible="+cibleCarte+"&abilite="+abiliteCarte, function(result) {
        // if(anim == 'animationStop'){
            // ajax("play", "&att="+att+"&cible="+id+index+"&abilite="+abilite, function(result) {
            //     let contenu = $('#contenu');
            //     hitAnimation($(this));

            //     // contenu.html(result['view']);
                
            //     gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
            // });
        // }
    });
}

/********************* Gestion du héros du joueur adverse *********************/

function reqAjaxJoueur(jet, att, abilite){
    let jeton = jet;
    let joueurAdverse = $('#topHeros');
    joueurAdverse.css('cursor','auto'); // réinitialisation du curseur
    joueurAdverse.off('click'); // désactivation de l'event
    if($.isNumeric(att) && joueurAdverse.attr('data_visable') == 1){
        // console.log('att'+att);
        // let href = joueurAdverse.find('a').attr('href');
        // joueurAdverse.removeAttr('href');
        // console.log(href);
        // let regex = new RegExp('&att=(\\d{2,3})&cible=(J[01])&abilite=(\\d)$', 'i');

        // let att = href.match(regex)[1];
        // let cible = href.match(regex)[2];
        // let abilite = href.match(regex)[3];

        // joueurAdverse.css('cursor','url(assets/img/cursor/cursorTarget.png), auto');
        ciblage(joueurAdverse.find('img'));
        // if(currentPlayer == jeton){
            // joueurAdverse.css('cursor',"pointer");
        let cible = joueurAdverse.attr('data_cible');
        joueurAdverse.click(function(e){
            e.preventDefault();
            hitAnimation($(this),att);
            setTimeout(function(){
                ajax("play", "&att="+att+"&cible="+cible+"&abilite="+abilite, function(result) {
                    let contenu = $('#contenu');
                    contenu.html(result['view']);
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                });
            },1000);
        });
        // }
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
    historique();
    interval = window.setInterval(function(){
        console.log('waiting');
        ajax("refreshViewAjax", "", function(result) {
            var contenu = $('#contenu');
            var j = result['jeton'];
            contenu.html(result['view']);
            historique();
            if(!result['eog']){
                if(j==currentPlayer){
                    chgTurnMssg(0);
                    gamePlay(j,result['att'],result['cible'],result['abilite'],result['eog']);
                    clearInterval(interval);     
                }
            }else{       
                clearInterval(interval);  
            }
        })
    },1000);
    // $('#end img:hover').css('animation', 'none');
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

/***************************** border clignotante **********************************/
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
        // console.log('clearInterval');
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
    messageBox.css('font-size','4vh');
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
    if(localisation != 'main'){
        var indice = target.find('.indice span').text();
    }
    let leftOrigin = target.offset().left;
    let topOrigin = target.offset().top;
    let width = target.width();
    let height = target.height();
    
    let newDiv = $('<div>');
    let newImg = $('<img>');
    let newSpanPv = $('<span>');
    let newSpanPuissance = $('<span>');
    let newSpanMana = $('<span>');
    if(localisation != 'main'){
        var newIndice = $('<div>').html('<span>'+indice+'</span>');
        newIndice.addClass('indice');
    }
    let zoomWidth = 200;

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
    if(localisation != 'main'){
        newDiv.append(newIndice);
    }

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

    if(localisation == 'main'){
        let img = target.find('img');
        let libelle = img.attr('data_libelle');
        let abilite1 = img.attr('data_abilite');
        let abilite2 = img.attr('data_abilite_2');
        let infoBox = $('<div></div>');
        let oldInfoBox = $('#infoBox');
        if(oldInfoBox.length != 0)  oldInfoBox.remove();
    
        infoBox.attr('id','infoBox');
        infoBox.css('background-color','rgba(0,0,0,0.7)');
        infoBox.css('color','white');
        infoBox.css('position','absolute');
        infoBox.css('top','0');
        infoBox.css('left', parseInt(zoomWidth+2)+'px');
        // infoBox.css('transform','translate(-100%,-100%)');
        infoBox.css('font-family','fira-code');
        infoBox.css('padding','0 10px');
        infoBox.css('border-radius','5px');
        // infoBox.css('width', zoomWidth);
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
    if(target.parent().attr('id') == 'topHeros'){
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
        // console.log(gradient);
    },20);
    },function(){
        clearInterval(timer);
        div.css('background-image', 'none');
    });
    
    $('main').append(div);
    target.parent().append(div);
}

/******************* animation des éléments touchés par une attaque *********************/

function hitAnimation(element,att){
    let mask = element.find('.ciblage').off('hover').css('background-image', 'none').css('background-color','red');
    let cpt = 0;
    let topPosition = element.position().top;
    let timer = setInterval(function(){
        if(cpt < 100 ){
            if(element.attr('id') != 'topHeros'){
                element.css('top',-Math.sin(cpt*Math.PI/25)*200/cpt+'px');
            }else{
                element.css('top',parseInt(-Math.sin(cpt*Math.PI/25)*200/cpt+topPosition)+'px');
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
        let puissanceAtt = carteAtt.find('.puissance').text();
        let leftPvCible = element.find('.pv').position().left;
        let topPvCible = element.find('.pv').position().top;
        let heightAtt = carteAtt.find('.puissance').height();
        let damageCible = $('<span></span>').text('-'+puissanceAtt).addClass('damage');

        if(element.hasClass('carte') && !carteAtt.hasClass('sort')){
            let leftPvAtt = carteAtt.find('.pv').position().left;
            let topPvAtt = carteAtt.find('.pv').position().top;
            let puissanceCible = element.find('.puissance').text();
            let damageAtt = $('<span></span>').text('-'+puissanceCible).addClass('damage');
            damageAtt.css('top',topPvAtt).css('left',leftPvAtt+heightAtt);
            carteAtt.append(damageAtt);
        }

        damageCible.css('top',topPvCible).css('left',leftPvCible+heightAtt);

        element.append(damageCible);
        $('.damage').animate({left:'+=5'},500,'linear').animate({left:'+=5', opacity:'0'},500,function(){
            $(this).remove();
        });
    },500);

    // $(window).delay(5000);
}

/**************** Mise en forme de l'historique ************/

function historique(){
    $('#historique #events .event').each(function(){
        let img = $(this).attr('data_img');
        let event = $(this).attr('data_event');
        let type = $(this).attr('data_type_carte');
        let eventId = $(this).attr('data_event_id');
        let top = $(this).offset().top;
        let left = $(this).offset().left;
        img = img.replace(/\\/g, '\\\\');
        // if($(this).attr('data_joueur') == jeton){
        //     $(this).css('border','2px solid rgb(120,189,222)').css('color','rgb(120,189,222)');
        // }else{
        //     $(this).css('border','2px solid rgb(195,10,48)').css('color','rgb(195,10,48)');
        // }
        $(this).css('background-image','url('+img+')').css('background-size','110%').css('background-position','center 20%');
        
        // if(event != 1 && type != 'sort'){
        //     let span = $('<span></span>').text('Vs');
        //     $(this).append(span);
        // }else if(event != 1 && type == 'sort'){
        //     let imgPath = 'assets/img/hist/sort_'+($(this).attr('data_joueur') == jeton ? '1' : '2')+'_alt.png';
        //     let imgSort = $('<img>').attr('src',imgPath).addClass('sort');
        //     $(this).append(imgSort);
        // }
        // if(event == 2 && type != 'sort' && $(this).attr('data_mort_att') == 0){
        //     let imgPath = 'assets/img/hist/skull_bis.png';
        //     let imgSkull = $('<img>').attr('src',imgPath).addClass('skull');
        //     $(this).append(imgSkull);
        // }

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