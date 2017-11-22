
    window.setInterval(function(){
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                // console.log(this.responseText);
                result = JSON.parse(this.responseText);
                if(result != null){
                    var contenu = document.getElementById('contenu');
                    var jeton = result['jeton'];
                    //console.log(jeton);
                    contenu.innerHTML = result['view'];
                }
            }
        };

        xhr.open("GET",".?controller=game&action=refreshViewAjax&ajax=1",true);
        xhr.send();
    },1000);
