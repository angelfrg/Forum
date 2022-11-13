<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\UsuarioRegistroForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\helpers\Url;
?>
<div class="tt-loginpages-wrapper">
    <div class="tt-loginpages">
        <a href="#" class="tt-block-title">
            <img src="images/logoUsal.png" alt="Logo usal">
            <div class="tt-title">
                Bienvenido a FORUM
            </div>
            <div class="tt-description">
                Registrate para poder usar el foro.
            </div>
        </a>
        <?php
		$form = ActiveForm::begin(
			[
				'options' => [
					'class' => 'form-default'
				]
			]
		);
        ?>
            <div class="form-group">
                <?= $form->field($model, 'nombre')->textInput(['class'=>'form-control', 'id'=>'nombreUsuario',
                    'placeholder'=>'Nombre', 'maxlength'=>'20'])->label('Nombre') ?>
            </div>
            <div class="form-group">
				<?= $form->field($model, 'apellidos')->textInput(['class'=>'form-control', 'id'=>'apellidosUsuario',
					'placeholder'=>'Apellidos', 'maxlength'=>'40'])->label('Apellidos') ?>
            </div>
            <div class="form-group">
				<?= $form->field($model, 'email')->textInput(['class'=>'form-control', 'id'=>'emailUsuario',
					'placeholder'=>'usuario@usal.es', 'maxlength'=>'40'])->label('Email') ?>
            </div>
            <div class="form-group">
				<?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'id'=>'passwordUsuario',
					'placeholder'=>'**********', 'maxlength'=>'40'])->label('Contraseña') ?>
            </div>
            <div class="form-group">
				<?= Html::submitButton('Registrame', ['class' => 'btn btn-secondary btn-block', 'name' => 'sign-up-button']) ?>
            </div>
            <p>¿Tienes una cuenta? <a href="<?= Url::toRoute(['site/login']);?>" class="tt-underline">Inicia sesión aquí</a></p>
            <div class="tt-notes">
                Al registrarme, estoy de acuerdo con los
                <a href="#" class="tt-underline">Términos de uso</a> y la <a href="#" class="tt-underline">Política de privacidad.</a>
            </div>
		<?php ActiveForm::end(); ?>
    </div>
</div>
