<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apellidos_usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email_usuario')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'puntos')->textInput() ?>

	<?= $form->field($model, 'id_carrera')->dropDownList($model::listaTitulaciones())->label('Titulación') ?>

	<?= $form->field($model, 'id_tipo')->dropDownList($model::listaTiposUsuario())->label('Tipo (Rol)') ?>

    <?= $form->field($model, 'ult_conexion')->textInput() ?>

    <div class="form-group mt-2">
        <?= Html::submitButton(Yii::t('app', 'Guardar'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
