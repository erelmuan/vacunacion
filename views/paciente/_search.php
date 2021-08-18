<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PacienteSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paciente-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nombre') ?>

    <?= $form->field($model, 'apellido') ?>

    <?= $form->field($model, 'dni') ?>

    <?= $form->field($model, 'edad_actual') ?>

    <?php // echo $form->field($model, 'tipo_de_edad_actual') ?>

    <?php // echo $form->field($model, 'localidad_establecimiento') ?>

    <?php // echo $form->field($model, 'vacuna') ?>

    <?php // echo $form->field($model, 'esquema') ?>

    <?php // echo $form->field($model, 'Dosis1') ?>

    <?php // echo $form->field($model, 'Dosis2') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
