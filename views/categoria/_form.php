<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Categoria */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_facultad')->textInput() ?>

    <?= $form->field($model, 'nombre_categoria')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'abreviatura')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'color_categoria')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
