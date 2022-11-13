<?php
namespace app\controllers;

use app\models\Categoria;
use app\models\PostForm;
use Yii;
use yii\data\Pagination;
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

	public function actionCrear()
	{
		$categorias=Categoria::find()->orderBy('nombre_categoria')->all();

		$model= new Post();

		if ($model->load(Yii::$app->request->post())) {
			if ($model->validate()) {
				// form inputs are valid, do something here
				//return $model;
			}

		}else{
			//Se renderiza la vista de crear post
			return $this->render('crear_post', [
				'categorias'=>$categorias,
				'model'=>$model,
			]);
		}
	}
}