<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Mensaje;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="col-md-8">
	<div class="tt-title-content">
		<a href="#" class="tt-toggle-aside">
			<i class="tt-icon">
				<svg class="icon">
					<use xlink:href="#icon-arrow_left"></use>
				</svg>
			</i>
		</a>
		<h2 class="tt-title chat_history" data-touserid="<?= $usuarioChat->id_usuario ?>">
			<?= Html::encode("{$usuarioChat->nombre_usuario}")?>
		</h2>
		<div id="onlinetag" class="tt-description">
            <?php //Mostrar actividad con AJAX?>
		</div>
		<a href="#" class="tt-icon-link">
			<i class="tt-icon">
				<svg class="icon">
					<use xlink:href="#notification"></use>
				</svg>
			</i>
		</a>
	</div>

    <?php //Se genera con ajax el listado de chats ?>
	<div class="tt-list-time-topic prueba" name="prueba" id="chat_history" style="height:400px; overflow-y: scroll;">
        <div class="tt-col-description">
            <h4 class="tt-title" style="margin-left: 5%; font-size: 16px; font-weight: bold; color: black">Cargando mensajes... </h4>
        </div>

	</div>

    <?php //Formulario enviar el mensaje ?>
	<div class="tt-wrapper-inner">
		<div class="pt-editor form-default">
			<div class="form-group">
                <textarea name="chat_message" id="chat_message" class="form-control" rows="5" placeholder="Escribe tu mensaje aquí"></textarea>
			</div>
			<div class="pt-row">
				<div class="col-auto ml-auto">
                    <button href="#" name="send_chat" class="btn btn-secondary btn-custom send_chat">Enviar</button>
				</div>
			</div>
		</div>
	</div>
</div>
