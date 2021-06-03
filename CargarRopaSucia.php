<?php
    include_once("html/Header.php");
    
    session_start();
    if(isset($_SESSION['usuario'])){
         $usuDTOLogin = $_SESSION['usuario'];
         foreach ($usuDTOLogin->getM_rol() as $rol){
                if($rol->getM_id() == 2){
                    if(!isset($_SESSION['id_mov'])){
                        $_SESSION['id_mov'] = hash("md5", (rand(-9999999999999999, 9999999999999999)));
                    }
?>
<div class="container">
    <div class="form-group">
        <label for="tituloCargaRopaSucia" class="control-label col-md-10"><h3>Sistema de carga de ropa sucia:</h3></label>
     </div>
</div>
<div class="container">
    <form class="form-horizontal" action="CargarRopaSucia.php" method="get">
        
            <div class="form-group ">
                <label for="Salas" class="control-label col-md-2">Salas</label>
                <div class="col-md-5">
                    <select id="sala" class="form-control" name="sala">

<?php
    $salaI = SalasDAO::getAllSalas();
         foreach ($salaI as $aux){
         echo "<option value='".$aux->getM_id()."' ".(isset($_GET['sala']) && $_GET['sala'] == $aux->getM_id()?"selected":"").">".$aux->getM_Descripcion()."</option>";
        }
?>
                </select>
            </div>
        </div>
    <div class="form-group">
    <label for="Tipo de prenda" class="control-label col-md-3">Tipo de prenda</label>
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
    <div class="form-group">
    <label for="Cantidad" class="control-label col-md-2">Cantidad</label>
    <div class="col-md-2">
    <input id="cantidad" class="form-control" type="number" min="0"  name="cantidad">
    </div>
    </div>

    <div class="col-md-2 col.md.offset-2">
    <input id="agregar" class="btn btn-primary btn-lg" type="submit" value="Agregar">
    </div>
    </form>
    <div class="form-group">
    <div class="col-md-2 col.md.offset-2">
    <a href="index.php">Atrás</a>
    </div>
    </div>
    </div>
    <?php
                if(isset($_GET['prenda'])){
                    $prenda = preg_split('/[\d]{1,}p/', $_GET['prenda']);
                    $sala = preg_split('/p[\d]{1,}/', $_GET['prenda']);
                    
                    $sala = $sala[0];
                    $prenda = $prenda[1];
                    
                    SalasDAO::removeSalaPrenda($sala, $prenda, $_SESSION['id_mov']);
                }
                if(isset($_GET['tipoprenda']) && isset($_GET['cantidad']) && isset($_GET['sala'])){
                    $prenda = PrendaDAO::getPrendaFromString($_GET['tipoprenda']);
                    $prenda->setM_cantidad($_GET['cantidad']);
                    
                    $sala = SalasDAO::getSala($_GET['sala'], $_SESSION['id_mov']);
                    
                    SalasDAO::addSala($sala, $prenda, $_SESSION['id_mov']);
                }
                    
                foreach($salaI as $aux){
    ?>
    <div class="container">
    <form id="cargarRopaSucia" action="CargarRopaSucia.php" method="get">
    <?php
                    echo "<table class='table table-striped table-bordered table-hover' border='1px'><tr><th colspan='3'>".$aux->getM_descripcion()."</th></tr>";
                    $aux = SalasDAO::getSala($aux->getM_id(), $_SESSION['id_mov']);
                    if($aux->getM_prendas() != null){
                        foreach ($aux->getM_prendas() as $prenda){
                            echo "<tr><td><img src='".$prenda->getM_icono()."' style='width: 75px'>".$prenda->getM_descripcion()."</td><td>".$prenda->getM_cantidad()."</td><td><button id='borrar' class='btn btn-warning btn-sm btn-block' name='prenda' type='submit' value='".$aux->getM_id()."p".$prenda->getM_codigo()."'>Borrar</button></tr>";
                        }
                    }
                    echo "</table>";
    ?>
    </form>
</div>
    </div>
    <?php
                }
    ?>
    <div class="container">
        <div class="table table-striped table-hover " id="tablaTotal">
            <table  border='1px'>
                <tr class="info"><th colspan="2">Total</th></tr>
    <?php
                $total = 0;
                $allprendasstr = PrendaDAO::getHTMLAllPrendas();
                foreach($allprendasstr as $prendastr){
                    $objprenda = PrendaDAO::getPrendaFromString($prendastr[0]);
                    $objprenda->setM_cantidad(PrendaDAO::getCountPrenda($objprenda->getM_codigo(), $_SESSION['id_mov']));
                    echo "<tr><td><img src='".$objprenda->getM_icono()."' style='width: 25px'>".$objprenda->getM_descripcion()."</td><td>".$objprenda->getM_cantidad()."</td></tr>";
                    
                    $total += $objprenda->getM_cantidad();
                }
                $_SESSION['total'] = $total;
               //echo "<tr><td style='background-color: red'>Total de prendas</td><td style='background-color: red'>".$total."</td></tr>";
    ?>
            </table>
    </div>
    <div class="container">
        <form action="ProcesarRopaSucia.php" method="POST">
            <input id="procesar" class="btn btn-success btn-lg" type="submit" value="Procesar">
        </form>
    </div>
</div>


    <?php
            }
        }
     }
        include_once("html/Footer.php");
    ?>
