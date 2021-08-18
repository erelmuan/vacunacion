<?php
use kartik\widgets\AlertBlock;
$this->title = 'Actualizacion reporte';
use yii\helpers\Html;

// <!-- Begin page content -->

?>
<style>
* {
  margin: 0;
  padding: 0;
}

.loader {
  display: none;
  top: 50%;
  left: 50%;
  position: absolute;
  transform: translate(-50%, -50%);
}

.loading {
  border: 2px solid #ccc;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  border-top-color: #1ecd97;
  border-left-color: #1ecd97;
  animation: spin 1s infinite ease-in;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}
</style>

<div class="content">
  <div class="container-fluid">
    <div class="container-fluid">
      <div class="card card-plain">
        <div class="card-header card-header-danger">
          <h3 class="card-title">ACTUALIZACIÓN DEL ARCHIVO REPORTE</h3>
          <p class="card-category">Handcrafted by our friends from
            <a target="_blank" href="#">Google</a>
          </p>
        </div>
<!--  -->

  <h3 >Mientras más grande sea el registro de inicio, más rápido terminara el proceso.</h3>
  <h3 > Espere el mensaje de confirmación para saber si se ha actualizado con exito.</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12">
      <!-- Contenido -->

    <div class="outer-container">
        <form action="<?=Yii::$app->homeUrl."?r=reporte/actualizacionreporte"; ?>" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Indique desde que registro actualizar</label>
                <input type="number"  class="form-control"  name="registro" id="registro" value=1>
              </br>
                <button  onclick="spinner()" type="submit" id="submit" name="actualizar" class="btn btn-danger">ACTUALIZAR REPORTE</button>

            </div>
        </form>
        <form action="<?=Yii::$app->homeUrl."?r=reporte/insertar"; ?>" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <button onclick="spinner()" type="submit" id="submit" name="actualizar" class="btn btn-success">INSERTAR REGISTROS NUEVOS</button>
            </div>
        </form>

    </div>


      <!-- Fin Contenido -->
    </div>
  </div>

<!--  -->
      </div>
    </div>
  </div>
</div>

<div class="loader">
  <div class="loading">
  </div>
</div>
<script type="text/javascript">
    function spinner() {
        document.getElementsByClassName("loader")[0].style.display = "block";
    }
</script>
<div class="container">
  <h2>AUDITORIA</h2>
  <div class="panel panel-default">
    <div class="panel-body">USUARIO: <?=($auditoria)?$auditoria->usuario:'SIN REGISTRO' ?></div>
    <div class="panel-body">FECHA Y HORA: <?=($auditoria)?$auditoria->fecha.' '.$auditoria->hora:'SIN REGISTRO' ?></div>
    <div class="panel-body">ESTADO: <?=($auditoria)?$auditoria->estado:'SIN REGISTRO' ?></div>
    <div class="panel-body">ACCIÓN: <?=($auditoria)?$auditoria->accion:'SIN REGISTRO' ?></div>


  </div>
</div>
