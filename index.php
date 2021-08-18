<?php
    include_once("html/Header.php");

    session_start();
    if(!isset($_SESSION['usuario'])){
?>
<div class="modal-dialog text-center">
    <div class="col-sm-8 main-section">
        <div class="modal-content">
            <div class="col-12 user-img">
                <img src="imagenes/user.png">
            </div>
            <form class="col-12" action="Formulario.php" method="post">
                <div class="form-group" id="user-group">
                     <input type="text" name="ficha" placeholder="Ingrese ficha"></td>
                </div>
                <div class="form-group" id="contrasena-group" >
                    <input type="password" name="contrasenia" placeholder="contrasenia">
                </div> 
                <button type="submit" class="btn btn-primary" value="Ingresar"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                <div class="col-12 forgot">
                <a href="https://www.sistemalavaderopp3.ml">¿Olvidaste la contraseña?</a>
                </div> 
            </form>
        </div>
    </div>
</div>
<?php
    }
    else{
        $usuDTOLogin = $_SESSION['usuario'];
        if($usuDTOLogin->getM_rol()->count() > 0){
            foreach ($usuDTOLogin->getM_rol() as $rol){
                if($rol->getM_id() == 2){
                    include_once ("Barra.php");
                    ?>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="imagenes/ib2-1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="imagenes/R1.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="imagenes/alvarez_2_11.jpg" alt="Third slide">
    </div>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                    <?php
                    echo "<br>Todos los paquetes hechos:";
                    $array = MovimientoDAO::getMovimientos("*");
                    foreach ($array as $movimientos){
                        echo "<br><a href='EditarPaquete.php?id=".$movimientos->getId()."'>".$movimientos."</a>";
                    }
                    ?>
                    </div>
                    <?php
                }
            }
        }
?>
<?php
    }
    include_once("html/Footer.php");
?>