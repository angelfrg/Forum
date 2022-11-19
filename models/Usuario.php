<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id_usuario
 * @property string $nombre_usuario
 * @property string $apellidos_usuario
 * @property string $email_usuario
 * @property string $password
 * @property int $puntos
 * @property int|null $id_carrera
 * @property int $id_tipo
 * @property int|null $token
 * @property string|null $url_foto
 * @property string|null $ult_conexion
 *
 * @property Accion[] $accions
 * @property Categoria $carrera
 * @property Mensaje[] $mensajes
 * @property Mensaje[] $mensajes0
 * @property Post[] $posts
 * @property Seguidores[] $seguidores
 * @property Seguidores[] $seguidores0
 * @property SuscripcionCategoria[] $suscripcionCategorias
 * @property TipoUsuario $tipo
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			['nombre_usuario','required', 'message'=>'Debes indicar tu nombre'],
			['password','required', 'message'=>'Debes indicar tu contraseña'],
            [['puntos', 'id_carrera', 'id_tipo', 'token'], 'integer'],
            [['ult_conexion'], 'safe'],
			[['email_usuario'], 'unique'],
            [['nombre_usuario'], 'string', 'max' => 20],
            [['apellidos_usuario', 'email_usuario', 'password', 'url_foto'], 'string', 'max' => 40],
            [['id_carrera'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_carrera' => 'id_categoria']],
            [['id_tipo'], 'exist', 'skipOnError' => true, 'targetClass' => TipoUsuario::className(), 'targetAttribute' => ['id_tipo' => 'id_tipo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'Id Usuario',
            'nombre_usuario' => 'Nombre Usuario',
            'apellidos_usuario' => 'Apellidos Usuario',
            'email_usuario' => 'Email Usuario',
            'password' => 'Password',
            'puntos' => 'Puntos',
            'id_carrera' => 'Id Carrera',
            'id_tipo' => 'Id Tipo',
            'token' => 'Token',
            'url_foto' => 'Url Foto',
            'ult_conexion' => 'Ult Conexion',
        ];
    }

    /**
     * Gets query for [[Accions]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAccions()
    {
        return $this->hasMany(Accion::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Carrera]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarrera()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'id_carrera']);
    }

    /**
     * Gets query for [[Mensajes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes()
    {
        return $this->hasMany(Mensaje::className(), ['id_emisor' => 'id_usuario']);
    }

    /**
     * Gets query for [[Mensajes0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMensajes0()
    {
        return $this->hasMany(Mensaje::className(), ['id_receptor' => 'id_usuario']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Seguidores]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguidores()
    {
        return $this->hasMany(Seguidores::className(), ['id_seguido' => 'id_usuario']);
    }

    /**
     * Gets query for [[Seguidores0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSeguidores0()
    {
        return $this->hasMany(Seguidores::className(), ['id_seguidor' => 'id_usuario']);
    }

    /**
     * Gets query for [[SuscripcionCategorias]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuscripcionCategorias()
    {
        return $this->hasMany(SuscripcionCategoria::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TipoUsuario::className(), ['id_tipo' => 'id_tipo']);
    }

	public static function findIdentity($id)
	{
		return self::findOne($id);
	}

	public static function findIdentityByAccessToken($token, $type = null)
	{
		throw new \yii\base\NotSupportedException("No existe");
	}

	public function getId()
	{
		return $this->id_usuario;
	}

	public function getAuthKey()
	{
		return null;
	}

	public function validateAuthKey($authKey)
	{
		throw new \yii\base\NotSupportedException("No existe");
	}


	public static function findByEmail($email){
		return self::find()->where(['email_usuario'=>$email])->one();
	}

	public function validatePassword($password){
		return $this->password === hash("sha1", $password);
	}

	//Se actualiza la ultima conexion al foro del usuario en sesión
	public function updateUltimaConexion(){
		$this->ult_conexion=date("Y-m-d H:i:s");
		$this->save();
	}

	public function ultimaConexion(){
		return date_diff(date_create(date("Y-m-d H:i:s")),date_create($this->ult_conexion));
	}

	public function addPuntos($puntos=0){
		$this->puntos+=$puntos;
		$this->save();
	}
}
