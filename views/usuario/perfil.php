<?php
/* @var $this yii\web\View */

use app\models\Post;
use app\models\Seguidores;
use app\models\Usuario;
use \app\models\SuscripcionCategoria;
use app\models\Categoria;
use yii\bootstrap5\Tabs;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<div class="tt-user-header">
    <div class="tt-col-avatar">
        <div class="tt-icon">
            <svg class="tt-icon">
				<?php //Obtener nombre del usuario con id del post para poner su letra
				$letra=strtolower($usuario->nombre_usuario[0]);
				?>
                <use xlink:href="#icon-ava-<?php echo $letra?>"></use>
            </svg>
        </div>
    </div>
    <div class="tt-col-title">
        <div class="tt-title">
            <a href="#"><?= Html::encode("{$usuario->nombre_usuario}")?></a>
        </div>
        <ul class="tt-list-badge">
            <li><span class="tt-color14 tt-badge">Puntos : <?= Html::encode("{$usuario->puntos}")?></span></li>
            <?php
                $sqlTipo=$usuario->getTipo();
                $tipo=$sqlTipo->one();
            ?>
            <li><span class="tt-color10 tt-badge"><?= Html::encode("{$tipo->nombre_tipo}") ?></span></li>
        </ul>
    </div>
    <div class="tt-col-btn" >
        <?php if(!Yii::$app->user->isGuest) {
			echo '<div class="tt-list-btn">';

            if($usuario->id_usuario == Yii::$app->user->identity->id) {
				echo '<a id="js-settings-btn" href="#" class="tt-btn-icon">';
				echo '<svg class="tt-icon">';
				echo '<use xlink:href="#icon-settings_fill"></use>';
				echo '</svg></a>';
			}

			if ($usuario->id_usuario !== Yii::$app->user->identity->id) {
				echo '<a href="'.Url::toRoute(['mensaje/listadochats', 'id'=>$usuario->id_usuario]).'" class="btn btn-primary">Mensaje</a>';
                if(Seguidores::find()->where(['id_seguidor'=>Yii::$app->user->identity->id, 'id_seguido'=>$usuario->id_usuario])->count()!==1)
				    echo '<a href="'.Url::toRoute(['usuario/seguir', 'id'=>$usuario->id_usuario]).'" class="btn btn-secondary">Seguir</a>';
                else
					echo '<a href="'.Url::toRoute(['usuario/dejarseguir', 'id'=>$usuario->id_usuario]).'" class="btn btn-secondary">Dejar de seguir</a>';

			}

			echo '</div>';
		}
        ?>
    </div>
</div>

<?php //Poner contenido de cada pestaña

//Ver que tab poner activo
$activo='tabposts';
if(isset($_GET['tab']))
    $activo = $_GET['tab'];

/*******************************************************************************/

//TAB POSTS
/*******************************************************************************/
//Se indica un listado de los post
$sql=Post::find()->where(['id_usuario'=>$usuario->id_usuario, 'id_post_raiz'=>null]);

$pagination = new Pagination([
    'defaultPageSize' => 5,
	'pageParam'=>'postPage',
    'totalCount' => $sql->count(),
]);

$posts = $sql->orderBy(['fecha_post'=>SORT_DESC])
    ->offset($pagination->offset)
    ->limit($pagination->limit)
    ->all();
/*******************************************************************************/

//TAB RESPUESTAS
/*******************************************************************************/
$sqlrespuestas=Post::find()->where(['not', ['id_post_raiz'=>null]])
                        ->andWhere(['id_usuario'=>$usuario->id_usuario]);

$paginationRespuestas = new Pagination([
	'defaultPageSize' => 5,
	'pageParam'=>'respuestaPage',
	'totalCount' => $sqlrespuestas->count(),
]);

$respuestas = $sqlrespuestas->orderBy(['fecha_post'=>SORT_DESC])
	->offset($paginationRespuestas->offset)
	->limit($paginationRespuestas->limit)
	->all();

/*******************************************************************************/

//TAB Seguidores
/*******************************************************************************/
$seguidores=Seguidores::find()->where(['id_seguido'=>$usuario->id_usuario]);

$paginationSeguidores = new Pagination([
	'defaultPageSize' => 5,
	'pageParam'=>'seguidoresPage',
	'totalCount' => $seguidores->count(),
]);

$seguidoresTotal=Usuario::find()
    ->innerJoin('seguidores', 'seguidores.id_seguidor=usuario.id_usuario')
    ->where(['seguidores.id_seguido'=>$usuario->id_usuario])
    ->orderBy(['seguidores.fecha_seguimiento'=>SORT_DESC])
	->offset($paginationSeguidores->offset)
	->limit($paginationSeguidores->limit)
    ->all();

    //$seguidores->orderBy(['fecha_post'=>SORT_DESC])
/*******************************************************************************/

//TAB Siguiendo
/*******************************************************************************/
$siguiendo=Seguidores::find()->where(['id_seguidor'=>$usuario->id_usuario]);

$paginationSiguiendo = new Pagination([
	'defaultPageSize' => 5,
	'pageParam'=>'seguidosPage',
	'totalCount' => $siguiendo->count(),
]);

