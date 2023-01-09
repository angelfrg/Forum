<?php

namespace app\controllers;

use app\models\Usuario;
use app\models\UsuarioRegistroForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post())) {
			if($model->login()){
				$usuario=Usuario::findOne(Yii::$app->user->identity->id);
				$usuario->updateUltimaConexion();
				Yii::$app->session->set('veces',0);
				return $this->goBack();
			}else{
				Yii::$app->session->set('veces',Yii::$app->session->get('veces')+1);
			}
        }

		if(Yii::$app->session->get('veces') > 5){
			return $this->render('error', [
				'model' => $model,
				'message' => "Número máximo de intentos alcanzado",
				'name' => "Bloqueado"
			]);

		}

        //$model->password = '';
		//Yii::$app->layout='main';		//Cambiar layout main por principal
        return $this->render('login', [
            'model' => $model,
        ]);
    }

	/**
	 * User menu action.
	 *
	 * @return Response
	 */
	public function actionMenu()
	{
		if(Yii::$app->request->post()){
			if(strcmp(Yii::$app->request->post()['myselect'],'logout')==0){
				return $this->actionLogout();
			}else if(strcmp(Yii::$app->request->post()['myselect'],'perfil')==0){
				//Ir a perfil de usuario
				$this->redirect(array('usuario/perfil', 'id'=>Yii::$app->user->identity->id));
			}else if(strcmp(Yii::$app->request->post()['myselect'],'mensajes')==0){
				$this->redirect(array('mensaje/listadochats'));
			}else if(strcmp(Yii::$app->request->post()['myselect'],'admin')==0){
				if(!Yii::$app->user->isGuest && Usuario::esRolAdmin(Yii::$app->user->id))
					$this->redirect(array(''));
			}
		}else
			$this->goHome();
	}

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
		$usuario=Usuario::findOne(Yii::$app->user->identity->id);
		$usuario->updateUltimaConexion();
		//Yii::$app->session['veces'] =0;
        Yii::$app->user->logout();

        return $this->goHome();
    }

	/**
	 * Register action.
	 *
	 * @return Response|string
	 */
	public function actionRegistro()
	{
		$model = new UsuarioRegistroForm();

		if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			// form inputs are valid, do something here
			$usuario=new Usuario();

			$usuario->nombre_usuario=$model->nombre;
			$usuario->apellidos_usuario=$model->apellidos;
			$usuario->email_usuario= $model->email;
			$usuario->password= hash("sha1", $model->password);
			$usuario->puntos=0;
			$usuario->id_carrera=null;
			$usuario->id_tipo=3;		//Tipo estudiante
			$usuario->token=null;
			$usuario->url_foto=null;
			$usuario->ult_conexion= date("Y-m-d H:i:s");

			if($usuario->save()){
				return $this->redirect(['login']);
			}else{
				$model->email=null;
				return $this->render('registro', [
					'model' => $model,
				]);
			}

		} else {
			return $this->render('registro', [
				'model' => $model,
			]);
		}
	}
}
