<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */

$this->title = 'USAL Forum';
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
                        <li><a href="#"><span class="tt-color01 tt-badge"><?= Html::encode("{$categoria->abreviatura}")?></span></a></li>
                    </ul>
                    <h6 class="tt-title"><a href="page-categories-single.html"><?php //Numero de posts sobre la categoria ?>Threads - 1,245</a></h6>
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
	<?= LinkPager::widget(['pagination' => $pagination]) ?>
</div>
</div>