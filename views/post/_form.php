<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_post_raiz')->textInput() ?>

    <?= $form->field($model, 'id_usuario')->textInput() ?>

    <?= $form->field($model, 'id_categoria')->textInput() ?>

    <?= $form->field($model, 'titulo_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cuerpo_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tags_post')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vistas_post')->textInput() ?>

    <?= $form->field($model, 'fecha_post')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
