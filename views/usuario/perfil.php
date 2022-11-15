<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="tt-user-header">
    <div class="tt-col-avatar">
        <div class="tt-icon">
            <svg class="tt-icon">
				<?php //Obtener nombre del usuario con id del post para poner su letra
				$letra=strtolower($usuario->nombre_usuario[0]);
				?>
                <use xlink:href="#icon-ava-<?php echo $letra?>"></use>
            </svg>
        </div>
    </div>
    <div class="tt-col-title">
        <div class="tt-title">
            <a href=""><?= Html::encode("{$usuario->nombre_usuario}")?></a>
        </div>
        <ul class="tt-list-badge">
            <li><a href=""><span class="tt-color14 tt-badge">Puntos : <?= Html::encode("{$usuario->puntos}")?></span></a></li>
        </ul>
    </div>
    <div class="tt-col-btn" id="js-settings-btn">
        <div class="tt-list-btn">
            <a href="#" class="tt-btn-icon">
                <svg class="tt-icon">
                    <use xlink:href="#icon-settings_fill"></use>
                </svg>
            </a>
            <?php
                if($usuario->id_usuario !== Yii::$app->user->identity->id){
                    echo '<a href="#" class="btn btn-primary">Mensaje</a>';
                    echo '<a href="#" class="btn btn-secondary">Seguir</a>';
                }
            ?>
        </div>
    </div>
</div>

<div class="tt-wrapper">
    <div class="tt-wrapper-inner">
        <ul class="nav nav-tabs pt-tabs-default" role="tablist">
            <li class="nav-item show">
                <a class="nav-link" data-toggle="tab" href="#tt-tab-01" role="tab"><span>Actividad</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tt-tab-02" role="tab"><span>Posts</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#tt-tab-03" role="tab"><span>Respuestas</span></a>
            </li>
            <li class="nav-item tt-hide-xs">
                <a class="nav-link" data-toggle="tab" href="#tt-tab-04" role="tab"><span>526 Seguidores</span></a>
            </li>
            <li class="nav-item tt-hide-md">
                <a class="nav-link" data-toggle="tab" href="#tt-tab-05" role="tab"><span>489 Siguiendo</span></a>
            </li>
            <li class="nav-item tt-hide-md">
                <a class="nav-link" data-toggle="tab" href="#tt-tab-06" role="tab"><span>Categorias</span></a>
            </li>
        </ul>
    </div>

    <?php //Poner contenido de cada pestaña ?>

</div>



