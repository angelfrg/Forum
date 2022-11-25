<?php
namespace app\controllers;

use Yii;
use app\models\Usuario;

class MensajeController extends \yii\web\Controller
{
    public function actionListadochats($id=null)
    {
		//Usuarios con los que el usuario en sesión tiene mensajes
		$usuarios=Usuario::find()
			->innerJoin('mensaje', 'mensaje.id_receptor=usuario.id_usuario')
			->where(['mensaje.id_emisor'=>Yii::$app->user->id])
			->orderBy(['mensaje.fecha_mensaje'=>SORT_DESC])
			->all();

		return $this->render('chats_inicio', ['usuarios'=>$usuarios]);
    }

	public function actionMandarMensaje($id=null){

		//Usuarios con los que el usuario en sesión tiene mensajes
		$usuarios=Usuario::find()
			->innerJoin('mensaje', 'mensaje.receptor=usuario.id_usuario')
			->where(['mensaje.id_emisor'=>Yii::$app->user->id])
			->orderBy(['mensaje.fecha_mensaje'=>SORT_DESC])
			->all();

		//Cargar mensajes con ese usuario y el activo en sesión
		$mensajes=0;


		return $this->render('chats_inicio', ['id'=>$id, 'usuarios'=>$usuarios, 'mensajes'=>$mensajes]);
	}

}
