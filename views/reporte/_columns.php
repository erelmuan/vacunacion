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
        'attribute'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ceular',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dni',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombres',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'apellidos',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'grupo',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'fecha_nacimiento',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'edad',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'grupo_de_riesgo',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'comorbilidades',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'localidad',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'estado',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'vacuna',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'primera_dosis',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'segunda_dosis',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'creado_el',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'modprimeradosis',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'modsegundadosis',
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
