<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
?>
<div class="usuario-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'idusuario',
            'usuario',
            'contrasenia',
            'nombre',
            'email:email',
            [
                'class'=>'\kartik\grid\DataColumn',
                'attribute'=>'activo',
                'format'=>'boolean',

            ],
            'observacion:ntext',
            [
              'attribute'=>'imagen',
                'label'=>'Imagen',
                'value'=> '<img src=uploads/avatar/'.Yii::$app->user->identity->imagen.' width="75px" height="75px" style="margin-left: auto;margin-right: auto;;position:relative;" >',

                'format'=>'raw',

         ],

        ],
    ]) ?>

</div>
