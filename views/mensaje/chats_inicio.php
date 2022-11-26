<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Mensaje;
use yii\widgets\Pjax;
?>

<div class="tt-messages-layout">
    <div class="row no-gutters">
        <div class="col-md-4 tt-aside" id="js-aside">
            <a href="#" class="tt-title-aside">
                <h2 class="tt-title">
                    Mensajes
                </h2>
                <i onclick="location.href='<?= Url::toRoute(['mensaje/listadochats']);?>';" class="tt-icon">
                    <svg class="icon">
                        <use xlink:href="#icon-pencil"></use>
                    </svg>
                </i>
            </a>
            <div class="tt-all-avatar">
                <div class="tt-box-search">
                    <input class="tt-input" type="text" placeholder="Buscar Mensajes">
                    <a href="#" class="tt-btn-input">
                        <svg>
                            <use xlink:href="#icon-search"></use>
                        </svg>
                    </a>
                </div>

				<?php //Lista de usuarios con refresco por ajax?>
                <div id="user_details" class="tt-list-avatar js-init-scroll">

                </div>

            </div>
        </div>

        <?php
            //$model=new Mensaje();
            if(isset($_GET['id']) && $_GET['id']!=Yii::$app->user->id){
                $usuarioChat=\app\models\Usuario::findOne(['id_usuario'=>$_GET['id']]);
				echo $this->render('chat_usuario', ['usuarioChat'=>$usuarioChat]);
            }
            else
				echo $this->render('crear_chat');

        ?>

    </div>
</div>
