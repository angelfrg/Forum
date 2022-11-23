<?php

namespace app\controllers;
use app\models\Categoria;
use Yii;
use app\models\Seguidores;
use app\models\Usuario;
use yii\helpers\ArrayHelper;
use \yii\web\Controller;

class UsuarioController extends Controller
{
    public function actionPerfil($id=null)
    {
		$usuario=Usuario::findOne($id);

		$categorias=Categoria::find()->orderBy('nombre_categoria')->all();
		$lista=ArrayHelper::map($categorias,'id_categoria', 'nombre_categoria');

		if ($this->request->isPost && $usuario->load($this->request->post())) {

			$usuario->password=hash("sha1", $usuario->password);
			if($usuario->save())
				return $this->render('perfil',['usuario'=>$usuario, 'listaCategorias'=>$lista]);
		}

        return $this->render('perfil',['usuario'=>$usuario, 'listaCategorias'=>$lista]);
    }

	public function actionSeguir($id=null){

		//Comprobar que el usuario logeado no sigue al indicado
		$comprobar=Seguidores::find()->where(['id_seguidor'=>Yii::$app->user->identity->id, 'id_seguido'=>$id])->count();
		if($comprobar!==1){
			$seguidores=new Seguidores();
			$seguidores->id_seguidor=Yii::$app->user->identity->id;
			$seguidores->id_seguido=$id;
			$seguidores->fecha_seguimiento=date("Y-m-d H:i:s");

			if($seguidores->save())
				return $this->redirect(Yii::$app->request->referrer);
			else
				$this->goHome();
		}else
			$this->goHome();

	}

	public function actionDejarseguir($id=null){
		$comprobar=Seguidores::find()->where(['id_seguidor'=>Yii::$app->user->identity->id, 'id_seguido'=>$id]);

		//Si se siguen eliminar el registro
		if($comprobar->count()==1){
			$seguidor=Seguidores::findOne(['id_seguidor'=>Yii::$app->user->identity->id, 'id_seguido'=>$id]);

			if($seguidor){
				$seguidor->delete();
				return $this->redirect(Yii::$app->request->referrer);
			}
			else
				$this->goHome();
		}else
			$this->goHome();
	}

}
