<?php
use app\models\Post;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="tt-single-topic-list">
	<?php //DATOS POST ?>
	<div class="tt-item">
		<div class="tt-single-topic">
			<div class="tt-item-header">
				<div class="tt-item-info info-top">
					<?php //Obtener nombre del usuario con id del post para poner su letra
                        $usuario=$post->getUsuario()->one();
                        $letra=strtolower($usuario->nombre_usuario[0]);
					?>
					<div class="tt-avatar-icon">
						<i class="tt-icon"><svg><use xlink:href="#icon-ava-<?php echo $letra?>"></use></svg></i>
					</div>
					<div class="tt-avatar-title">
						<a href="#"><?= $usuario->nombre_usuario?></a>
					</div>
					<a href="#" class="tt-info-time">
						<i class="tt-icon"><svg><use xlink:href="#icon-time"></use></svg></i><?= $post->fecha_post?>
					</a>
				</div>
				<h3 class="tt-item-title">
					<a href=""><?= Html::encode("{$post->titulo_post}")?></a>
				</h3>
				<div class="tt-item-tag">
					<?php $categoria=$post->getCategoria()->one(); ?>
					<ul class="tt-list-badge">
						<li><a href="<?= Url::toRoute(['categoria/una', 'id'=>$categoria->id_categoria]);?>">
                                <span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>">
                                    <?= Html::encode("{$categoria->abreviatura}")?></span></a></li>
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
			</div>
			<div class="tt-item-description">
				<p><?= Html::encode("{$post->cuerpo_post}")?></p>
			</div>
			<div class="tt-item-info info-bottom">
				<a href="#" class="tt-icon-btn">
					<i class="tt-icon"><svg><use xlink:href="#icon-like"></use></svg></i>
					<span class="tt-text">671</span>
				</a>
				<a href="#" class="tt-icon-btn">
					<i class="tt-icon"><svg><use xlink:href="#icon-dislike"></use></svg></i>
					<span class="tt-text">39</span>
				</a>
				<div class="col-separator"></div>
				<a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
					<i class="tt-icon"><svg><use xlink:href="#icon-reply"></use></svg></i>
				</a>
			</div>
		</div>
	</div>
	<?php //Estadisticas del post ?>
	<div class="tt-item">
		<div class="tt-info-box">
			<h6 class="tt-title">Thread Status</h6>
			<div class="tt-row-icon">
				<div class="tt-item">
					<a href="#" class="tt-icon-btn tt-position-bottom">
						<i class="tt-icon"><svg><use xlink:href="#icon-reply"></use></svg></i>
						<span class="tt-text">283</span>
					</a>
				</div>
				<div class="tt-item">
					<a href="#" class="tt-icon-btn tt-position-bottom">
						<i class="tt-icon"><svg><use xlink:href="#icon-view"></use></svg></i>
						<span class="tt-text">10.5k</span>
					</a>
				</div>
				<div class="tt-item">
					<a href="#" class="tt-icon-btn tt-position-bottom">
						<i class="tt-icon"><svg><use xlink:href="#icon-user"></use></svg></i>
						<span class="tt-text">168</span>
					</a>
				</div>
				<div class="tt-item">
					<a href="#" class="tt-icon-btn tt-position-bottom">
						<i class="tt-icon"><svg><use xlink:href="#icon-like"></use></svg></i>
						<span class="tt-text">2.4k</span>
					</a>
				</div>
			</div>
			<hr>
			<div class="row-object-inline form-default">
				<h6 class="tt-title">Ordenar respuestas por:</h6>
				<ul class="tt-list-badge tt-size-lg">
					<li><a href="#"><span class="tt-badge">Recientes</span></a></li>
					<li><a href="#"><span class="tt-color02 tt-badge">Con más Likes</span></a></li>
					<li><a href="#"><span class="tt-badge">Largas</span></a></li>
					<li><a href="#"><span class="tt-badge">Cortas</span></a></li>
				</ul>
				<select class="tt-select form-control">
					<option value="Recent">Recientes</option>
					<option value="Most Liked">Con más Likes</option>
					<option value="Longest">Mas largas</option>
					<option value="Shortest">Mas cortas</option>
				</select>
			</div>
		</div>
	</div>
    <?php //Una respuesta ?>
	<div class="tt-item">
		<div class="tt-single-topic">
			<div class="tt-item-header pt-noborder">
				<div class="tt-item-info info-top">
					<div class="tt-avatar-icon">
						<i class="tt-icon"><svg><use xlink:href="#icon-ava-t"></use></svg></i>
					</div>
					<div class="tt-avatar-title">
						<a href="#">tesla02</a>
					</div>
					<a href="#" class="tt-info-time">
						<i class="tt-icon"><svg><use xlink:href="#icon-time"></use></svg></i>6 Jan,2019
					</a>
				</div>
			</div>
			<div class="tt-item-description">
				Finally!<br>
				Are there any special recommendations for design or an updated guide that includes new preview sizes, including retina displays?
			</div>
			<div class="tt-item-info info-bottom">
				<a href="#" class="tt-icon-btn">
					<i class="tt-icon"><svg><use xlink:href="#icon-like"></use></svg></i>
					<span class="tt-text">671</span>
				</a>
				<a href="#" class="tt-icon-btn">
					<i class="tt-icon"><svg><use xlink:href="#icon-dislike"></use></svg></i>
					<span class="tt-text">39</span>
				</a>
				<a href="#" class="tt-icon-btn">
					<i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
					<span class="tt-text">12</span>
				</a>
				<div class="col-separator"></div>
				<a href="#" class="tt-icon-btn tt-hover-02 tt-small-indent">
					<i class="tt-icon"><svg><use xlink:href="#icon-reply"></use></svg></i>
				</a>
			</div>
		</div>
	</div>
</div>

<div class="tt-wrapper-inner">
    <h4 class="tt-title-separator"><span>Has llegado al final de las respuestas</span></h4>
</div>

<?php //Respuesta ?>
<div class="tt-wrapper-inner">
    <div class="pt-editor form-default">
        <h6 class="pt-title">Pon tu respuesta</h6>
        <div class="form-group">
            <textarea name="message" class="form-control" rows="5" placeholder="Escribe tu respuesta..."></textarea>
        </div>
        <div class="pt-row">
            <div class="col-auto">
                <a href="#" class="btn btn-secondary btn-width-lg">Enviar</a>
            </div>
        </div>
    </div>
</div>