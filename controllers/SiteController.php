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
				//Yii::$app->session['veces']=0;
				return $this->goBack();
			}else{
				//Yii::$app->session['veces'] = Yii::$app->session['veces'] + 1;
			}
        }

		if(Yii::$app->session['veces'] > 5){
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
		if(strcmp(Yii::$app->request->post()['myselect'],'logout')==0){
			return $this->actionLogout();
		}else{
			//Ir a perfil de usuario
			$usuario=Usuario::findOne(Yii::$app->user->identity->id);
			return $this->render('@app/views/usuario/perfil',['usuario'=>$usuario]);
		}

	}

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
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
			$usuario->id_tipo=1;
			$usuario->token=null;
			$usuario->url_foto=null;
			$usuario->ult_conexion= date("Y-m-d H:i:s");

			if($usuario->save()){
				return $this->redirect(['login']);
			}else{
				print_r($usuario->getErrors());
			}

		} else {
			return $this->render('registro', [
				'model' => $model,
			]);
		}
	}
}
