window.setInterval(function(){
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            result = JSON.parse(this.responseText);
            if(result != null){
                var contenu = document.getElementById('contenu');
                contenu.innerHTML = result;
            }
        }
    };

    xhr.open("GET",".?controller=game&action=refreshViewAjax",true);
    xhr.send();
},1000);