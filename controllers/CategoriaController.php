<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Categoria;
use yii\data\Pagination;

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
			'defaultPageSize' => 5,
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