<?php
namespace app\controllers;

use app\models\Categoria;
use app\models\PostForm;
use app\models\Usuario;
use http\Url;
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
	public function actionTendencias()
	{
		//Obtener todas las categorias de la base de datos y mandarlas como parametro
		$sql=Post::find()->where(['id_post_raiz'=>null]);

		$pagination = new Pagination([
			'defaultPageSize' => 10,
			'totalCount' => $sql->count(),
		]);

		$posts = $sql->orderBy(['fecha_post'=>SORT_DESC])
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
		//Modelo para crear respuestas
		$model= new PostForm();
		$respuestas=Post::find()->where(['id_post_raiz'=>$post->id_post])->all();

		if(!Yii::$app->user->isGuest){
			$post->incrementarVisitas();

			if ($model->load(Yii::$app->request->post())) {
				$model->categoria=$post->id_categoria;
				$model->tags=$post->tags_post;
				$model->titulo=$post->titulo_post;
				$model->tipo='RESPUESTA';

				if ($model->validate()) {

					$respuesta = new Post();
					//Guardar campos de la respuesta
					$respuesta->id_post_raiz=$post->id_post;
					$respuesta->id_usuario = Yii::$app->user->id;
					$respuesta->titulo_post = $model->titulo;
					$respuesta->tipo_post = $model->tipo;
					$respuesta->cuerpo_post = $model->cuerpo;
					$respuesta->id_categoria = $model->categoria;
					$respuesta->tags_post = $model->tags;
					$respuesta->fecha_post = date("Y-m-d H:i:s");


					if ($respuesta->save()) {
						$usuario=Usuario::findOne(Yii::$app->user->id);
						$usuario->addPuntos(20);
						return $this->goBack();
					} else {
						return $this->render('detalle_post', [
							'post' => $post,
							'respuestas'=>$respuestas,
							'model'=>$model,
						]);
					}
				} else
					return $this->render('detalle_post', [
						'post' => $post,
						'respuestas'=>$respuestas,
						'model'=>$model,
					]);
			}else{
				return $this->render('detalle_post', [
					'post' => $post,
					'respuestas'=>$respuestas,
					'model'=>$model,
				]);
			}
		}else
			return $this->render('detalle_post', [
				'post' => $post,
				'respuestas'=>$respuestas,
				'model'=>$model,
			]);

	}

	public function actionCrear()
	{
		if(!Yii::$app->user->isGuest){

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
						$usuario=Usuario::findOne(Yii::$app->user->id);
						$usuario->addPuntos(50);
						//return $this->redirect(['login']);
						return $this->goHome();
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
}