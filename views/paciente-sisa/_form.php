<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PacienteSisa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="paciente-sisa-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellido')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'edad_actual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_de_edad_actual')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'localidad_establecimiento')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vacuna')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'esquema')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Dosis1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'Dosis2')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
