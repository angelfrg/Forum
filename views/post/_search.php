<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PostsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="post-search">
    <div class="tt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['post/tendencias'],
        'method' => 'get',
        'options' => [
			'class' => 'search-wrapper',
            'data-pjax' => 1
        ],
    ]); ?>

        <div class="search-form">

			<?= $form->field($model, 'titulo_post')->textInput(['id'=>'tituloPost','class'=>'tt-search__input','placeholder'=>'Buscar Posts', 'maxlength'=>'20',
				])->label(false)
			?>

			<?= Html::submitButton('<svg class="tt-icon">
                    <use xlink:href="#icon-search"></use>
                </svg>', ['class' => 'tt-search__btn']) ?>


            <button class="tt-search__close">
                <svg class="tt-icon">
                    <use xlink:href="#icon-cancel"></use>
                </svg>
            </button>

        </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
