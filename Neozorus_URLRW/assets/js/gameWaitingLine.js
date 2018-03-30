$(function(){
  let message = $('.message');
  let id = message.attr('data_id'); 
  let cpt = 0;
  window.setInterval(function(){
    let newSpan = $('<span>');
    let text = '';
    for(i=0;i<(cpt%4);i++){
      text += '.';
    }
    newSpan.text(text);
    newSpan.css('position','absolute');
    message.find('p span').remove();
    message.find('p').append(newSpan);      
    cpt++;

    $.getJSON('.?controller=game&action=waitAjax&id='+id, function(result){
      // console.log(result);
      if(result != null && result.length==2){
        window.location.replace(".?controller=game&action=play");
      }
    });

  },600); 
});

//     window.setInterval(function(){
      
//     });
// },1000);

// var message = document.getElementsByClassName('message')[0];
// var id = message.getAttribute('data_id');
// window.setInterval(function(){
// var xhr = new XMLHttpRequest();

// xhr.onreadystatechange = function(){
// if(this.readyState == 4 && this.status == 200){
// result = JSON.parse(this.responseText);
// if(result != null && result.length==2){
// document.location.href=".?controller=game&action=play";
// }
// }
// };

// xhr.open("GET",".?controller=game&action=waitAjax&id="+id,true);
// xhr.send();
// },1000);

