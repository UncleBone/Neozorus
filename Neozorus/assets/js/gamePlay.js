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
    var eog = eog;
    var att = att;
    var cible = cible;
    var abilite = abilite;

    if(eog != '1'){
        $('#end').css('cursor','pointer').attr('title','Fin de tour');

        if($('.error').length != 0) fade($('.error'));

        reqAjaxCarteMain(att);
        reqAjaxCartePlateau(jeton, att);
        reqAjaxJoueur(jeton);

        var carteMain = $('.carteMain');
        // var cartePlateau = $('#bottomPlateau a.carte');

        /****************** animation et zoom sur les cartes de la main *******************/

        carteMain.each(function(){
            let timer;
            $(this).hover(function(e){
                $(this).css('top','10px');
                var target = $(this);
                timer = setTimeout(zoom, 1000, target);
            }, function(){
                // var oldInfoBox = $('#infoBox');
                // if(oldInfoBox.length != 0)  oldInfoBox.remove();
                $(this).css('top',"40px");
                $('[class^=zoom]').remove();
                clearTimeout(timer);
            });
        });

        /****************** animation et zoom sur les cartes du plateau *******************/

        $('.carte').each(function(){
            let timer;
            $(this).hover(function(e){
                // $(this).css('top','10px');
                var target = $(this);
                target.find('img').css('outline', '1px solid white');
                timer = setTimeout(zoom, 1000, target);
            }, function(){
                // var oldInfoBox = $('#infoBox');
                // if(oldInfoBox.length != 0)  oldInfoBox.remove();
                $(this).find('img').css('outline',"none");
                $('[class^=zoom]').remove();
                clearTimeout(timer);
            });
        });

        /*******************Animation des cartes en jeu*********************/
        // cartePlateau.each(function(){
        //     $(this).mouseover(function(){
        //         $(this).css('width',parseInt(this.clientWidth)+2+'px');
        //     });
        //     $(this).mouseout(function(){
        //         $(this).css('width',parseInt(this.clientWidth)-2+'px');
        //     });
        // });

        /*****************Changement de jeton au click sur le bouton 'fin de tour'******************/
        $('#end img').click(function(){
            // console.log('fin de tour');
            ajax("play", "&jeton="+(1-jeton), function(result) {
                var contenu = $('#contenu');
                contenu.html(result['view']);
                chgTurnMssg(1);
                gameWaitingTurn();
            });
        });
        // $('#end img').hover(function(){
        //     $(this).attr('src','./assets/img/plateau/bouton_valid2.png');
        // }, function(){
        //     $(this).attr('src','./assets/img/plateau/bouton_valid1.png');
        // });
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
        $(this).removeAttr('href');
        $(this).css('cursor',"pointer");
        $(this).click(function(){
            $(this).off('hover');
            $('[class^=zoom]').remove();
            let regex = new RegExp('.*jouer=(\\d{2,3})$', 'i');
            let id = href.match(regex)[1];
            ajax("play", "&jouer="+id, function(result) {
                console.log(id);
                var contenu = $('#contenu');
                contenu.html(result['view']);
                var infoBox = $('#infoBox');
                if (infoBox.length != 0) infoBox.remove();
                gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
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
function reqAjaxCartePlateau(jet,att){
    var jeton = jet;
    var att = att;
    var cartePlateau = $('a.carte');
    cartePlateau.each(function(){
        let href = $(this).attr('href');
        $(this).removeAttr('href');
        // console.log(href);
        let regex = new RegExp('&att=(\\d{2,3})(?:&cible=(\\d{2,3}))*&abilite=(\\d)$', 'i');

        if(typeof(href) != 'undefined'){
            var attCarte = href.match(regex)[1];
            var cibleCarte = href.match(regex)[2];
            var abiliteCarte = href.match(regex)[3];
        }

        let parentId = $(this).parent().attr('id');

        if(parentId == 'bottomPlateau' && currentPlayer == jeton && $(this).attr('data_active') == 1){
            $(this).css('cursor',"pointer");
            $(this).click(function(){
                ajax("play", "&att="+attCarte+"&abilite="+abiliteCarte, function(result) {
                    let contenu = $('#contenu');
                    contenu.html(result['view']);
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                });
            });
        }else if(parentId == 'topPlateau' && currentPlayer == jeton && att != '' ){
            $(this).css('cursor',"pointer");
            $(this).click(function(){
                ajax("play", "&att="+att+"&cible="+cibleCarte+"&abilite="+abiliteCarte, function(result) {
                    let contenu = $('#contenu');
                    contenu.html(result['view']);
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                });
            });
        }
    });
}

function reqAjaxJoueur(jet){
    let jeton = jet;
    let joueurAdverse = $('#topHero a');
    if(joueurAdverse.length != 0){
        let href = joueurAdverse.attr('href');
        joueurAdverse.removeAttr('href');

        let regex = new RegExp('&att=(\\d{2,3})&cible=(J[01])&abilite=(\\d)$', 'i');

        let att = href.match(regex)[1];
        let cible = href.match(regex)[2];
        let abilite = href.match(regex)[3];
        if(currentPlayer == jeton && att != '' ){
            joueurAdverse.css('cursor',"pointer");
            joueurAdverse.click(function(){
                ajax("play", "&att="+att+"&cible="+cible+"&abilite="+abilite, function(result) {
                    let contenu = $('#contenu');
                    contenu.html(result['view']);
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                });
            });
        }
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
    interval = window.setInterval(function(){
        console.log('waiting');
        ajax("refreshViewAjax", "", function(result) {
            var contenu = $('#contenu');
            var j = result['jeton'];
            contenu.html(result['view']);
            if(j==currentPlayer){
                chgTurnMssg(0);
                gamePlay(j,result['att'],result['cible'],result['abilite'],result['eog']);
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

/**********************Affichage d'un message de changement de tour***********************/
function chgTurnMssg(t){
    var message;
    if(t==0){
        message = 'A vous de jouer';
    }else{
        message = 'Tour du joueur adverse';
    }
    var messageBox = $('<div></div>');
    messageBox.html('<p>'+message+'</p>');
    messageBox.css('padding','20px');
    messageBox.css('font-family','godzilla');
    messageBox.css('font-size','4vh');
    messageBox.css('color','white');
    messageBox.css('background-color','rgba(0,0,0,0.7)');
    messageBox.css('position','absolute');
    messageBox.css('top','50vh');
    messageBox.css('left','50vw');
    messageBox.css('transform','translate(-50%,-60%)');
    messageBox.css('border-radius','5px');

    $('body').append(messageBox);
    fade(messageBox);
}

/********************** Fonction de zoom sur les cartes ***********************/

function zoom(target){
    let localisation = target.parent().attr('id');
    let src = target.find('img').attr('src');
    // console.log(localisation);
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