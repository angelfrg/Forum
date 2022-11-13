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
                Inicia sesión para poder usar el foro.
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
				<?= $form->field($model, 'username')->textInput(['class'=>'form-control', 'id'=>'emailUsuario',
					'placeholder'=>'Email', 'maxlength'=>'20'])->label('Email') ?>
            </div>
            <div class="form-group">
				<?= $form->field($model, 'password')->passwordInput(['class'=>'form-control', 'id'=>'passwordUsuario',
					'placeholder'=>'**********', 'maxlength'=>'40'])->label('Contraseña') ?>
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="checkbox-group">
                            <?= $form->field($model, 'rememberMe')->checkbox(['id'=>'settingsCheckBox01','name'=>'checkbox',
                                    'template'=>"{input}<label for='settingsCheckBox01'><span class='check'></span><span class='box'></span>
                                <span class='tt-text'>Recordarme</span></label>"
                            ]) ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
				<?= Html::submitButton('Iniciar sesión', ['class' => 'btn btn-secondary btn-block', 'name' => 'sign-up-button']) ?>
            </div>
            <p>¿No tienes una cuenta? <a href="<?= Url::toRoute(['site/registro']);?>" class="tt-underline">Registrate aquí</a></p>
            <div class="tt-notes">
               Al iniciar sesión, estoy de acuerdo con los
                <a href="#" class="tt-underline">Términos de uso</a> y la <a href="#" class="tt-underline">Política de privacidad.</a>
            </div>
		<?php ActiveForm::end(); ?>
    </div>
</div>
