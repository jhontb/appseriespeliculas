
<?php
 include'./conexion.php';
 require_once"../vistas/dependencias.php";
$buscar='';
  if(isset($_POST['buscar'])){
    $buscar = $_POST['buscar'];
  }
  $sql="SELECT * FROM peliculas WHERE 
       titulo LIKE '%".$buscar."%' ";         
  $resultado = $con->query($sql);
  $fila = $resultado->fetch(PDO::FETCH_ASSOC);
  $total = count($fila);
?>
<?php 
  if($total>0 && $buscar != ''){ ?>
  <div class="resultado">
<?php do{ ?>
<div class="resultado-q">
<?php   
        echo"<table class='table'>";
        echo"<tr>";
    echo"<td><h3>".$fila['titulo']."</h3></td>";
    echo "</tr>";
    echo"<th><h5>GENERO:</h5> <h5> ".$fila['genero']."</h5></th></br>";
      echo"<th><h5>AÑO:</h5>".$fila['year']."</th></br>";
      echo"<th><h5>DESCRIPCION</h5> <h6>".$fila['descripcion']."</h6></th>";
      
?>
  </div>
<?php 
  }while($fila=$resultado->fetch(PDO::FETCH_ASSOC));
?>

<?php
  }
  elseif($total>0 && $buscar=='') echo "<div class='resultado'><h6>Realiza una Busqueda</h6></div>";
  else echo "<div class='resultado'><h6>No se encontraron resultados</h6></div>";
  
?>