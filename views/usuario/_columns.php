<?php
use yii\helpers\Url;
use kartik\grid\GridView;

return [
      [
        'class' => '\kartik\grid\ExpandRowColumn',
        'value' => function ($model, $key, $index, $column) {
            return GridView::ROW_COLLAPSED;
        },
        'detailUrl' => Url::to(['listdetalle']),   //  action mostrarDetalle con POST expandRowKey como ID
        'detailRowCssClass' => 'expanded-row',
        'expandIcon' => '<i class="glyphicon glyphicon-plus" style="color:black"></i>',
        'collapseIcon' => '<i class="glyphicon glyphicon-minus" style="color:black"></i>',
        'expandOneOnly' => true,
      ],
        [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'idusuario',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'usuario',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'contrasenia',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'nombre',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'email',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'activo',
        'format'=>'boolean',

    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'observacion',
    // ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) {
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete',
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'],
    ],

];
