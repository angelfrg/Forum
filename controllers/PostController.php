<?php
namespace app\controllers;

use app\models\Accion;
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

	public function actionDetalle($id=null, $orden=null)
	{
		$post=Post::findOne($id);
		//Modelo para crear respuestas
		$model= new PostForm();

		if(isset($orden)){
			if(strcmp($orden, 'like')){

				$respuestas=Post::find()->where(['id_post_raiz'=>$post->id_post])->all();

			}elseif (strcmp($orden, 'recientes')){
				$respuestas=Post::find()->where(['id_post_raiz'=>$post->id_post])->orderBy(['fecha_post'=>SORT_ASC])->all();
			}else
				$respuestas=Post::find()->where(['id_post_raiz'=>$post->id_post])->orderBy(['fecha_post'=>SORT_ASC])->all();
		}else
			$respuestas=Post::find()->where(['id_post_raiz'=>$post->id_post])->orderBy(['fecha_post'=>SORT_ASC])->all();

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
						$respuestas=Post::find()->where(['id_post_raiz'=>$post->id_post])->orderBy(['fecha_post'=>SORT_ASC])->all();
						return $this->render('detalle_post', [
							'post' => $post,
							'respuestas'=>$respuestas,
							'model'=>$model,
						]);
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

	public function actionLike($id=null){
		if(!Yii::$app->user->isGuest){
			//Comprobar si tiene like del usuario en sesión
			$comprobar=Accion::find()->where(['id_usuario'=>Yii::$app->user->identity->id, 'id_post'=>$id])->count();

			//Si no hay una acción para este post, se crea
			if($comprobar !=1){
				$nuevaAccion=new Accion();
				$nuevaAccion->id_post=$id;
				$nuevaAccion->id_usuario=Yii::$app->user->identity->id;
				$nuevaAccion->like=1;
				$nuevaAccion->dislike=0;

				if($nuevaAccion->save())
					return $this->redirect(Yii::$app->request->referrer);
				else
					return $this->redirect(Yii::$app->request->referrer);
			}
			else{
				//Si ya existe la acción, se mira si tiene like
				$accion=Accion::findOne(['id_usuario'=>Yii::$app->user->identity->id, 'id_post'=>$id]);

				if($accion->like!=1){
					//Dar like
					$accion->updateLike();
				}
				return $this->redirect(Yii::$app->request->referrer);
			}
		}
	}

	public function actionDislike($id=null){
		if(!Yii::$app->user->isGuest){
			//Comprobar si tiene like del usuario en sesión
			$comprobar=Accion::find()->where(['id_usuario'=>Yii::$app->user->identity->id, 'id_post'=>$id])->count();

			//Si no hay una acción para este post, se crea
			if($comprobar !=1){
				$nuevaAccion=new Accion();
				$nuevaAccion->id_post=$id;
				$nuevaAccion->id_usuario=Yii::$app->user->identity->id;
				$nuevaAccion->like=0;
				$nuevaAccion->dislike=1;

				if($nuevaAccion->save())
					return $this->redirect(Yii::$app->request->referrer);
				else
					return $this->redirect(Yii::$app->request->referrer);
			}
			else{
				//Si ya existe la acción, se mira si tiene dislike
				$accion=Accion::findOne(['id_usuario'=>Yii::$app->user->identity->id, 'id_post'=>$id]);

				if($accion->dislike!=1){
					//Dar dislike
					$accion->updatedisLike();
				}
				return $this->redirect(Yii::$app->request->referrer);
			}
		}
	}
}