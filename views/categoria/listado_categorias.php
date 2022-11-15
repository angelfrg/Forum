<?php

use app\models\Post;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap5\LinkPager;

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
						->where(['id_categoria'=>$categoria->id_categoria])
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
                    <a href="#" class="tt-btn-icon">
                        <i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                    </a>
                </div>
            </div>
        </div>
		<?php endforeach; ?>
    </div>
    <div style="margin-top: 2%">
		<?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>
</div>