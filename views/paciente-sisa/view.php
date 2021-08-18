<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\PacienteSisa */
?>
<div class="paciente-sisa-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nombre',
            'apellido',
            'dni',
            'edad_actual',
            'tipo_de_edad_actual',
            'localidad_establecimiento',
            'vacuna',
            'esquema',
            'Dosis1',
            'Dosis2',
        ],
    ]) ?>

</div>
