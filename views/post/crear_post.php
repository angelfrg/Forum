<?php

use app\models\Categoria;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Post */
/* @var $form ActiveForm */
?>
<h1 class="tt-title-border">
	Crear Post
</h1>
<?= Html::beginForm(
        Url::toRoute("post/crear"),
        "post",
    ['class'=>'form-default form-create-topic']
    );
?>
	<div class="form-group">
        <?= Html::label("Título del Post", "tituloPost") ?>
		<div class="tt-value-wrapper">
            <?= Html::input('text', ['name'=>'tituloPost'],null,
                ['id'=>'tituloPost','class'=>'form-control','placeholder'=>'Tema de tu post', 'maxlength'=>'50',
                    'onkeydown'=>"modificarValor(this.id, 'maxTema', event, 50)"])
            ?>
			<span id="maxTema" class="tt-value-input">50</span>
		</div>
		<div class="tt-note">Describe tu post de manera breve.</div>
	</div>
	<div class="form-group">
		<label>Tipo de Post</label>
		<div class="tt-js-active-btn tt-wrapper-btnicon">
			<div class="row tt-w410-col-02">
				<div class="col-4 col-lg-3 col-xl-2">
					<a href="#" class="tt-button-icon" id="tipoDebate">
                                    <span class="tt-icon">
                                        <svg>
                                            <use xlink:href="#icon-discussion"></use>
                                        </svg>
                                    </span>
						<span class="tt-text">Debate</span>
					</a>
				</div>
				<div class="col-4 col-lg-3 col-xl-2">
					<a href="#" class="tt-button-icon" id="tipoPregunta">
                                    <span class="tt-icon">
                                         <svg>
                                            <use xlink:href="#Question"></use>
                                        </svg>
                                    </span>
						<span class="tt-text">Pregunta</span>
					</a>
				</div>
			</div>
		</div>
	</div>
	<div class="pt-editor">
		<h6 class="pt-title">Cuerpo del Post</h6>
		<div class="form-group">
            <?= Html::textarea('cuerpoPost', null,['class'=>'form-control', 'id'=>'cuerpoPost',
                'rows'=>'5', 'maxlength'=>'500', 'placeholder'=>'Describe tu cuestión', 'onkeydown'=>"modificarValor(this.id, 'maxCuerpo', event, 500)"]) ?>
            <span id="maxCuerpo" class="tt-value-input">500</span>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="form-group">
					<label for="inputTopicTitle">Categoría</label>
					<select class="form-control" id="categoria">
						<option value="Select">Selecciona una ...</option>
						<?php foreach ($categorias as $categoria): ?>
                            <option value="<?= $categoria->abreviatura ?>"><?= Html::encode("{$categoria->nombre_categoria}") ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="col-md-8">
				<div class="form-group">
                    <?= Html::label('Tags', 'tagsPost') ?>
                    <div class="tt-value-wrapper">
                        <?= Html::input('text','tagsPost', null, ['id'=>'tagsPost', 'class'=>'form-control' ,'maxlength'=>'30', 'placeholder'=>'Separa los tags con una coma', 'onkeydown'=>"modificarValor(this.id, 'maxTags', event, 30)"]) ?>
                        <span id="maxTags" class="tt-value-input">30</span>
                    </div>

				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-auto ml-md-auto">
                <?= Html::submitButton('Crear Post', ['class' => 'btn btn-secondary btn-width-lg', 'name' => 'crearPost']) ?>
			</div>
		</div>
	</div>
<?= Html::endForm() ?>