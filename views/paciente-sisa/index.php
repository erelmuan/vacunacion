<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Modal;
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset;
use johnitvn\ajaxcrud\BulkButtonWidget;
use yii\widgets\ActiveForm;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PacienteSisaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Registro pacientes sisa';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

?>
<?php
  $export= ExportMenu::widget([
  'exportConfig' => [
    ExportMenu::FORMAT_TEXT => false,
    ExportMenu::FORMAT_HTML => false,
],
         'dataProvider' => $dataProvider,
         'columns' => require(__DIR__.'/_columns.php'),
         'dropdownOptions' => [
           'label' => 'Todo',
           'class' => 'btn btn-secondary',
           'itemsBefore' => [
             '<div class="dropdown-header">Exportar Todos los Datos</div>',
],
     ]]);

?>

<div  class="x_panel">
  <div class="x_title"><h2><i class="fa fa-table"></i> SISA  </h2>

  </div>
  <?=$export; ?>
<div class="paciente-sisa-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                  Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''],
                    ['data-pjax'=>1, 'class'=>'btn btn-default', 'title'=>'Refrescar'])
                ],
            ],
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            'panel' => [
                'type' => 'primary',
                'heading' => '<i class="glyphicon glyphicon-list"></i> Registro pacientes Sisa',
                'before'=>'*BUSQUE EN LAS COLUMNAS PRIMERA Y SEGUNDA DOSIS, CON <b>DEF</b> SI SE REQUIERE ENCONTRAR LOS REGISTROS Y <b>NODEF</b> EN CASO CONTRARIO.'.'</br>
                          <em>ESQUEMAS: Personal de Salud  --- Personal Estratégico --- 18 a 39 años SIN Factores de Riesgo --- 18 a 59 años CON Factores de Riesgo --- 40 a 49 años SIN Factores de Riesgo --- 50 a 59 años SIN Factores de Riesgo</em>'.'</br>
                --- 60 o más años',

                        '<div class="clearfix"></div>',
            ]
        ])?>
    </div>
</div>
</div>
<?php Modal::begin([
    "id"=>"ajaxCrudModal",
    "footer"=>"",// always need it for jquery plugin
])?>
<?php Modal::end(); ?>
