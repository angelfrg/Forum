<?php
use app\models\Usuario;
use \app\models\Post;
use yii\helpers\Html;
use yii\bootstrap5\LinkPager;
use yii\helpers\Url;

if(isset($pag) && strcmp($pag, 'seguidores')==0)
    if(!isset($tab) || strcmp($_GET['tab'], 'tabseguidores')!=0) $tab='tabseguidores';

if(isset($pag) && strcmp($pag, 'siguiendo')==0)
	if(!isset($tab) || strcmp($_GET['tab'], 'tabsiguiendo')!=0) $tab='tabsiguiendo';

$_GET['tab']= $tab;

if(empty($usuarios)){
	echo '<div class="tt-followers-list"><h1>No se ha encontrado ningún usuario</h1></div>';
	return 0;
}
?>
<div class="tt-followers-list">
	<div class="tt-list-header">
		<div class="tt-col-name">Usuario</div>
		<div class="tt-col-value-large hide-mobile">Última actividad</div>
		<div class="tt-col-value-large hide-mobile">Posts</div>
		<div class="tt-col-value-large hide-mobile">Respuestas</div>
		<div class="tt-col-value">Puntos</div>
	</div>
	<?php foreach ($usuarios as $usuario): ?>
	<div class="tt-item">
		<div class="tt-col-merged">
			<div class="tt-col-avatar">
                <a href="<?= Url::toRoute(['usuario/perfil', 'id'=>$usuario->id_usuario]);?>">
                    <svg class="tt-icon">
						<?php //Obtener nombre del usuario con id del post para poner su letra
						$letra=strtolower($usuario->nombre_usuario[0]);
						?>
                        <use xlink:href="#icon-ava-<?php echo $letra?>"></use>
                    </svg>
                </a>
			</div>
			<div class="tt-col-description">
				<h6 class="tt-title"><a href="<?= Url::toRoute(['usuario/perfil', 'id'=>$usuario->id_usuario]);?>">
                        <?= Html::encode("{$usuario->nombre_usuario}")?></a></h6>
				<ul>
					<li><a href="mailto:<?= Html::encode("{$usuario->email_usuario}")?>"><?= Html::encode("{$usuario->email_usuario}")?></a></li>
				</ul>
			</div>
		</div>
        <?php
            $fecha=$usuario->ultimaConexion();
            $totalPosts=Post::find()->where(['id_usuario'=>$usuario->id_usuario, 'id_post_raiz'=>null])->count();
            $totalRespuestas=Post::find()
                ->where(['id_usuario'=>$usuario->id_usuario])->andWhere(['not', ['id_post_raiz'=>null]])
                ->count();
        ?>
		<div class="tt-col-value-large hide-mobile tt-color-select"><?php if($fecha->d>0) echo $fecha->d.'d';
                                                                            else echo $fecha->h.'h';?></div>
		<div class="tt-col-value-large hide-mobile"><?= Html::encode("{$totalPosts}")?></div>
		<div class="tt-col-value-large hide-mobile"><?= Html::encode("{$totalRespuestas}")?></div>
		<div class="tt-col-value"><span class="tt-color16 tt-badge">Puntos: <?= Html::encode("{$usuario->puntos}")?></span></div>
	</div>
	<?php endforeach; ?>
</div>
<div style="margin-top: 2%">
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>