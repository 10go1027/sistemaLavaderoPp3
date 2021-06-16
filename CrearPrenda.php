<?php
    include_once("html/Header.php");
    
    session_start();
    if(isset($_SESSION['usuario'])){
        $usuDTOLogin = $_SESSION['usuario'];
        foreach ($usuDTOLogin->getM_rol() as $rol){
            if($rol->getM_id() == 2){
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light ">
  <a class="navbar-brand" href="#">
  <?php
  echo "Bienvenido! ".$usuDTOLogin->getM_nombre()." Al sistema";
  ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Inicio</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="CargarRopaSucia.php">Cargar ropa sucia</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="AdministrarDeposito.php">Administrar deposito</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="CrearPrenda.php">Crear nuevo tipo prenda</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="cerrar.php">Cerrar sesion</a>
      </li>
    </ul>
  </div>
</nav>

<div class="container">
 <div class="form-group ">
  <label for="Salas" class="control-label col-md-7"><h3>Crear nuevo tipo de prenda:</h3></label>
 </div>
</div>
<div class="container">
    <form class="form-horizontal" action="CrearPrenda.php" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="Salas" class="control-label col-md-3">Nombre de la prenda:</label>
            <div class="col-md-5">
                <input name="nombre"></input>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-2" for="Salas">Imagen:</label>
            <div class="col-md-2">
                <input  class="btn btn-success btn-lg" type="file" name="imagen">
            </div>
        </div>
        <div class="form-group ">
            <label for="Salas" class="control-label col-md-2">Codigo:</label>
            <div class="col-md-2 col.md.offset-2">
                <input type="number" name="codigo" min="1">
            </div>
        </div>
            <div class="col-md-2 col.md.offset-2">
                <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Agregar">
            </div>
        </div>
        
    </form>
</div>
    <div class="container">
     <div class="form-group">
      <div class="col-md-2 col.md.offset-2">
       <a href="index.php">Atrás</a>
    </div>
   </div>
  </div>

<?php
                if(isset($_POST['submit']) && isset($_POST['codigo']))
                {
                    if(isset($_POST['nombre']) && strlen($_POST['nombre']) > 2){
                        //var_dump($_FILES['imagen']);
                        if(PrendaDAO::getPrenda($_POST['nombre']) == null){
                            $carpeta = "imagenes/". basename($_FILES['imagen']['tmp_name']);
                            if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta)){
                                rename($carpeta, "imagenes/".$_FILES['imagen']['name']);
                                $carpeta = "imagenes/".$_FILES['imagen']['name'];

                                $archivo = pathinfo($carpeta);
                                $extension = $archivo['extension'];

                                rename($carpeta, "imagenes/".$_POST['nombre'].".".$extension);
                                if(!strcmp($extension, "jpg")){
                                    $archivo = fopen("Objetos/Prendas/DTO/".$_POST['nombre'].".php", "wr");

                                    $txt = "<?php\nclass ".$_POST['nombre']." extends Prenda{\nstatic private \$icon_prenda = 'imagenes/".$_POST['nombre'].".".$extension."';\npublic function __construct() {\n\$this->setM_icono(self::\$icon_prenda);\n}\npublic function __toString() {\nreturn parent::__toString();\n}\n}";

                                    fwrite($archivo, $txt);
                                    fclose($archivo);

                                    $prenda = new Prenda();
                                    $prenda->setM_codigo($_POST['codigo']);
                                    $prenda->setM_descripcion($_POST['nombre']);

                                    if(!PrendaDAO::addPrenda($prenda)){
                                        echo "<a style='color: red;'>Error! Codigo ya existente.</a>";
                                        unlink("imagenes/".$_POST['nombre'].".".$extension);
                                        unlink("Objetos/Prendas/DTO/".$_POST['nombre'].".php");
                                    }
                                    else{
                                        echo "Exito! la prenda ha sido creada";
                                    }
                                }
                                else{
                                    echo "<a style='color: red;'>Error! imagen no compatible.</a>";
                                    unlink("imagenes/".$_POST['nombre'].".".$extension);
                                }
                            }
                        }
                        else{
                            echo "<a style='color: red;'>Error! nombre de la prenda ya ha sido creada.</a>"; 
                        }
                    }
                    else{
                        echo "<a style='color: red;'>Error! nombre vacio.</a>";  
                    }
                }
            }
        }
    }
    include_once("html/Footer.php");
?>
