<?php
use yii\helpers\Url;
use yii\helpers\Html;
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
		<h2 class="tt-title">
			Nuevo mensaje
		</h2>
	</div>

	<div class="tt-search-compose">

		<?php  echo $this->render('@app/views/usuario/_search', ['model' => $searchModel]); ?>

        <?php /*<div class="tt-input">
			<input type="text" class="tt-search-input" placeholder="Busca un usuario por su email">
		</div>*/ ?>

		<div class="tt-search-results">
            <?php foreach ($searchUsuarios as $usu): ?>
			<a href="<?= Url::toRoute(['mensaje/listadochats', 'id'=>$usu->id_usuario]);?>" class="tt-item">

				<div class="tt-col-avatar">
					<svg class="tt-icon">
						<use xlink:href="#icon-ava-<?php echo strtolower($usu->nombre_usuario[0])?>"></use>
					</svg>
				</div>

				<div class="tt-col-description">
					<h4 class="tt-title"><span><?= Html::encode("{$usu->nombre_usuario}")?></span></h4>
					<div class="tt-value"><?= Html::encode("{$usu->email_usuario}")?></div>
				</div>
			</a>
            <?php endforeach; ?>
		</div>

	</div>

</div>
