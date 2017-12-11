
if(currentPlayer != jeton){
    gameWaitingTurn();
}else {
    gamePlay(jeton, att, cible, abilite, eog);
}

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
        var cartePlateau = $('#bottomCreature a.carte img');

        /******************animation et infobox sur les cartes de la main*******************/
        carteMain.each(function(){
            $(this).mouseover(function(e){
                var img = $(this).find('img');
                var libelle = img.attr('data_libelle');
                var abilite1 = img.attr('data_abilite');
                var abilite2 = img.attr('data_abilite_2');
                var infoBox = $('<div></div>');
                var oldInfoBox = $('#infoBox');
                if(oldInfoBox.length != 0)  oldInfoBox.remove();

                infoBox.attr('id','infoBox');
                infoBox.css('background-color','rgba(0,0,0,0.7)');
                infoBox.css('color','white');
                infoBox.css('position','absolute');
                infoBox.css('top',e.clientY+'px');
                infoBox.css('left',e.clientX+'px');
                infoBox.css('transform','translate(-100%,-100%)');
                infoBox.css('font-family','fira-code');
                infoBox.css('padding','0 10px');
                infoBox.css('border-radius','5px');
                infoBox.html('<p class="libelle">'+libelle+'</p>');
                if(abilite1 != '0'){
                    infoBox.html(infoBox.html()+'<p class="abilite">'+abiliteTexte(abilite1)+'</p>');
                    if(abilite2 != '0'){
                        infoBox.html(infoBox.html()+'<p class="abilite">'+abiliteTexte(abilite2)+'</p>');
                    }
                }
                $('body').append(infoBox);
                $(this).css('top','-10px');
            });
            $(this).mouseout(function(){
                var oldInfoBox = $('#infoBox');
                if(oldInfoBox.length != 0)  oldInfoBox.remove();
                $(this).css('top',"0px");
            });
        });

        /*******************Animation des cartes en jeu*********************/
        cartePlateau.each(function(){
            $(this).mouseover(function(){
                $(this).css('width',parseInt(this.clientWidth)+2+'px');
            });
            $(this).mouseout(function(){
                $(this).css('width',parseInt(this.clientWidth)-2+'px');
            });
        });

        /*****************Changement de jeton au click sur le bouton 'fin de tour'******************/
        $('#end').click(function(){
            ajax("play", "&jeton="+(1-jeton), function(result) {
                var contenu = $('#contenu');
                contenu.html(result['view']);
                chgTurnMssg(1);
                gameWaitingTurn();
            });
        });
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
            let regex = new RegExp('.*jouer=(\\d{2,3})$', 'i');
            let id = href.match(regex)[1];
            ajax("play", "&jouer="+id, function(result) {
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

        let regex = new RegExp('&att=(\\d{2,3})(?:&cible=(\\d{2,3}))*&abilite=(\\d)$', 'i');

        let attCarte = href.match(regex)[1];
        let cibleCarte = href.match(regex)[2];
        let abiliteCarte = href.match(regex)[3];

        let parentId = $(this).parent().attr('id');

        if(parentId == 'bottomCreature' && currentPlayer == jeton){
            $(this).css('cursor',"pointer");
            $(this).click(function(){

                ajax("play", "&att="+attCarte+"&abilite="+abiliteCarte, function(result) {
                    let contenu = $('#contenu');
                    contenu.html(result['view']);
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                });
            });
        }else if(parentId == 'topCreature' && currentPlayer == jeton && att != '' ){
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