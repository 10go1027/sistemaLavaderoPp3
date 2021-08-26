<?php
    include_once("html/Header.php");
    
    session_start();
    if(isset($_SESSION['usuario'])){
        $usuDTOLogin = $_SESSION['usuario'];
        foreach ($usuDTOLogin->getM_rol() as $rol){
            if($rol->getM_id() == 2){
                include_once("Barra.php");
?>
    <thead>
<div class="modal-body">
    <tr scope="col">
    <div class="col-sm-8 main-sections rounder">
        <div class="modal-contents">
<h3 class="fw-bold text-align py-1">Crear nuevo tipo de prenda:</h3>
<form action="CrearPrenda.php" method="POST" enctype="multipart/form-data">
    <div class="col-sm-12 " >
    
          <label for="text" class="form-label">Nombre de la prenda:</label>
    
         <input  class="form-control" name="nombre"></input>
    </div>
    
    <div class="col-sm-12 ">
    
          <label for="text" class="form-label">Imagen:</label>
    
    <input type="file"  class="form-control" name="imagen">
    
    </div>
    <div class="col-sm-8 ">
    
          <label for="text" class="form-label">Codigo:</label>
    
    <input type="number" class="form-control" name="codigo" min="1">
    
    </div>
    <br>
    <div class="input-group">
        <input type="submit" class="btn btn-primary btn-sm" name="submit" value="Agregar">
    </div>
</form>
        </div>
    </div>
    </tr>
</div>
    </thead>
</table>

<a href="index.php">Atrás</a>
<h3>Eliminar prendas:</h3>
<form  id='eliminarPrendas'action="CrearPrenda.php" method="GET">
<table>
<?php
                $tipoprendas = PrendaDAO::getHTMLAllPrendas();
                foreach ($tipoprendas as $prenda){
                    $preda_aux = PrendaDAO::getPrenda($prenda[0]);
                    echo "<tr><td><img src='".$preda_aux->getM_icono()."' style='width: 25px'>".$preda_aux->getM_descripcion()."</td><td><button id='borrar' class='btn btn-warning btn-sm btn-block' name='prenda' type='submit' value='".$preda_aux->getM_descripcion()."'>Eliminar</button></td></tr>";
                }
?>
</table>
</form>
<?php
                if(isset($_GET['prenda'])){
                    PrendaDAO::bajaPrenda($_GET['prenda']);
                    echo "<meta http-equiv=\"refresh\" content=\"0;url=https://www.sistemalavaderopp3.ml/CrearPrenda.php\"/>";
                }
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
