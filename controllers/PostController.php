<?php
namespace app\controllers;

use app\models\Categoria;
use app\models\PostForm;
use Yii;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use app\models\Post;

class PostController extends Controller
{
	/**
	 * Muestra listado de categorias
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		//Obtener todas las categorias de la base de datos y mandarlas como parametro
		$sql=Post::find();

		$pagination = new Pagination([
			'defaultPageSize' => 10,
			'totalCount' => $sql->count(),
		]);

		$posts = $sql->orderBy('fecha_post')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		//Se renderiza la web
		return $this->render('listado_posts', [
			'pagination' => $pagination,
			'posts'=>$posts,
		]);
	}

	public function actionTendencias()
	{
		//Obtener todas las categorias de la base de datos y mandarlas como parametro
		$sql=Post::find();

		$pagination = new Pagination([
			'defaultPageSize' => 10,
			'totalCount' => $sql->count(),
		]);

		$posts = $sql->orderBy('fecha_post')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		//Se renderiza la web
		return $this->render('listado_posts', [
			'pagination' => $pagination,
			'posts'=>$posts,
		]);
	}

	public function actionDetalle($id=null)
	{
		$post=Post::findOne($id);

		return $this->render('detalle_post', [
			'post'=>$post,
		]);
	}

	public function actionCrear()
	{
		$categorias=Categoria::find()->orderBy('nombre_categoria')->all();
		$lista=ArrayHelper::map($categorias,'id_categoria', 'nombre_categoria');

		$model= new PostForm();

		if ($model->load(Yii::$app->request->post())) {

			if ($model->validate()) {
				// form inputs are valid, do something here
				$post=new Post();
				//Guardar campos de post
				$post->id_usuario=Yii::$app->user->id;
				$post->titulo_post=$model->titulo;
				$post->tipo_post=$model->tipo;
				$post->cuerpo_post=$model->cuerpo;
				$post->id_categoria=$model->categoria;
				$post->tags_post=$model->tags;
				$post->fecha_post=date("Y-m-d H:i:s");


				if($post->save()){
					return $this->redirect(['login']);
				}else{
					print_r($post->getErrors());
				}
			}else{
			//Se renderiza la vista de crear post
			return $this->render('crear_post', [
				'categorias'=>$lista,
				'model'=>$model,
			]);
		}

		}else{
			//Se renderiza la vista de crear post
			return $this->render('crear_post', [
				'categorias'=>$lista,
				'model'=>$model,
			]);
		}
	}
}