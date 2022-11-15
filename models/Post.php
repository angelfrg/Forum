<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "post".
 *
 * @property int $id_post
 * @property int|null $id_post_raiz
 * @property int $id_usuario
 * @property int $id_categoria
 * @property string $titulo_post
 * @property string $cuerpo_post
 * @property string $tipo_post
 * @property string|null $tags_post
 * @property int $vistas_post
 * @property string $fecha_post
 *
 * @property Accion[] $accions
 * @property Categoria $categoria
 * @property Usuario $usuario
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_post_raiz', 'id_usuario', 'id_categoria', 'vistas_post'], 'integer'],
            [['id_usuario', 'id_categoria', 'titulo_post', 'cuerpo_post', 'tipo_post', 'fecha_post'], 'required'],
            [['fecha_post'], 'safe'],
            [['titulo_post'], 'string', 'max' => 50],
            [['cuerpo_post'], 'string', 'max' => 550],
            [['tipo_post'], 'string', 'max' => 20],
            [['tags_post'], 'string', 'max' => 30],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::className(), 'targetAttribute' => ['id_categoria' => 'id_categoria']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'id_post_raiz' => 'Id Post Raiz',
            'id_usuario' => 'Id Usuario',
            'id_categoria' => 'Id Categoria',
            'titulo_post' => 'Titulo Post',
            'cuerpo_post' => 'Cuerpo Post',
            'tipo_post' => 'Tipo Post',
            'tags_post' => 'Tags Post',
            'vistas_post' => 'Vistas Post',
            'fecha_post' => 'Fecha Post',
        ];
    }

    /**
     * Gets query for [[Accions]].
     *
     * @return \yii\db\ActiveQuery|AccionQuery
     */
    public function getAccions()
    {
        return $this->hasMany(Accion::className(), ['id_post' => 'id_post']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario']);
    }

    /**
     * {@inheritdoc}
     * @return PostQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PostQuery(get_called_class());
    }

	public function obtenerListaTags(){
		return explode(",", $this->tags_post);
	}
}
