
if(currentPlayer != jeton){
    gameWaitingTurn();
}else {
    gamePlay();
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

function gamePlay(){
    var endTurn = document.getElementById('end');

    endTurn.addEventListener('click',function(){


        ajax("play", "&jeton="+(1-jeton), function(result) {
            var contenu = document.getElementById('contenu');
            var jeton = result['jeton'];
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
            var jeton = result['jeton'];
            contenu.innerHTML = result['view'];
            console.log('jeton='+jeton+'joueur='+currentPlayer);
            if(jeton==currentPlayer){
                gamePlay();
                clearInterval(interval);     
            }
        })
    },1000);
}


// function gameWaitingTurn(){
//     window.setInterval(function(){
//         var xhr = new XMLHttpRequest();
//         xhr.onreadystatechange = function(){
//             if(this.readyState == 4 && this.status == 200){
//                 // console.log(this.responseText);
//                 result = JSON.parse(this.responseText);
//                 if(result != null){
//                     var contenu = document.getElementById('contenu');
//                     var jeton = result['jeton'];
//                     console.log(jeton);
//                     contenu.innerHTML = result['view'];
//                 }
//             }
//         };
//
//         xhr.open("GET",".?controller=game&action=refreshViewAjax&ajax=1",true);
//         xhr.send();
//     },1000);
// }
