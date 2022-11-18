<?php
/* @var $this yii\web\View */

use app\models\Post;
use app\models\Seguidores;
use yii\bootstrap5\Tabs;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\helpers\Url;
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
            <li><a href=""><span class="tt-color14 tt-badge">Puntos : <?= Html::encode("{$usuario->puntos}")?></span></a></li>
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
				echo '<a href="#" class="btn btn-primary">Mensaje</a>';
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

//Se indica un listado de los posts de la categoría dada
$sql=Post::find()->where(['id_usuario'=>$usuario->id_usuario]);

$pagination = new Pagination([
    'defaultPageSize' => 10,
    'totalCount' => $sql->count(),
]);

$posts = $sql->orderBy('fecha_post')
    ->offset($pagination->offset)
    ->limit($pagination->limit)
    ->all();

$seguidores=Seguidores::find()->where(['id_seguido'=>$usuario->id_usuario])->count();
$siguiendo=Seguidores::find()->where(['id_seguidor'=>$usuario->id_usuario])->count();

?>
<div class="tt-wrapper">
    <div class="tt-wrapper-inner">
<?php

echo Tabs::widget([
	'items' => [
		[
			'label' => 'Actividad',
			'content' => $this->render("@app/views/post/listado_posts", [
                            "pagination" => $pagination,
                            "posts"=>$posts,
                        ]),
			'active' => true,
		],
		[
			'label' => 'Posts',
			'content' => '',
		],
		[
			'label' => 'Respuestas',
			'content' => '',
		],
		[
			'label' => $seguidores.' Seguidores',
			'content' => '',
		],
		[
			'label' => $siguiendo.' Siguiendo',
			'content' => '',
		],
		[
			'label' => 'Categorías',
			'content' => '',
		],
	],
]);
?>
    </div>
</div>
<div id="js-popup-settings" class="tt-popup-settings">
    <div class="tt-btn-col-close">
        <a href="#">
			<span class="tt-icon-title">
				<svg>
					<use xlink:href="#icon-settings_fill"></use>
				</svg>
			</span>
            <span class="tt-icon-text">
				Settings
			</span>
            <span class="tt-icon-close">
				<svg>
					<use xlink:href="#icon-cancel"></use>
				</svg>
			</span>
        </a>
    </div>
    <form class="form-default">
        <div class="tt-form-upload">
            <div class="row no-gutter">
                <div class="col-auto">
                    <div class="tt-avatar">
                        <svg>
                            <use xlink:href="#icon-ava-d"></use>
                        </svg>
                    </div>
                </div>
                <div class="col-auto ml-auto">
                    <a href="#" class="btn btn-primary">Upload Picture</a>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="settingsUserName">Username</label>
            <input type="text" name="name" class="form-control" id="settingsUserName" placeholder="azyrusmax">
        </div>
        <div class="form-group">
            <label for="settingsUserEmail">Email</label>
            <input type="text" name="name" class="form-control" id="settingsUserEmail" placeholder="Sample@sample.com">
        </div>
        <div class="form-group">
            <label for="settingsUserPassword">Password</label>
            <input type="password" name="name" class="form-control" id="settingsUserPassword" placeholder="************">
        </div>
        <div class="form-group">
            <label for="settingsUserLocation">Location</label>
            <input type="text" name="name" class="form-control" id="settingsUserLocation" placeholder="Slovakia">
        </div>
        <div class="form-group">
            <label for="settingsUserWebsite">Website</label>
            <input type="text" name="name" class="form-control" id="settingsUserWebsite" placeholder="Sample.com">
        </div>
        <div class="form-group">
            <label for="settingsUserAbout">About</label>
            <textarea name="" placeholder="Few words about you" class="form-control" id="settingsUserAbout"></textarea>
        </div>
        <div class="form-group">
            <label for="settingsUserAbout">Notify me via Email</label>
            <div class="checkbox-group">
                <input type="checkbox" id="settingsCheckBox01" name="checkbox">
                <label for="settingsCheckBox01">
                    <span class="check"></span>
                    <span class="box"></span>
                    <span class="tt-text">When someone replies to my thread</span>
                </label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="settingsCheckBox02" name="checkbox">
                <label for="settingsCheckBox02">
                    <span class="check"></span>
                    <span class="box"></span>
                    <span class="tt-text">When someone likes my thread or reply</span>
                </label>
            </div>
            <div class="checkbox-group">
                <input type="checkbox" id="settingsCheckBox03" name="checkbox">
                <label for="settingsCheckBox03">
                    <span class="check"></span>
                    <span class="box"></span>
                    <span class="tt-text">When someone mentions me</span>
                </label>
            </div>
        </div>
        <div class="form-group">
            <a href="#" class="btn btn-secondary">Save</a>
        </div>
    </form>
</div>