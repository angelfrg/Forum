<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */

$this->title = 'ID Usuario: '.$model->id_usuario;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="usuario-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Actualizar'), ['update', 'id_usuario' => $model->id_usuario], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Borrar'), ['delete', 'id_usuario' => $model->id_usuario], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', '¿Estás seguro de querer borrar este usuario?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_usuario',
            'nombre_usuario',
            'apellidos_usuario',
            'email_usuario:email',
            'password',
            'puntos',
			[
				'attribute'=>'id_carrera',
				'value'=>
					(isset($model->id_carrera) && $model->id_carrera!=null) ? $model->descripcionTitulaciones($model->id_carrera) :'Sin carrera',
                'label'=>'Titulación'
			],
			[
				'attribute'=>'id_tipo',
				'value'=> $model->descripcionTiposUsuario($model->id_tipo),
                'label'=>'Tipo (Rol)'
			],
            'ult_conexion',
        ],
    ]) ?>

</div>
