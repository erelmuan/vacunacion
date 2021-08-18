<?php
use yii\helpers\Url;

return [
    // [
    //     'class' => 'kartik\grid\CheckboxColumn',
    //     'width' => '20px',
    // ],
    // [
    //     'class' => 'kartik\grid\SerialColumn',
    //     'width' => '30px',
    // ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'id',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'apellido',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dni',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'edad_actual',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'tipo_de_edad_actual',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'localidad_establecimiento',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'vacuna',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'esquema',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Dosis1',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'Dosis2',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template' => '{view}',

        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'Ver','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Actualizar', 'data-toggle'=>'tooltip' ],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Eliminar',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
    ],

];
