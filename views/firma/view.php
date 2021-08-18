<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Firma */
?>
<div class="firma-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'path',
            'medico',
        ],
    ]) ?>

</div>
