<?php
    include_once("html/Header.php");

    session_start();
    if(!isset($_SESSION['usuario'])){
?>
<div class="container w-75 bg-Info mt-5 rounded shadow">
  <div class="row align-items-stretch"> 
      <div class="col bg d-none d-lg-block col-md-5 col-lg-5 col-xl-6 rounded">
      </div>

    <div class="col bg-white p-5 rounded-end">
      <div class="text-end">
        <img src="imagenes/logoLavaderoI_v3.png"  width="48" alt="">
      </div>
    <h2 class="fw-bold text-center py-5">Bienvenido</h2>

    <form action="Formulario.php" method="post">
        <div class="mb-4">
          <label for="text" class="form-label">Ingrese Ficha</label>
          <input type="text" class="form-control" name="ficha">
        </div>
        <div class="mb-4">
          <label for="password" class="form-label">Contraseña</label>
          <input type="password" class="form-control" name="contrasenia">
        </div>
        <div class="d-grid">
          <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
        </div>
        <div class="my-3">
          <span><a href="contrasenia.php">Recuperar Contraseña</a></span>
        </div>
    </form>
    </div>
 </div>
</div>

<!--<div class="modal-dialog text-center">
  
    <div class="col-sm-8 main-section">
    
        <div class="modal-content">
            <div class="col-12 user-img">
            <img src="imagenes/S.G.S.R.H.G.gif">
            </div>
            <form class="col-12" action="Formulario.php" method="post">
              <div class="input-group mb-2">
                <input type="text" name="ficha" class="form-control" placeholder="Ingrese ficha" aria-label="Ingrese ficha">
              </div>
                <div class="input-group mb-2">
                <input type="password" name="contrasenia" class="form-control" placeholder="Contraseña" aria-label="Server">
              </div>
               
                <button type="submit" class="btn btn-primary" value="Ingresar"><i class="fas fa-sign-in-alt"></i> Ingresar</button>
                <div class="col-12 forgot">
                <a href="https://www.sistemalavaderopp3.ml">¿Olvidaste la contraseña?</a>
                </div> 
            </form>
        </div>
    </div>
</div>
    -->
    
<?php
    }
    else{
        $usuDTOLogin = $_SESSION['usuario'];
        if($usuDTOLogin->getM_rol()->count() > 0){
            foreach ($usuDTOLogin->getM_rol() as $rol){
                if($rol->getM_id() == 2){
                    include_once ("Barra.php");
                    ?>
                    <br>
                    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="imagenes/ib2-1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="imagenes/hospitalAlvarezFachada.jpg" alt="Second slide">
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