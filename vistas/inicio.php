<?php 
   require_once"dependencias.php";
	?>
<!DOCTYPE html>

<html>

<head>
	<meta charset="utf-8">
	<title>series & videos</title>	
<link rel="stylesheet" type="text/css" href="../css/estilos.css">

</head>

   
<body>
	
	<header>
		<div class="walper">
		<div class="logo">
			Serie & Peliculas
		</div>
	       <nav>
				<span  id="seriesbtn">series</span>
				<span  id="peliculasbtn">peliculas</span>
		   </nav>
		   </div>	
		</header>
		<div class="container">
			
		 <div class="row">
		 	<div class="col-sm-12">
		 		<div id="series"></div>
		 		<div id="peliculas"></div>
		 	</div>
		 </div>

	</div>
	


</body>
</html>
<script type="text/javascript">
	$(document).ready(function(){
	$('#seriesbtn').click(function(){
       escondersecion();
    $('#series').load('portafolioseries.php');
    $('#series').show();

	});
	$('#peliculasbtn').click(function(){
       escondersecion();
    $('#peliculas').load('portafoliopeliculas.php');
    $('#peliculas').show();

	});
	function escondersecion(){
     	    	$('#series').hide();
     	    	$('#peliculas').hide();
     	    	     	   
     	    }
})
</script>
