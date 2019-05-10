$(function () {
	$('#form-search').submit(function(e) {
		e.preventDefault();
	})
	$('#buscar').keyup(function(){
		var envio= $('#buscar').val();
		$('#resultado-q').html('<h4>Cargando</h4>');
		$.ajax({
			type: 'post',
			url: '../clases/buscarp.php',
			data: ('buscar='+envio),
			success: function(respuesta) {
				if(respuesta != '') {
					$('#resultado-q').html(respuesta);
				}
			}
		})
	})
})