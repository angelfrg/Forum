<?php

use app\models\Post;
use app\models\SuscripcionCategoria;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;
use yii\widgets\Pjax;

/** @var yii\web\View $this */

?>
<div class="site-index">
<div class="tt-categories-title">
    <div class="tt-title">Categorias</div>
    <div class="tt-search">
        <form class="search-wrapper">
            <div class="search-form">
                <input type="text" class="tt-search__input" placeholder="Buscar categorias">
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
	<?php //Pjax::begin();?>
<div class="tt-categories-list">
    <div class="row">
        <?php foreach ($categorias as $categoria): ?>
        <div class="col-md-6 col-lg-4">
            <div class="tt-item">
                <div class="tt-item-header">
                    <ul class="tt-list-badge">
                        <li><a href="<?= Url::toRoute(['categoria/una', 'id'=>$categoria->id_categoria]);?>"><span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>"><?= Html::encode("{$categoria->abreviatura}")?></span></a></li>
                    </ul>
                    <?php
					$totalPosts=Post::find()
						->where(['id_categoria'=>$categoria->id_categoria, 'id_post_raiz'=>null])
						->count();
                    ?>
                    <h6 class="tt-title"><a href="<?= Url::toRoute(['categoria/una', 'id'=>$categoria->id_categoria]);?>"> Posts - <?= $totalPosts ?></a></h6>
                </div>
                <div class="tt-item-layout">
                    <div class="innerwrapper">
						<?= Html::encode("{$categoria->nombre_categoria}")?>
                    </div>
                    <div class="innerwrapper">
                        <h6 class="tt-title">TAGS relacionados</h6>
                        <ul class="tt-list-badge">
                            <?php //Tags de posts sobre la categoria ?>
                            <li><a href="#"><span class="tt-badge">world politics</span></a></li>
                            <li><a href="#"><span class="tt-badge">human rights</span></a></li>
                            <li><a href="#"><span class="tt-badge">trump</span></a></li>
                            <li><a href="#"><span class="tt-badge">climate change</span></a></li>
                            <li><a href="#"><span class="tt-badge">foreign policy</span></a></li>
                        </ul>
                    </div>
                    <?php
                    if(!Yii::$app->user->isGuest) {
						$comprobar = SuscripcionCategoria::find()->where(['id_usuario' => Yii::$app->user->identity->id, 'id_categoria' => $categoria->id_categoria])->count();

						if ($comprobar !== 1)
							echo '<a href="' . Url::toRoute(['categoria/suscribir', 'id' => $categoria->id_categoria]) . '" class="tt-btn-icon">
                                <i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                            </a>';
						else
							echo '<a href="' . Url::toRoute(['categoria/desuscribir', 'id' => $categoria->id_categoria]) . '" class="tt-btn-icon">
                                <i class="tt-icon" style="fill: red"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                            </a>';
					}
                    else
						echo '<a href="' . Url::toRoute(['site/login']) . '" class="tt-btn-icon">
                                <i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                            </a>';
                    ?>
                </div>
            </div>
        </div>
		<?php endforeach; ?>
    </div>
    <div style="margin-top: 2%">
		<?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>
	<?php //Pjax::end(); ?>
</div>