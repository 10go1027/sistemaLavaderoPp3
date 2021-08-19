<?php
    include_once("html/Header.php");
    
    session_start();
    if(isset($_SESSION['usuario'])){
         $usuDTOLogin = $_SESSION['usuario'];
         foreach ($usuDTOLogin->getM_rol() as $rol){
                if($rol->getM_id() == 2){
                    include_once ("Barra.php");
                    if(!isset($_SESSION['id_mov'])){
                        $_SESSION['id_mov'] = hash("md5", (rand(-9999999999999999, 9999999999999999)));
                    }
?>
<table class="table table-sm table-primary">
    <thead>
<div class="modal-body">
    <tr scope="col">
    <div class="col-sm-12 main-sections">
        <div class="modal-contents">
            <h5>Cargar ropa sucia:</h5></tr>
            </thead>
            <tbody>
                <tr>
            <form class="form-horizontal" action="CargarRopaSucia.php" method="get">
               <th scope="row">
                <div class="form-group ">
                    <label for="Salas" class="control-label col-sm-12">Salas</label></th>
                    <td>
                    <div class="col-sm-8">
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
                </td>
                </tr>
                <tr>
                <th scope="row">
                <div class="form-group">
                    <label for="Tipo de prenda" class="control-label col-sm-6">Tipo de prenda</label></th>
                    <td>
                    <div class="col-sm-5">
                        <select id="tipoprenda" class="form-control" name="tipoprenda">
                            <?php
                                 $tipoprendas = PrendaDAO::getHTMLAllPrendas();
                                foreach ($tipoprendas as $prenda){
                                echo "<option value='$prenda[0]'>".$prenda[0]."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    </td>
                 </div>
                 </tr>
                 <tr>
                     <th scope="row">
                <div class="form-group">
                    <label for="Cantidad" class="control-label col-sm-2">Cantidad</label></th>
                    <td>
                    <div class="col-sm-2">
                        <input id="cantidad" class="form-control" type="number" min="0" value="0" name="cantidad">
                    </div>
                    </td>
                </div>
                </tr>
                <tr>
                    <th scope="row">
                <div class="col-sm-2 col.sm.offset-2">
                    <input id="agregar" class="btn btn-primary btn-lg" type="submit" value="Agregar">
                </div>
                <td></td></td>
                </th>
                </tr>
            </form>
        </div>
    </div>
</div>
</tbody>
</table>
    <div class="form-group">
        <div class="col-md-2 col.md.offset-2">
            <a href="index.php"><h5>Atrás</h5></a>
        </div>
    </div>
    <p>
    <div class="col-sm-6 col.sm.offset-6">
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample1" aria-expanded="false" aria-controls="multiCollapseExample1 multiCollapseExample2">Mostrar unidades Cargadas</button>
    </div>
     <div class="col-sm-6 col.sm.offset-6">
     <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#multiCollapseExample2" aria-expanded="false" aria-controls="multiCollapseExample2">Mostrar prendas totales</button>
    </div>
  
</p>
<div class="row">
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample1">
      <div class="card card-body">
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
                    
                    //verifico que lo que lo que se quiera agregar no sobrepase lo que hay en el deposito
                    if(PrendaDAO::isOutboundPrendaDeposito($prenda, $_SESSION['id_mov'])){
                        echo "<a style='color: red;'>Error! cantidad de prendas a agregar invalida</a>";  
                    }
                    else{
                        SalasDAO::addSala($sala, $prenda, $_SESSION['id_mov']);
                    }
                }
                    
                foreach($salaI as $aux){
            ?>
        <form id="cargarRopaSucia" action="CargarRopaSucia.php" method="get">
            <?php
                echo "<table class='table table-sm table-striped table-bordered table-hover table-primary' border='1px'><thead class='thead-light'><tr><th colspan='4'>".$aux->getM_descripcion()."</th></tr>";
                $aux = SalasDAO::getSala($aux->getM_id(), $_SESSION['id_mov']);
                if($aux->getM_prendas() != null){
                    foreach ($aux->getM_prendas() as $prenda){
                        echo "<tr><td><img src='".$prenda->getM_icono()."' style='width: 80px'></td><td ><h3>".$prenda->getM_descripcion()."</h3></td><td><h3>".$prenda->getM_cantidad()."</h3></td><td><button id='borrar' class='btn btn-warning btn-sm btn-block' name='prenda' type='submit' value='".$aux->getM_id()."p".$prenda->getM_codigo()."'>Borrar</button></tr>";
                    }
                }
                echo "</table>";
            ?>
        </form>
    <?php
                }
    ?>  
      </div>
    </div>
  </div>
  <div class="col">
    <div class="collapse multi-collapse" id="multiCollapseExample2">
      <div class="card card-body">
      <?php
            echo "<table id='tablaTotal' class='table table-sm table-striped table-bordered table-hover table-primary' border='1px'><thead class='thead-light'><tr class='info'><th colspan='3'>Total</th></tr>";
            $total = 0;
            $allprendasstr = PrendaDAO::getHTMLAllPrendas();
            foreach($allprendasstr as $prendastr){
            $objprenda = PrendaDAO::getPrendaFromString($prendastr[0]);
            $objprenda->setM_cantidad(PrendaDAO::getCountPrenda($objprenda->getM_codigo(), $_SESSION['id_mov']));
            echo "<tr><td><img src='".$objprenda->getM_icono()."' style='width: 80px'></td><td><h3>".$objprenda->getM_descripcion()."</h3></td><td><h3>".$objprenda->getM_cantidad()."</h3></td></tr>";
                    
            $total += $objprenda->getM_cantidad();
            }
            $_SESSION['total'] = $total;
             echo "</table>";
        ?>
        <form action="ProcesarRopaSucia.php" method="POST">
            <input id="procesar" class="btn btn-success btn-lg" type="submit" value="Procesar">
        </form>
      </div>
    </div>
  </div>
</div>
              
        
    <?php
            }
        }
     }
        include_once("html/Footer.php");
    ?>
