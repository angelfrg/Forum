<?php
namespace app\views\categoria;
use app\models\Post;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="tt-catSingle-title">
	<div class="tt-innerwrapper tt-row">
		<div class="tt-col-left">
			<ul class="tt-list-badge">
				<li><a href="#"><span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>"><?= Html::encode("{$categoria->abreviatura}")?></span></a></li>
			</ul>
		</div>
		<div class="ml-left tt-col-right">
			<div class="tt-col-item">
				<h2 class="tt-value">Posts - <?= $totalPosts?></h2>
			</div>
			<div class="tt-col-item">
				<a href="#" class="tt-btn-icon">
					<i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
				</a>
			</div>
			<div class="tt-col-item">
				<div class="tt-search">
					<button class="tt-search-toggle" data-toggle="modal" data-target="#modalAdvancedSearch">
						<svg class="tt-icon">
							<use xlink:href="#icon-search"></use>
						</svg>
					</button>
					<form class="search-wrapper">
						<div class="search-form">
							<input type="text" class="tt-search__input" placeholder="Buscar en <?php echo $categoria->abreviatura ?>">
							<button class="tt-search__btn" type="submit">
								<svg class="tt-icon">
									<use xlink:href="#icon-search"></use>
								</svg>
							</button>
							<button class="tt-search__close">
								<svg class="tt-icon">
									<use xlink:href="#icon-cancel"></use>
								</svg>
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="tt-innerwrapper">
		<?= Html::encode("{$categoria->nombre_categoria}")?>
	</div>
	<div class="tt-innerwrapper">
		<h6 class="tt-title">Tags relacionados</h6>
		<ul class="tt-list-badge">
			<li><a href="#"><span class="tt-badge">world politics</span></a></li>
			<li><a href="#"><span class="tt-badge">human rights</span></a></li>
			<li><a href="#"><span class="tt-badge">trump</span></a></li>
			<li><a href="#"><span class="tt-badge">climate change</span></a></li>
			<li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
			<li><a href="#"><span class="tt-badge">world politics</span></a></li>
			<li><a href="#"><span class="tt-badge">human rights</span></a></li>
			<li><a href="#"><span class="tt-badge">trump</span></a></li>
			<li><a href="#"><span class="tt-badge">climate change</span></a></li>
		</ul>
	</div>
</div>
<?php
    $posts=Post::find()
        ->where(['id_categoria'=>$categoria->id_categoria])->all();

    $this->render('@app/views/post/listado_posts', [
        'posts'=>$posts,
    ]);
?>