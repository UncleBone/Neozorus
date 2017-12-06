
if(currentPlayer != jeton){
    gameWaitingTurn();
}else {
    gamePlay(jeton, att, cible, abilite, eog);
}

function ajax(nom, data, fct) {
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            result = JSON.parse(this.responseText);
            if(result != null){
                fct(result);
            }
        }
    };

    xhr.open("GET",".?controller=game&action="+nom+data+"&ajax=1",true);
    xhr.send();
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
        var endTurn = document.getElementById('end');
        endTurn.style.cursor = "pointer";
        endTurn.setAttribute('title','Fin de Tour');

        var error = document.querySelector('.error');
        if(error != null) fade(error);

        reqAjaxCarteMain(att);
        reqAjaxCartePlateau(jeton, att);

        var carteMain = document.getElementsByClassName('carteMain');
        var cartePlateau = document.querySelectorAll('#bottomCreature a.carte img');

        /******************animation et infobox sur les cartes de la main*******************/
        for(var carte of carteMain){
            carte.addEventListener('mouseover',function(e){
                var img = this.firstChild;
                var libelle = img.getAttribute('data_libelle');
                var abilite1 = img.getAttribute('data_abilite');
                var abilite2 = img.getAttribute('data_abilite_2');
                var infoBox = document.createElement('div');
                var oldInfoBox = document.getElementById('infoBox');
                if(oldInfoBox != null)  document.body.removeChild(oldInfoBox);

                infoBox.id = 'infoBox';
                infoBox.style.backgroundColor = 'rgba(0,0,0,0.7)';
                infoBox.style.color = 'white';
                infoBox.style.position = 'absolute';
                infoBox.style.top = e.clientY+'px';
                infoBox.style.left = e.clientX+'px';
                infoBox.style.transform = 'translate(-100%,-100%)';
                infoBox.style.fontFamily = 'fira-code';
                infoBox.style.padding = '0 10px';
                infoBox.style.borderRadius = '5px';
                infoBox.innerHTML = '<p class="libelle">'+libelle+'</p>';
                if(abilite1 != '0'){
                    infoBox.innerHTML += '<p class="abilite">'+abiliteTexte(abilite1)+'</p>';
                    if(abilite2 != '0'){
                        infoBox.innerHTML += '<p class="abilite">'+abiliteTexte(abilite2)+'</p>';
                    }
                }
                infoBox.innerHTML += '</p>';

                document.body.append(infoBox);
                this.style.top = "-10px";
            });
            carte.addEventListener('mouseout',function(){
                var oldInfoBox = document.getElementById('infoBox');
                if(oldInfoBox != null)  document.body.removeChild(oldInfoBox);
                this.style.top = "0px";
            });
        }

        /*******************Animation des cartes en jeu*********************/
        for(var carte of cartePlateau){
            carte.addEventListener('mouseover',function(){
                this.style.width = parseInt(this.clientWidth)+2+'px';
            });
            carte.addEventListener('mouseout',function(){
                this.style.width = parseInt(this.clientWidth)-2+'px';
            });
        }

        /*****************Changement de jeton au click sur le bouton 'fin de tour'******************/
        endTurn.addEventListener('click',function(){
            ajax("play", "&jeton="+(1-jeton), function(result) {
                var contenu = document.getElementById('contenu');
                // console.log('play, new jeton demandé: &jeton='+(1-jeton));
                jeton_2 = result['jeton'];
                // console.log('play, new jeton:'+jeton_2);
                contenu.innerHTML = result['view'];
                chgTurnMssg(1);
                gameWaitingTurn();
            })
        });
    }
}
/*
 * Gestion des cartes de la main en ajax
 */
function reqAjaxCarteMain(att){
    var att = att;
    var carteMain = document.getElementsByClassName('carteMain');
    for(carte of carteMain){
        let href = carte.getAttribute('href');
        carte.removeAttribute('href');
        carte.style.cursor = "pointer";
        carte.addEventListener('click', function(){
            let regex = new RegExp('.*jouer=(\\d{2,3})$', 'i');
            let id = href.match(regex)[1];
            ajax("play", "&jouer="+id, function(result) {
                var contenu = document.getElementById('contenu');
                contenu.innerHTML = result['view'];
                var infoBox = document.querySelector('#infoBox');
                if (infoBox != null) infoBox.remove();
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
    }
}

/*
 * Gestion des cartes du plateau en ajax
 */
function reqAjaxCartePlateau(jet,att){
    var jeton = jet;
    var att = att;
    var cartePlateau = document.querySelectorAll('a.carte');
    for(carte of cartePlateau){
        let href = carte.getAttribute('href');
        carte.removeAttribute('href');

        let regex = new RegExp('&att=(\\d{2,3})(?:&cible=(\\d{2,3}))*&abilite=(\\d)$', 'i');

        let attCarte = href.match(regex)[1];
        let cibleCarte = href.match(regex)[2];
        let abiliteCarte = href.match(regex)[3];

        // console.log(attCarte+' '+cibleCarte+' '+abiliteCarte);
        // console.log(att+' '+cible+' '+abilite);
        let parentId = carte.parentElement.id;
        // console.log(parentId+' currentPlayer='+currentPlayer+' jeton='+jeton+' att='+att);
        if(parentId == 'bottomCreature' && currentPlayer == jeton){
            carte.style.cursor = "pointer";
            carte.addEventListener('click', function(){

                ajax("play", "&att="+attCarte+"&abilite="+abiliteCarte, function(result) {
                    let contenu = document.getElementById('contenu');
                    contenu.innerHTML = result['view'];
                    gamePlay(result['jeton'],result['att'],result['cible'],result['abilite'],result['eog']);
                });
            });
        }else if(parentId == 'topCreature' && currentPlayer == jeton && att != '' ){
            // console.log('cible');
            carte.style.cursor = "pointer";
            carte.addEventListener('click', function(){
                // console.log('click');
                ajax("play", "&att="+att+"&cible="+cibleCarte+"&abilite="+abiliteCarte, function(result) {
                    let contenu = document.getElementById('contenu');
                    contenu.innerHTML = result['view'];
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
            var contenu = document.getElementById('contenu');
            var j = result['jeton'];
            console.log('waiting, joueur='+currentPlayer+', jeton='+j);
            contenu.innerHTML = result['view'];
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
            element.style.display = 'none';
        }else{
            element.style.opacity = op;
            element.style.filter = 'alpha(opacity=' + op * 100 + ")";
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
    var messageBox = document.createElement('div');
    messageBox.innerHTML = '<p>'+message+'</p>';
    messageBox.style.padding = '20px';
    messageBox.style.fontFamily = 'godzilla';
    messageBox.style.fontSize = '4vh';
    messageBox.style.color = 'white';
    messageBox.style.backgroundColor = 'rgba(0,0,0,0.7)';
    messageBox.style.position = 'absolute';
    messageBox.style.top = '50vh';
    messageBox.style.left = '50vw';
    messageBox.style.transform = 'translate(-50%,-60%)';
    messageBox.style.borderRadius = '5px';

    document.body.append(messageBox);
    fade(messageBox);
}