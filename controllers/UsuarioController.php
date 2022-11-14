<?php

namespace app\controllers;
use \yii\web\Controller;

class UsuarioController extends Controller
{
    public function actionPerfil()
    {
        return $this->render('perfil');
    }

}
