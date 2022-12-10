<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UsuariosSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<?php $form = ActiveForm::begin([
    'action' => ['mensaje/listadochats'],
    'method' => 'get',
    'options' => [
        //'class' => 'search-wrapper',
        'data-pjax' => 1,
        'style'=>"height:100%"
    ],
]); ?>

<div class="tt-input">

    <?= $form->field($model, 'email_usuario')->textInput(['id'=>'emailUsuario','class'=>'tt-search-input','placeholder'=>'Busca un usuario por su email', 'maxlength'=>'30',
    ])->label(false)
    ?>
</div>

<?php ActiveForm::end(); ?>

