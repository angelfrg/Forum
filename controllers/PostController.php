<?php

namespace app\controllers;

use Yii;
use yii\data\Pagination;
use yii\web\Controller;

class PostController extends Controller
{
	/**
	 * Muestra listado de categorias
	 *
	 * @return string
	 */
	public function actionIndex()
	{

		//Se renderiza la web
		return $this->render('listado_posts', [

		]);
	}

	public function actionTendencias()
	{
		//Se renderiza la web
		return $this->render('listado_posts', [

		]);
	}

	public function actionCrear()
	{
		//Se renderiza la web
		return $this->render('crear_post', [

		]);
	}
}