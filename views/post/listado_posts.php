<?php
use app\models\Post;
use yii\helpers\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

if(empty($posts)){
    echo '<h1>No se ha encontrado ningún post</h1>';
    return 0;
}
?>
<div class="tt-topic-list">
	<div class="tt-list-header">
		<div class="tt-col-topic">Tema</div>
		<div class="tt-col-category">Categoria</div>
		<div class="tt-col-value hide-mobile">Likes</div>
		<div class="tt-col-value hide-mobile">Respuestas</div>
		<div class="tt-col-value hide-mobile">Vistas</div>
		<div class="tt-col-value">Actividad</div>
	</div>
	<?php foreach ($posts as $post): ?>
	<div class="tt-item">
		<div class="tt-col-avatar">
			<svg class="tt-icon">
                <?php //Obtener nombre del usuario con id del post para poner su letra
                    $usuario=$post->getUsuario()->one();
                    $letra=strtolower($usuario->nombre_usuario[0]);
                ?>
				<use xlink:href="#icon-ava-<?php echo $letra?>"></use>
			</svg>
		</div>
		<div class="tt-col-description">
			<h6 class="tt-title"><a href="<?= Url::toRoute(['post/detalle','id'=>$post->id_post]);?>">
					<?= Html::encode("{$post->titulo_post}")?>
				</a></h6>
			<div class="row align-items-center no-gutters">
				<div class="col-11">
					<ul class="tt-list-badge">
                        <?php $categoria=$post->getCategoria()->one(); ?>
						<li class="show-mobile"><a href="<?= Url::toRoute(['categoria/una', 'id'=>$categoria->id_categoria]);?>"><span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>"><?= Html::encode("{$categoria->abreviatura}")?></span></a></li>
						<?php //Mostrar los tags del post separados
                            $tags=$post->obtenerListaTags();
                            if(isset($tags)){
								foreach ($tags as $tag){
                                    if($tag!=""){
										echo '<li><a href="#"><span class="tt-badge">'.$tag.'</span></a></li>';
                                    }
								}
                            }
                        ?>
					</ul>
				</div>
				<div class="col-1 ml-auto show-mobile">
					<div class="tt-value">1d</div>
				</div>
			</div>
		</div>
		<div class="tt-col-category"><a href="<?= Url::toRoute(['categoria/una', 'id'=>$categoria->id_categoria]);?>"><span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>"><?= Html::encode("{$categoria->abreviatura}")?></span></a></div>
		<div class="tt-col-value  hide-mobile">308</div>
		<div class="tt-col-value tt-color-select  hide-mobile">660</div>
		<div class="tt-col-value  hide-mobile"><?= Html::encode("{$post->vistas_post}")?></div>
		<div class="tt-col-value hide-mobile">1d</div>
	</div>
	<?php endforeach; ?>
</div>
<?= LinkPager::widget(['pagination' => $pagination]) ?>