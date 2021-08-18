<?php
//include('dbconect.php');
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\widgets\AlertBlock;

$this->title = 'Importacion sisa';

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
        <div class="card-header card-header-warning">
          <h3 class="card-title">IMPORTACION ARCHIVO SISA</h3>
          <p class="card-category">Handcrafted by our friends from
            <a target="_blank" href="#">Google</a>
          </p>
        </div>
<!--  -->

  <h3 class="mt-5">Seleccione el archivo sisa.xlsx, importe los registros y espere el mensaje de confirmación</h3>
  <hr>
  <div class="row">
    <div class="col-12 col-md-12">
      <!-- Contenido -->

    <div class="outer-container">
        <form action="<?=Yii::$app->homeUrl."?r=sisa/importacionsisa"; ?>" method="post"
            name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
            <div>
                <label>Elija Archivo Excel</label>
                <input type="file"class="form-control"  name="file" id="file" accept=".xls,.xlsx">

                <button onclick="spinner()"  type="submit" id="submit" name="import" class="btn btn-warning">Importar Registros</button>

            </div>

        </form>
        <div class="reporte-view">

          <?php echo Html::a('VACIAR', ['eliminar'], [
              'class' => 'btn btn-danger',
              'data' => [
                  'confirm' => 'SE VACIARA TODO EL REGISTRO SISA',
                  'method' => 'post',
              ],
          ]) ?>

        </div>

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
