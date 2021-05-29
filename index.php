<?php
    include_once("html/Header.php");
    
    session_start();
    if(!isset($_SESSION['usuario'])){
?>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

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
        echo "Bienvenido! ".$usuDTOLogin->getM_nombre()." Al sistema.";
?>
<table id="inicio"><tr>
<?php
        if($usuDTOLogin->getM_rol()->count() > 0){
            foreach ($usuDTOLogin->getM_rol() as $rol){
                if($rol->getM_id() == 2){
?>
<td><a href="CargarRopaSucia.php">Cargar ropa sucia</a></td>
<td><a href="AdministrarDeposito.php">Administrar deposito</a></td>
<td><a href="CrearPrenda.php">Crear nuevo tipo prenda</a></td>
<?php
                    echo "<br>Todos los paquetes hechos:";
                    $array = MovimientoDAO::getMovimientos("*");
                    foreach ($array as $movimientos){
                        echo "<br><a href='EditarPaquete.php?id=".$movimientos->getId()."'>".$movimientos."</a>";
                    }
                }
            }
        }
?>
</tr><td><a href="cerrar.php">Cerrar sesion</a></td>
</table>
<?php
    }
    include_once("html/Footer.php");
?>