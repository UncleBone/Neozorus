
if(currentPlayer != jeton){
    gameWaitingTurn();
}else {
    gamePlay(jeton);
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

function gamePlay(jet){
    jeton = jet;
    if(eog != '1'){
        var endTurn = document.getElementById('end');
        endTurn.style.cursor = "pointer";
        endTurn.setAttribute('title','Fin de Tour');

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

        endTurn.addEventListener('click',function(){
            ajax("play", "&jeton="+(1-jeton), function(result) {
                var contenu = document.getElementById('contenu');
                console.log('play, new jeton demandé: &jeton='+(1-jeton));
                jeton_2 = result['jeton'];
                console.log('play, new jeton:'+jeton_2);
                contenu.innerHTML = result['view'];
                gameWaitingTurn();
            })
        });
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
                gamePlay(j);
                clearInterval(interval);     
            }
        })
    },1000);
}
