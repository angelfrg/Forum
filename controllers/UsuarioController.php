<?php

namespace app\controllers;
use Yii;
use app\models\Seguidores;
use app\models\Usuario;
use \yii\web\Controller;

class UsuarioController extends Controller
{
    public function actionPerfil($id=null)
    {
		$usuario=Usuario::findOne($id);
        return $this->render('perfil',['usuario'=>$usuario]);
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
