<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Mensaje;
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
	<div class="tt-list-time-topic" style="height:400px; overflow-y: scroll;">
		<div class="tt-item-title">
			<span>12/26/2017</span>
		</div>
		<div class="tt-item">
			<div class="tt-col-avatar">
				<svg class="tt-icon">
					<use xlink:href="#icon-ava-k"></use>
				</svg>
			</div>
			<div class="tt-col-description">
				<h4 class="tt-title" style="font-size: 16px; font-weight: bold; color: black">Kevin <span class="time">3:12 AM</span></h4>
				<p>How is it going man? Did you see my new forum post?</p>
			</div>
		</div>
	</div>
	<div class="tt-wrapper-inner">
		<div class="pt-editor form-default">
			<div class="form-group">
				<textarea name="message" class="form-control" rows="5" placeholder="Write your message here"></textarea>
			</div>
			<div class="pt-row">
				<div class="col-auto ml-auto">
					<a href="#" class="btn btn-secondary btn-custom">Send</a>
				</div>
			</div>
		</div>
	</div>
</div>
