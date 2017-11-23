console.log('ligne1');
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
                // var contenu = document.getElementById('contenu');
                // var jeton = result['jeton'];

                fct(result);

                //console.log(jeton);
                // contenu.innerHTML = result['view'];
            }
        }
    };

    xhr.open("GET",".?controller=game&action="+nom+data+"&ajax=1",true);
    xhr.send();
}

function gamePlay(jet){
    jeton = jet;
    console.log('play');
    var endTurn = document.getElementById('end');

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
