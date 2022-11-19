<?php
use app\models\Usuario;
use app\models\Post;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
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
						<i class="tt-icon">
                            <a href="<?= Url::toRoute(['usuario/perfil', 'id'=>$post->id_usuario]);?>">
                                <svg><use xlink:href="#icon-ava-<?php echo $letra?>"></use></svg></a></i>
					</div>
					<div class="tt-avatar-title">
						<a href="<?= Url::toRoute(['usuario/perfil', 'id'=>$post->id_usuario]);?>"><?= $usuario->nombre_usuario?></a>
					</div>
					<a href="#" class="tt-info-time">
						<i class="tt-icon"><svg><use xlink:href="#icon-time"></use></svg></i><?= date_create($post->fecha_post)->format("d/m/Y")?>
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
				<a href="#responder" class="tt-icon-btn tt-hover-02 tt-small-indent">
					<i class="tt-icon"><svg><use xlink:href="#icon-reply"></use></svg></i>
				</a>
			</div>
		</div>
	</div>
	<?php //Estadisticas del post
        $usuariosTotal=Post::find()
                                ->select(['id_usuario'])
                                ->where(['id_post'=>$post->id_post])
                                ->orWhere(['id_post_raiz'=>$post->id_post])
                                ->distinct()->count();
    ?>
	<div class="tt-item">
		<div class="tt-info-box">
			<h6 class="tt-title">Estado del post</h6>
			<div class="tt-row-icon">
				<div class="tt-item">
					<a href="#" class="tt-icon-btn tt-position-bottom">
						<i class="tt-icon"><svg><use xlink:href="#icon-reply"></use></svg></i>
						<span class="tt-text"><?=Html::encode(count($respuestas));?></span>
					</a>
				</div>
				<div class="tt-item">
					<a href="#" class="tt-icon-btn tt-position-bottom">
						<i class="tt-icon"><svg><use xlink:href="#icon-view"></use></svg></i>
						<span class="tt-text"><?= Html::encode($post->vistas_post);?></span>
					</a>
				</div>
				<div class="tt-item">
					<a href="#" class="tt-icon-btn tt-position-bottom">
						<i class="tt-icon"><svg><use xlink:href="#icon-user"></use></svg></i>
						<span class="tt-text"><?= Html::encode($usuariosTotal);?></span>
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
					<li><a href="#"><span class="tt-color02 tt-badge">Recientes</span></a></li>
					<li><a href="#"><span class="tt-badge">Con más Likes</span></a></li>
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

    <?php //Una respuesta
        if(!empty($respuestas)):
            foreach ($respuestas as $respuesta):
                $usuario=Usuario::find()->where(['id_usuario'=>$respuesta->id_usuario])->one();
    ?>
	<div class="tt-item">
		<div class="tt-single-topic">
			<div class="tt-item-header pt-noborder">
				<div class="tt-item-info info-top">
					<div class="tt-avatar-icon">
						<i class="tt-icon">
                            <a href="<?= Url::toRoute(['usuario/perfil', 'id'=>$usuario->id_usuario]);?>">
                                <svg class="tt-icon">
									<?php //Obtener nombre del usuario con id del post para poner su letra
									$letra=strtolower($usuario->nombre_usuario[0]);
									?>
                                    <use xlink:href="#icon-ava-<?php echo $letra?>"></use>
                                </svg>
                            </a>
                        </i>
					</div>
					<div class="tt-avatar-title">
						<a href="<?= Url::toRoute(['usuario/perfil', 'id'=>$usuario->id_usuario]);?>"><?= Html::encode("{$usuario->nombre_usuario}")?></a>
					</div>
					<a href="#" class="tt-info-time">
						<i class="tt-icon"><svg><use xlink:href="#icon-time"></use></svg></i><?= date_create($respuesta->fecha_post)->format("d/m/Y")?>
					</a>
				</div>
			</div>
			<div class="tt-item-description">
				<?= Html::encode("{$respuesta->cuerpo_post}")?>
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

			</div>
		</div>
	</div>
    <?php endforeach; ?>
    <div class="tt-wrapper-inner">
        <h4 class="tt-title-separator"><span>Has llegado al final de las respuestas</span></h4>
    </div>
    <?php endif;?>

</div>

<?php
if(!Yii::$app->user->isGuest):
$form = ActiveForm::begin(
	[
		'options' => [
			'class' => 'form-default'
		]
	]
);
?>
<div class="tt-wrapper-inner" id="responder">
    <div class="pt-editor form-default">
        <h6 class="pt-title">Pon tu respuesta</h6>
        <div class="form-group">
			<?=
			$form->field($model, 'cuerpo')->textarea(['class'=>'form-control', 'id'=>'cuerpoPost',
				'rows'=>'5', 'maxlength'=>'500', 'placeholder'=>'Escribe tu respuesta...',
				'onkeydown'=>"modificarValor(this.id, 'maxCuerpo', event, 500)"])->label(false)
			?>
            <span id="maxCuerpo" class="tt-value-input">500</span>
        </div>
        <div class="pt-row">
            <div class="col-auto">
				<?= Html::submitButton('Enviar', ['class' => 'btn btn-secondary btn-width-lg', 'name' => 'crearPost']) ?>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end();
    else:?>
<div class="tt-topic-list">
    <div class="tt-item tt-item-popup">
        <div class="tt-col-avatar">
            <svg class="tt-icon">
                <use xlink:href="#icon-ava-u"></use>
            </svg>
        </div>
        <div class="tt-col-message">
            Parece que eres nuevo, regístrate con tu correo de la USAL o inicia sesión para contribuir
        </div>
        <div class="tt-col-btn">
            <a href='<?= Url::toRoute(["site/login"])?>' class='btn btn-primary'>Iniciar Sesión</a>
            <a href='<?= Url::toRoute(["site/registro"])?>' class='btn btn-secondary'>Registrarse</a>
        </div>
    </div>
</div>
<?php endif;?>
