<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuarioAdminSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id_usuario') ?>

    <?= $form->field($model, 'nombre_usuario') ?>

    <?= $form->field($model, 'apellidos_usuario') ?>

    <?= $form->field($model, 'email_usuario') ?>

    <?= $form->field($model, 'password') ?>

    <?php // echo $form->field($model, 'puntos') ?>

    <?php // echo $form->field($model, 'id_carrera') ?>

    <?php // echo $form->field($model, 'id_tipo') ?>

    <?php // echo $form->field($model, 'ult_conexion') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
