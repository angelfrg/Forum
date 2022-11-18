<?php
namespace app\controllers;

use app\models\SuscripcionCategoria;
use Yii;
use yii\web\Controller;
use app\models\Categoria;
use yii\data\Pagination;
use app\models\Post;

class CategoriaController extends Controller
{
	/**
	 * Muestra listado de categorias
	 *
	 * @return string
	 */
	public function actionIndex()
	{
		//Obtener todas las categorias de la base de datos y mandarlas como parametro
		$sql=Categoria::find();

		$pagination = new Pagination([
			'defaultPageSize' => 6,
			'totalCount' => $sql->count(),
		]);

		$categorias = $sql->orderBy('id_categoria')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		//Se renderiza la web
		return $this->render('listado_categorias', [
			'categorias'=>$categorias,
			'pagination' => $pagination,
		]);
	}

	/**
	 * Muestra listado de posts sobre una categoria
	 *
	 * @return string
	 */
	public function actionUna(){

		if(isset($_GET['id'])){
			$id= (isset($_GET['id']) ? $_GET['id'] : (isset($_POST['id']) ? $_POST['id'] : null));

			$categoria=Categoria::findOne($id);
			if(isset($categoria)){
				$totalPosts=Post::find()
					->where(['id_categoria'=>$categoria->id_categoria])
					->count();


				//Se renderiza la web
				return $this->render('una_categoria', [
					'categoria'=>$categoria,
					'totalPosts'=>$totalPosts,
				]);
			}else{
				$this->actionIndex();
			}
		}else{
			$this->actionIndex();
		}

	}

	public function actionSuscripciones($id=null){

		$idsCategorias=SuscripcionCategoria::find()->where(['id_usuario'=>$id]);
		//Obtener todas las categorias de la base de datos y mandarlas como parametro
		$sql=Categoria::find()->joinWith('suscripcion_categoria',true, 'INNER JOIN');

		$pagination = new Pagination([
			'defaultPageSize' => 6,
			'totalCount' => $sql->count(),
		]);

		$categorias = $sql->orderBy('id_categoria')
			->offset($pagination->offset)
			->limit($pagination->limit)
			->all();

		//Se renderiza la web
		return $this->render('listado_categorias', [
			'categorias'=>$categorias,
			'pagination' => $pagination,
		]);
	}

}