<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Auditoria */
?>
<div class="auditoria-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'tabla',
            'pantalla',
            'usuario',
            'fecha',
            'hora',
            'accion',
            'estado',
        ],
    ]) ?>

</div>
