<?php
use app\models\Post;
use yii\helpers\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

if(!isset($tab) || strcmp($_GET['tab'], 'tabrespuestas')!=0) $tab='tabrespuestas';
//Yii::$app->request->queryParams['tab']= $tab;
$_GET['tab']= $tab;

if(empty($respuestas)){
	echo '<h1>No se ha encontrado ninguna respuesta</h1>';
	return 0;
}
?>
<div class="tt-topic-list">
	<div class="tt-list-header">
		<div class="tt-col-topic">Respuesta</div>
		<div class="tt-col-category">Categoría</div>
		<div class="tt-col-value">Actividad</div>
	</div>
    <?php foreach ($respuestas as $respuesta): ?>
	<div class="tt-item">
		<div class="tt-col-avatar">
            <a href="<?= Url::toRoute(['usuario/perfil', 'id'=>$respuesta->id_usuario]);?>">
                <svg class="tt-icon">
					<?php //Obtener nombre del usuario con id del post para poner su letra
					$usuario=$respuesta->getUsuario()->one();
					$letra=strtolower($usuario->nombre_usuario[0]);
					?>
                    <use xlink:href="#icon-ava-<?php echo $letra?>"></use>
                </svg>
            </a>
		</div>
		<div class="tt-col-description">
			<h6 class="tt-title"><a href="<?= Url::toRoute(['post/detalle','id'=>$respuesta->id_post_raiz]);?>">
					<?= Html::encode("{$respuesta->titulo_post}")?>
				</a></h6>
			<div class="row align-items-center no-gutters hide-desktope">
				<div class="col-9">
					<ul class="tt-list-badge">
						<?php $categoria=$respuesta->getCategoria()->one(); ?>
                        <li class="show-mobile"><a href="<?= Url::toRoute(['categoria/una', 'id'=>$categoria->id_categoria]);?>"><span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>"><?= Html::encode("{$categoria->abreviatura}")?></span></a></li>
                    </ul>
				</div>
				<?php
				$fecha=date_create($respuesta->fecha_post)->format("d/m/Y");
				?>
				<div class="col-3 ml-auto show-mobile">
					<div class="tt-value"><?= Html::encode("{$fecha}") ?></div>
				</div>
			</div>
			<div class="tt-content">
				<?= Html::encode("{$respuesta->cuerpo_post}")?>
			</div>
		</div>
		<div class="tt-col-category"><a href="<?= Url::toRoute(['categoria/una', 'id'=>$categoria->id_categoria]);?>"><span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>"><?= Html::encode("{$categoria->abreviatura}")?></span></a></div>
        <div class="tt-col-value-large hide-mobile"><?= Html::encode("{$fecha}") ?></div>
	</div>
	<?php endforeach; ?>
</div>
<div style="margin-top: 2%">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>