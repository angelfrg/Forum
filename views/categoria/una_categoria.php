<?php
namespace app\views\categoria;
use app\models\Post;
use app\models\SuscripcionCategoria;
use Yii;
use yii\data\Pagination;
use yii\helpers\Html;
use yii\widgets\LinkPager;
use yii\helpers\Url;
?>
<div class="tt-catSingle-title">
	<div class="tt-innerwrapper tt-row">
		<div class="tt-col-left">
			<ul class="tt-list-badge">
				<li><a href="#"><span class="tt-badge" style="background-color: <?php echo $categoria->color_categoria;?>"><?= Html::encode("{$categoria->abreviatura}")?></span></a></li>
			</ul>
		</div>
		<div class="ml-right tt-col-right">
			<div class="tt-col-item">
				<h2 class="tt-value">Posts - <?= $totalPosts?></h2>
			</div>
			<div class="tt-col-item">
                <?php
                    if(!Yii::$app->user->isGuest) {
                    $comprobar = SuscripcionCategoria::find()->where(['id_usuario' => Yii::$app->user->identity->id, 'id_categoria' => $categoria->id_categoria])->count();

                        if ($comprobar !== 1)
                            echo '<a href="' . Url::toRoute(['categoria/suscribir', 'id' => $categoria->id_categoria]) . '" class="tt-btn-icon">
                                <i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                            </a>';
                        else
                            echo '<a href="' . Url::toRoute(['categoria/desuscribir', 'id' => $categoria->id_categoria]) . '" class="tt-btn-icon">
                                <i class="tt-icon" style="fill: red"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                            </a>';
                        }
                    else
                        echo '<a href="' . Url::toRoute(['site/login']) . '" class="tt-btn-icon">
                            <i class="tt-icon"><svg><use xlink:href="#icon-favorite"></use></svg></i>
                        </a>';
                ?>
			</div>

		</div>
	</div>
	<div class="tt-innerwrapper">
		<?= Html::encode("{$categoria->nombre_categoria}")?>
	</div>
	<div class="tt-innerwrapper">
		<h6 class="tt-title">Tags relacionados</h6>
		<ul class="tt-list-badge">
			<?php //Tags de posts sobre la categoria
			$postsTags=Post::find()->where(['id_categoria'=>$categoria->id_categoria,'id_post_raiz'=>null ])
				->orderBy(['fecha_post'=>SORT_DESC])->limit(8)->all();

			$tags=array();
			if(isset($postsTags)){
				foreach ($postsTags as $postTag)
					$tags = array_merge($tags, $postTag->obtenerListaTags());
			}

			if(!empty($tags)){
				foreach ($tags as $tag){
					if($tag!="")
						echo '<li><a href="#"><span class="tt-badge">'.$tag.'</span></a></li>';
				}
			}else
				echo '<li>No hay tags por el momento...</li>';
			?>
		</ul>
	</div>
</div>
<?php
    //Se indica un listado de los posts de la categoría dada
    $sql=Post::find()->where(['id_categoria'=>$categoria->id_categoria, 'id_post_raiz'=>null]);

    $pagination = new Pagination([
        'defaultPageSize' => 10,
        'totalCount' => $sql->count(),
    ]);

    $posts = $sql->orderBy(['fecha_post'=>SORT_DESC])
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    //Se renderiza la web
    echo $this->render('@app/views/post/listado_posts', [
        'pagination' => $pagination,
        'posts'=>$posts,
        'isTab'=>true,
    ]);
?>