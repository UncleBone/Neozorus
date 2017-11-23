$(function(){
	function changedNameCallback(result){
		let newName = JSON.parse(result);
		if(newName != ''){
			$('h1').text(newName);
		}
	}

	let baseName =$('#nameDeck').val();

	$('#nameButton').on('click',function(){
		if( $('#nameDeck').val()!= baseName){
			if($('#nameDeck').val()!=''){
				if($('#nameDeck').val().match("^[a-zA-Z0-9-_]{3,60}$")){
					//console.log('index.php?controller=deck&action=changeNameDeck&deck='+id);
					//console.log({newName:$('#nameDeck').val()});
					$.post('index.php?controller=deck&action=changeNameDeck&deck='+id,{newName:$('#nameDeck').val()},changedNameCallback);
				}
				else{
					alert('Le nom d\'un deck contient uniquement des caractères alphanumériques ou des tirets, et doit être compris entre 3 et 60 caractères');
				}
			}
			else{
				alert('Le nom d\'un deck ne doit pas être vide');
				$('#nameDeck').val(baseName);
			}
		}
		else{
			alert('Vous n\'avez pas changé de nom!');
		}
	});
});