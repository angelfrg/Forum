<?php

namespace app\controllers;
use app\models\Usuario;
use \yii\web\Controller;

class UsuarioController extends Controller
{
    public function actionPerfil($id=null)
    {
		$usuario=Usuario::findOne($id);
        return $this->render('perfil',['usuario'=>$usuario]);
    }

}
