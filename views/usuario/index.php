<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\UsuarioAdminSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Usuarios');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Crear Usuario'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id_usuario',
            'nombre_usuario',
            'apellidos_usuario',
            'email_usuario:email',
            'puntos',
			[
				'attribute'=>'id_carrera',
				'content'=> function($model, $key, $index, $column){
                    if(isset($model->id_carrera) && $model->id_carrera!=null)
					    return $model->descripcionTitulaciones($model->id_carrera);
                    else
                        return 'Sin carrera';
				},
				'contentOptions'=>['class'=>'text-center'],
				'filter'=>\app\models\Usuario::listaTitulaciones(),
				'label'=>'Titulación'
			],
			[
				'attribute'=>'id_tipo',
				'content'=> function($model, $key, $index, $column){
					return $model->descripcionTiposUsuario($model->id_tipo);
				},
				'contentOptions'=>['class'=>'text-center'],
				'filter'=>\app\models\Usuario::listaTiposUsuario(),
                'label'=>'Tipo'
			],
            'ult_conexion',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id_usuario' => $model->id_usuario]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
