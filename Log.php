<?php
include_once("html/Header.php");

session_start();
if (isset($_SESSION['usuario'])) {
    $usuDTOLogin = $_SESSION['usuario'];
    foreach ($usuDTOLogin->getM_rol() as $rol) {
        if ($rol->getM_id() == 1) {
            include_once("Barra.php");
            echo"<div class='modal-body'>
            <div class='col-sm-12 main-sections'>
                <div class='modal-contents'> <label class='text-center'> <h5><p>Tabla de movimientos</p></h4></lavel>";

            echo "<table class='table table-bordered table-striped table-sm table-secondary' border='1 px'>";
            $array = LogDAO::getLogs();
            $usuarios = UsuarioDAO::listUsuarios();
            $x = 1;
            $aux = null;
            foreach ($array as $log){
                foreach($usuarios as $usu){
                    if($usu->getM_idusuario() == $log->getM_usuario()){
                        $aux = $usu;
                    }
                }
                echo "<tr><th><h5>Fila</h5></th><th><h5>Fecha</h5> </th><th><h5>usuario</h5></th><th><h5>#Paquete</h5></th><th><h5>movimiento</h5></th><tr><td>".$x++."</td><td>".$log->getFecha()."</td><td>".$aux->getM_nombre()."</td><td>".$log->getM_idmovimiento()."</td><td>".$log->getM_accion()."</td></tr>";
            }
            echo "</table></div></div></div>";
        }
    }
}
include_once("html/Footer.php");
?>