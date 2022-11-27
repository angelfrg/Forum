<?php

namespace app\controllers;
use app\models\Categoria;
use app\models\Mensaje;
use Yii;
use app\models\Seguidores;
use app\models\Usuario;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
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

	public function actionFetchuser(){
		$usuarios=Usuario::find()
			->innerJoin('mensaje', 'mensaje.id_receptor=usuario.id_usuario OR usuario.id_usuario=mensaje.id_emisor')
			->where(['mensaje.id_emisor'=>Yii::$app->user->id])
			->orWhere(['mensaje.id_receptor'=>Yii::$app->user->id])
			->andWhere(['not', ['usuario.id_usuario'=>Yii::$app->user->id]])
			->orderBy(['mensaje.fecha_mensaje'=>SORT_DESC])
			->all();

		$output = '';

		foreach($usuarios as $usuario)
		{
			$ultimoMensaje=(new Mensaje)->obtenerUltimoMensaje($usuario->id_usuario);
			if($ultimoMensaje->id_emisor == Yii::$app->user->id)
				$emisor='Yo: ';
			else
				$emisor=$usuario->nombre_usuario.': ';

			if($ultimoMensaje->count_unseen_message($usuario->id_usuario) > 0)
				$nuevos=' (Nuevo mensaje)';
			else
				$nuevos='';

			$output .= '<a href='.Url::toRoute(['mensaje/listadochats', 'id'=>$usuario->id_usuario]).' class="tt-item start_chat">
					<div class="tt-col-avatar">
						<svg class="tt-icon">
							<use xlink:href="#icon-ava-'.strtolower($usuario->nombre_usuario[0]).'"></use>
						</svg>
					</div>
					<div class="tt-col-description">
						<h4 class="tt-title"><span>'.Html::encode("{$usuario->nombre_usuario}").' '.$nuevos.'</span> <span class="time">'.date_create($ultimoMensaje->fecha_mensaje)->format("d/m/Y").'</span></h4>
						<div class="tt-message">'.Html::encode("{$emisor}").Html::encode("{$ultimoMensaje->cuerpo_mensaje}").'</div>
					</div>
				</a>';
		}

		return $output;
	}

	public function actionActualizaractividad(){
		$usuario=Usuario::findOne(['id_usuario'=>Yii::$app->user->id]);
		$usuario->updateUltimaConexion();
		return true;
	}

	public function actionIsonline($id=null){
		$status = '';
		$current_timestamp = strtotime(date("Y-m-d H:i:s") . '- 10 second');
		$current_timestamp = date('Y-m-d H:i:s', $current_timestamp);
		$usuario=Usuario::findOne(['id_usuario'=>$id]);

		if($usuario->ult_conexion > $current_timestamp)
		{
			$status = '<span>En linea</span>';
		}
		else
		{
			$status = '<span>Desconectado</span>';
		}

		return $status;
	}

}
