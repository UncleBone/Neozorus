console.log(currentPlayer);
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
    console.log('play');
    var endTurn = document.getElementById('end');
    endTurn.style.cursor = "pointer";
    endTurn.setAttribute('title','Fin de Tour');

    var carteMain = document.getElementsByClassName('carteMain');
    for(var carte of carteMain){
        carte.addEventListener('mouseover',function(){
            this.style.top = "-10px";
        });
        carte.addEventListener('mouseout',function(){
            this.style.top = "0px";
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