$siguiendoTotal=Usuario::find()
	->innerJoin('seguidores', 'seguidores.id_seguido=usuario.id_usuario')
	->where(['seguidores.id_seguidor'=>$usuario->id_usuario])
	->orderBy(['seguidores.fecha_seguimiento'=>SORT_DESC])
	->offset($paginationSiguiendo->offset)
	->limit($paginationSiguiendo->limit)
	->all();

/*******************************************************************************/

//TAB Categorias
/*******************************************************************************/
$suscripcionCategorias=SuscripcionCategoria::find()->where(['id_usuario'=>$usuario->id_usuario]);

$paginationCategorias = new Pagination([
	'defaultPageSize' => 3,
	'pageParam'=>'categoriasPage',
	'forcePageParam' => false,
	'totalCount' => $suscripcionCategorias->count(),
]);

$categorias=Categoria::find()
    ->innerJoin('suscripcion_categoria', 'suscripcion_categoria.id_categoria=categoria.id_categoria')
    ->where(['suscripcion_categoria.id_usuario'=>$usuario->id_usuario])
	->offset($paginationCategorias->offset)
	->limit($paginationCategorias->limit)
    ->all();
/*******************************************************************************/

?>
<div class="tt-wrapper">
    <div class="tt-wrapper-inner">
<?php
/*
 * [
			'label' => 'Actividad',
			'content' => $this->render("@app/views/post/listado_posts", [
                            "pagination" => $paginationActividad,
                            "posts"=>$postsActividad,
                        ]),
			'active' => strcmp($activo, 'tabactividad')==0,
		],
 * */

echo Tabs::widget([

	'items' => [

		[
			'label' => 'Posts',
			'content' => $this->render("@app/views/post/listado_posts", [
				"pagination" => $pagination,
				"posts"=>$posts,
                //'tab'=>'tabposts',
			]),
			'active' => strcmp($activo, 'tabposts')==0,
		],
		[
			'label' => 'Respuestas',
			'content' => $this->render("@app/views/post/listado_respuestas", [
				"pagination" => $paginationRespuestas,
				"respuestas"=>$respuestas,
			]),
			'active' => strcmp($activo, 'tabrespuestas')==0,
		],
		[
			'label' => $seguidores->count().' Seguidores',
			'content' => $this->render("@app/views/usuario/listado_usuarios", [
				"pagination" => $paginationSeguidores,
				"usuarios"=>$seguidoresTotal,
                "id_perfil"=>$usuario->id_usuario,
                "pag"=>"seguidores",
			]),
			'active' => strcmp($activo, 'tabseguidores')==0,
		],
		[
			'label' => $siguiendo->count().' Siguiendo',
			'content' => $this->render("@app/views/usuario/listado_usuarios", [
				"pagination" => $paginationSiguiendo,
				"usuarios"=>$siguiendoTotal,
				"id_perfil"=>$usuario->id_usuario,
				"pag"=>"siguiendo",
			]),
			'active' => strcmp($activo, 'tabsiguiendo')==0,
		],
		[
			'label' => 'Categorías',
			'content' => '<div style="margin-top: 2%">'.$this->render('@app/views/categoria/listado_categorias', [
                'categorias'=>$categorias,
                'pagination' => $paginationCategorias,
                ]).'</div>',
			'active' => strcmp($activo, 'tabcategorias')==0,
		],
	],
]);
?>
    </div>
</div>
<?php if(Yii::$app->user->id == $usuario->id_usuario): ?>
<div id="js-popup-settings" class="tt-popup-settings">
    <div class="tt-btn-col-close">
        <a href="#">
			<span class="tt-icon-title">
				<svg>
					<use xlink:href="#icon-settings_fill"></use>
				</svg>
			</span>
            <span class="tt-icon-text">
				Ajustes
			</span>
            <span class="tt-icon-close">
				<svg>
					<use xlink:href="#icon-cancel"></use>
				</svg>
			</span>
        </a>
    </div>

	<?php
	$form = ActiveForm::begin(
		[
			'options' => [
				'class' => 'form-default'
			]
		]
	);
	?>
        <div class="form-group">
			<?= $form->field($usuario, 'nombre_usuario')->textInput(['class'=>'form-control', 'id'=>'nombreUsuario',
				'placeholder'=>'Nombre', 'maxlength'=>'20'])->label('Nombre') ?>
        </div>
        <div class="form-group">
			<?= $form->field($usuario, 'apellidos_usuario')->textInput(['class'=>'form-control', 'id'=>'apellidosUsuario',
				'placeholder'=>'Apellidos', 'maxlength'=>'40'])->label('Apellidos') ?>
        </div>
        <div class="form-group">
            <label for="inputTopicTitle">Carrera</label>
			<?=
                $form->field($usuario, 'id_carrera')->dropDownList($listaCategorias,
                    ['prompt'=>'Selecciona una ...', 'class'=>'form-control'])->label(false);
			?>
        </div>
        <div class="form-group">
			<?= $form->field($usuario, 'password')->passwordInput(['class'=>'form-control', 'id'=>'passwordUsuario',
				'placeholder'=>'**********', 'maxlength'=>'40'])->label('Contraseña') ?>
        </div>

        <div class="form-group">
			<?= Html::submitButton('Guardar Usuario', ['class' => 'btn btn-secondary', 'name' => 'guardarUsuario']) ?>
        </div>
	<?php ActiveForm::end(); ?>


</div>
<?php endif; ?>