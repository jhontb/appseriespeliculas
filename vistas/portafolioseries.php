
<?php
  require_once"dependencias.php";
  include'../clases/conexion.php';
  
  //llamar articulos
  $tres=6;
  $sql="SELECT * FROM series";
  $sentencia=$con->prepare($sql);
  $sentencia->execute();

  $resultado=$sentencia->fetchAll();



  
  //numero de articulos que lleva una pagina 
  $articulos_x_pagina=6;
  //contar los articulos 
  $total_articulos_bd=$sentencia->rowCount();

  $paginas=$total_articulos_bd/$tres;
  $paginas=ceil($paginas);

 ?>

<!DOCTYPE html>
<?php 
     if (!$_GET) {
          header('location:portafolioseries.php?pagina=1');
        }
     if ($_GET['pagina']>$paginas || $_GET['pagina']<=0) {
               header('location:portafolioseries.php?pagina=1');  
          }
       $iniciar=($_GET['pagina']-1)*$articulos_x_pagina;

       //organiza los articulos en las diferentes paginas 
       $sql_articulos='SELECT * FROM series LIMIT :iniciar,:articulos';
       $sentencia_articulos=$con->prepare($sql_articulos);
       //el bondParam cambia valores de enteros a string
       //sentencia preparadas  
       $sentencia_articulos->bindParam(':iniciar',$iniciar, PDO::PARAM_INT);
       $sentencia_articulos->bindParam(':articulos',$articulos_x_pagina, PDO::PARAM_INT);
       $sentencia_articulos->execute();

       $resultado_articulos=$sentencia_articulos;

       ?>
<html>
<head>
  
	 <meta charset="utf-8">
   <!--libreria iconos-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../css/estilosb.css">  
	 <title>series</title>
    </head>
      <body>
        </br>
          <a class="pass" href="inicio.php" style="padding:20px; top:200px;color:#B26419 ;"><i class="fas fa-home"></i>home</a>
           <header class="form-contro">
          <form action="" autocomplete="off" id="form-search">
           <h3 class="buscar">BUSCAR</h3>
             <input align="center" id="buscar" method="post" name="buscar" type="text" placeholder="Ingresa una busqueda">
      </form>
    <div id="resultado-q">   
  </div></br>
  <script type="text/javascript" src="../js/funcion.js"></script>
    </header>
         <div class="container">
      <h1 align="center"><span class="buscar1">portafolio series</span></h1></br>
     <div class="responsive">
   <table class="table" align="center" id="resultado">

      <?php
      //reparte la informacion de la base y la ubica 
      $num=0;
      foreach ( $resultado_articulos as $articulo) {

            if($num==3){

            	echo "<tr>";
            	  $num=1;    
            }else{
            $num++;
      }
      ?>
            <!--visualizacion de la informacion en el protafolio-->
              <th style="border-color: red;background-color: #E0E2DE ;"><span><?php echo $articulo['titulo']?></span>
                 <h5>GENERO:</h5><span class="spn"><?php echo $articulo['generos']?></span>
                    <h5>AÑO:</h5><span class="spn"><?php echo $articulo['year']?></span>
             
              </th>
       	  	          <th style="border-color: red;background-color:#17D1EC"><img src="../imgs/<?php echo $articulo['imagen']?>" class="img-rounder" id="img"  width="190" height="200"><br>
                        <button type="button" class="btn btn-success" data-toggle="modal" 
                           data-target="#exampleModal"
                            onclick="enviar(<?php echo $articulo['idserie']?>)"><i class="fas fa-sign-in-alt"></i> Mas</button>
              </th>
       	  	
          <?php
      }
      	?>
      
      
      </table>
    </div>
  </div>
<!--navegador de los paginados-->
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <!--codigo que no permite que avancen mas de las paginas correspondientes 
-->
     <li class="page-item<?php echo $_GET['pagina']<=1 ? 'disabled' : '' ?>">
      <!-- pasa de paginas-->
        <a class="page-link" href="portafolioseries.php?pagina=<?php echo $_GET['pagina']-1?>">
                 <span aria-hidden="true">
                Anterior
               </span>
              </a>
             </li>
     
           <?php for ($i=0;$i<$paginas;$i++): ?>      
          <li class="page-item <?php echo $_GET['pagina']==$i+1 ? 'active' : '' ?>">
    	   <a class="page-link" 
   	   href="portafolioseries.php?pagina=<?php echo $i+1;?>"><?php echo $i+1;?></a>
   </li>
 <?php endfor ?>
   <li class="page-item
     <?php echo $_GET['pagina']>=$paginas ? 'disabled' : ''?>">
       <a class="page-link" href="portafolioseries.php?pagina=<?php echo $_GET['pagina']+1?>">
        <span aria-hidden="true">Siguiente</span>
      </a>
    </li>
  </ul>
</nav>
 <!-- Modal -->
   <div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
       <h1 align="center" class="p-3 mb-2 bg-danger text-blue"  id="exampleModalLabel">Detalle del producto</h1>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
          </button>
         </div>
        <div class="modal-body" id="mostrar">
        ...
      </div>
     <div class="modal-footer">
   
   </div>
  </div>
 </div>
</div>
<script>
      //script del modal
      var resultado=document.getElementById("mostrar");
      function enviar(c){

      var xmlhttp;
      if(window.XMLHttpRequest){
              xmlhttp=new XMLHttpRequest(); 
      }else{
              xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange=function(){

        if(xmlhttp.readyState==4 && xmlhttp.status==200){
          resultado.innerHTML=xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET","detalleseries.php?cod="+c,true);
      xmlhttp.send();
   }
 </script>

   
</body>
</html>
