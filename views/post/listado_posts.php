<?php
use app\models\Post;
use yii\helpers\Html;
use yii\widgets\LinkPager;
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
				<use xlink:href="#icon-ava-c"></use>
			</svg>
		</div>
		<div class="tt-col-description">
			<h6 class="tt-title"><a href="page-single-topic.html">
					<?= Html::encode("{$post->titulo_post}")?>
				</a></h6>
			<div class="row align-items-center no-gutters">
				<div class="col-11">
					<ul class="tt-list-badge">
						<li class="show-mobile"><a href="#"><span class="tt-color04 tt-badge">pets</span></a></li>
						<li><a href="#"><span class="tt-badge">videohive</span></a></li>
						<li><a href="#"><span class="tt-badge">photodune</span></a></li>
					</ul>
				</div>
				<div class="col-1 ml-auto show-mobile">
					<div class="tt-value">1d</div>
				</div>
			</div>
		</div>
		<div class="tt-col-category"><span class="tt-badge">pets</span></div>
		<div class="tt-col-value  hide-mobile">308</div>
		<div class="tt-col-value tt-color-select  hide-mobile">660</div>
		<div class="tt-col-value  hide-mobile">8.3k</div>
		<div class="tt-col-value hide-mobile">1d</div>
	</div>
	<?php endforeach; ?>
</div>