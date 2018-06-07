

$(document).ready(function() {

	$("select#selectCategoria").on('change', function(event) {
		$.ajax({
			type: "POST",
			url: "controllers/cambiocategoria.php", 
			data: {"categoria": this.value},
			dataType: 'json',
			success: function(respuesta){
				var select='<select id="selectProducto" name="selectProducto" class="selectpicker">';
					for(var i=0;i<respuesta.length;i++){
						select+='<option>'+respuesta[i]+'</option>';
					}
					select+='</select>';
					$("select#selectProducto").remove();
					
					$("select#selectCategoria").parent().append(select);
			}
		})
		.done(function() {
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});



	
});




function imprimeProductos(productos){
	var select='<select id="selectProducto" class="selectpicker">';
	productos.each(function(i, element) {
		select+='<option>'+element[i]+'</option>';
	});
	select+='</select>';

	
	return select;
}