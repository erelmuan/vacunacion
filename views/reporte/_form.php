<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Reporte */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reporte-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ceular')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nombres')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grupo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_nacimiento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grupo_de_riesgo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'comorbilidades')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localidad')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacuna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'primera_dosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'segunda_dosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'creado_el')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modprimeradosis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'modsegundadosis')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
