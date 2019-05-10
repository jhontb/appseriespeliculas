<!DOCTYPE html>
<?php
$cod=$_REQUEST['cod'];
include'../clases/conexion.php';

 $sql=("SELECT * FROM peliculas WHERE idpelicula=$cod");
 $sentencia=$con->prepare($sql);
 $sentencia->execute();
 $resultado=$sentencia->fetchAll();

foreach ($resultado as $row) 
{
$id=$row['idpelicula'];	
$til=$row['titulo'];
$año=$row['year'];
$gen=$row['genero'];
$act=$row['actores'];
$des=$row['descripcion'];
$img=$row['imagen'];






?>


<html>
<head>
	<?php
     require_once"dependencias.php";
	 ?>
	<title></title>
</head>
<body>
	<form>
		<table class="table table-hover">
			<tr class="bg-info">
				<th class="p-3 mb-2 bg-warning text-dark" rowspan="6"><img src="../imgp/<?php echo $img?>" width="200" height="200"></th>

				<th scope="col"><?php echo $til?></th>
			</tr>
			    <tr class="bg-success">

			    	<td scope="col" align="justify"><h6><span>Año</span></h6><?php echo $año;?></td>

			    </tr>
			     <tr class="bg-success">

			    	<td scope="col" align="justify"><h6><span>Genero</span></h6><?php echo $gen?> </td>

			    </tr>    
			    <tr class="bg-success">
                 	<td  scope="col" align="justify"><h6><span>Autores</span></h6><?php echo $act?></td>

			    </tr> 
			    <tr class="bg-success">
			    	<td><h6><span>Descripcion</span></h6><textarea  readonly="readonly" name="txt" value=""><?php echo $des;?>">
			    		
			    	</textarea></td>

			    </tr>
			   
			    <br>
			    <?php
			}
			?>
			   
		</table>


	</form>

</body>
</html>