<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriasSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categoria-search">
    <div class="tt-search">

    <?php $form = ActiveForm::begin([
        'action' => ['categoria/index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1,
			'class' => 'search-wrapper',
        ],
    ]); ?>

    <div class="search-form">


		<?= $form->field($model, 'nombre_categoria')->textInput(['id'=>'nombreCategoria','class'=>'tt-search__input','placeholder'=>'Buscar categorias', 'maxlength'=>'30',
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
