<?php
namespace app\controllers;

use app\models\Mensaje;
use Yii;
use app\models\Usuario;

class MensajeController extends \yii\web\Controller
{
    public function actionListadochats($id=null)
    {
		//Usuarios con los que el usuario en sesión tiene mensajes
		/*$usuarios=Usuario::find()
			->innerJoin('mensaje', 'mensaje.id_receptor=usuario.id_usuario')
			->where(['mensaje.id_emisor'=>Yii::$app->user->id])
			->orderBy(['mensaje.fecha_mensaje'=>SORT_DESC])
			->all();*/

		return $this->render('chats_inicio');
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

	public function actionFetchuserchathistory($id=null){

		$mensajes=Mensaje::find()
			->orderBy(['mensaje.fecha_mensaje'=>SORT_DESC])
			->where(['id_emisor'=>Yii::$app->user->id, 'id_receptor'=>$id])
			->orWhere(['id_emisor'=>$id, 'id_receptor'=>Yii::$app->user->id])
			->all();

		$mensajechat='';
		foreach ($mensajes as $mensaje){
			$usuario=Usuario::findOne(['id_usuario'=>$mensaje->id_emisor]);
			$fecha=date_create($mensaje->fecha_mensaje)->format("H:i:s d/m/Y");
			$mensajechat.='<div class="tt-item">
					<div class="tt-col-avatar">
						<svg class="tt-icon">
							<use xlink:href="#icon-ava-'.strtolower($usuario->nombre_usuario[0]).'"></use>
						</svg>
					</div>
					<div class="tt-col-description">
						<h4 class="tt-title" style="font-size: 16px; font-weight: bold; color: black">'.$usuario->nombre_usuario.' <span class="time">'.$fecha.'</span></h4>
						<p>'.$mensaje->cuerpo_mensaje.'</p>
					</div>
        		</div>';
		}

		//Actualizar estado de mensajes de 1 a 0 (Marcarlos como leidos) TO DO
		$mensajesActualizar=Mensaje::find()->where(['id_emisor'=>$id, 'id_receptor'=>Yii::$app->user->id, 'estado_mensaje'=>1])->all();

		foreach ($mensajesActualizar as $msg){
			$msg->updateEstado();
		}

		return $mensajechat;
	}

	public function actionInsertarmensaje($id=null, $cuerpo_mensaje=null){
		$mensaje= new Mensaje();

		$mensaje->id_emisor=Yii::$app->user->id;
		$mensaje->id_receptor=$id;
		$mensaje->cuerpo_mensaje=$cuerpo_mensaje;
		$mensaje->estado_mensaje=1;
		$mensaje->fecha_mensaje=date("Y-m-d H:i:s");

		if ($mensaje->validate()) {
			if($mensaje->save()){
				echo $this->actionFetchuserchathistory($id);
			}
			echo $this->actionFetchuserchathistory($id);
		}
		echo $this->actionFetchuserchathistory($id);
	}

}
