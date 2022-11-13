<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

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
        <form class="form-default">
            <div class="form-group">
                <label for="loginUserName">Username</label>
                <input type="text" name="name" class="form-control" id="loginUserName" placeholder="azyrusmax">
            </div>
            <div class="form-group">
                <label for="loginUserPassword">Password</label>
                <input type="password" name="name" class="form-control" id="loginUserPassword" placeholder="************">
            </div>
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="checkbox-group">
                            <input type="checkbox" id="settingsCheckBox01" name="checkbox">
                            <label for="settingsCheckBox01">
                                <span class="check"></span>
                                <span class="box"></span>
                                <span class="tt-text">Remember me</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <a href="#" class="btn btn-secondary btn-block">Log in</a>
            </div>
            <p>¿No tienes una cuenta? <a href="<?= Url::toRoute(['site/registro']);?>" class="tt-underline">Registrate aquí</a></p>
            <div class="tt-notes">
               Al iniciar sesión, estoy de acuerdo con los
                <a href="#" class="tt-underline">Términos de uso</a> y la <a href="#" class="tt-underline">Política de privacidad.</a>
            </div>
        </form>
    </div>
</div>
