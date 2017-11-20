    var message = document.getElementsByClassName('message')[0];
    id = message.getAttribute('data_id');
    window.setInterval(function(){
       var xhr = new XMLHttpRequest();

       xhr.onreadystatechange = function(){
         if(this.readyState == 4 && this.status == 200){
            result = JSON.parse(this.responseText);
            if(result != null && result.length==2){
                document.location.href=".?controller=game&action=play";
            }
         }
       };

       xhr.open("GET",".?controller=game&action=waitAjax&id="+id,true);
       xhr.send();
    },1000);

