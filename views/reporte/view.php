<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reporte */
?>
<div class="reporte-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'ceular',
            'dni',
            'nombres',
            'apellidos',
            'grupo',
            'fecha_nacimiento',
            'edad',
            'grupo_de_riesgo',
            'comorbilidades',
            'localidad',
            'estado',
            'vacuna',
            'primera_dosis',
            'segunda_dosis',
            'creado_el',
            'modprimeradosis',
            'modsegundadosis',
        ],
    ]) ?>

</div>
