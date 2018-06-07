$(document).ready(function() {

	$('a#megusta').each(function() {

		$(this).click(function() { 
			$.ajax({ type: "POST",
			    url: "controllers/megusta.php", 
			    data: {"autorid":$(this).attr('id_autor'),"postid":$(this).attr('id_post')},
			    datatype:'json',
			   success: function(respuesta){ 
					$("a#megusta span#cantidad").html(respuesta); 
						return false;
			 	}//FUNCION 
			});//AJAX 
			return false;
			 });//me gusta 
	});

	
  
});

	