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
 <div class="form-group">
  <label for="Salas" class="control-label col-md-7"><h3>Sistema de Administracion del deposito:</h3></label>
 </div>
</div>
<div class="container">
 <form class="form-horizontal" action="AdministrarDeposito.php" method="GET">
    <div class="form-group ">
        <label for="Salas" class="control-label col-md-2">Tipo de prenda</label>
        <div class="col-md-5">
            <select id="tipoprenda" class="form-control" name="tipoprenda">
    
                <?php
                $tipoprendas = PrendaDAO::getHTMLAllPrendas();
                foreach ($tipoprendas as $prenda){
                    echo "<option value='$prenda[0]'>".$prenda[0]."</option>";
                }
                ?>
            </select>
        </div>
     </div>
        <div class="form-group ">
            <label for="Salas" class="control-label col-md-2">Cantidad</label>
            <div class="col-md-2">
                <input id="cantidad" class="form-control" type="number" min="0" name="cantidad" value="0">
            </div>
        </div>
            <div class="col-md-2 col.md.offset-2">
                <input id="agregar" class="btn btn-primary btn-lg" type="submit" value="Agregar">
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
                if(isset($_GET['tipoprenda']) && isset($_GET['cantidad'])){
                    $prenda = PrendaDAO::getPrenda($_GET['tipoprenda']);
                    $prenda->setM_cantidad($_GET['cantidad']);
                    
                    PrendaDAO::addPrendaDeposito($prenda);
                }
?>
<table border='1px'>
<?php
                $auxMapa = PrendaDAO::getPrendaDeposito();
                foreach($auxMapa->keys() as $auxp){
                    echo "<tr><td><img src='".$auxp->getM_icono()."' style='width: 25px'>".$auxp->getM_descripcion()."</td><td>".$auxp->getM_cantidad()."</td></tr>";
                }
?>
</table>
<?php
            }
        }
    }
    include_once("html/Footer.php");
?>