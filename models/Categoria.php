<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id_categoria
 * @property int $id_facultad
 * @property string $nombre_categoria
 * @property string $abreviatura
 * @property string $color_categoria
 *
 * @property Facultad $facultad
 * @property Post[] $posts
 * @property SuscripcionCategoria[] $suscripcionCategorias
 * @property Usuario[] $usuarios
 */
class Categoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_facultad', 'nombre_categoria', 'abreviatura', 'color_categoria'], 'required'],
            [['id_facultad'], 'integer'],
            [['nombre_categoria'], 'string', 'max' => 100],
            [['abreviatura'], 'string', 'max' => 45],
            [['color_categoria'], 'string', 'max' => 15],
            [['id_facultad'], 'exist', 'skipOnError' => true, 'targetClass' => Facultad::className(), 'targetAttribute' => ['id_facultad' => 'id_facultad']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_categoria' => 'Id Categoria',
            'id_facultad' => 'Id Facultad',
            'nombre_categoria' => 'Nombre Categoria',
            'abreviatura' => 'Abreviatura',
            'color_categoria' => 'Color Categoria',
        ];
    }

    /**
     * Gets query for [[Facultad]].
     *
     * @return \yii\db\ActiveQuery|FacultadQuery
     */
    public function getFacultad()
    {
        return $this->hasOne(Facultad::className(), ['id_facultad' => 'id_facultad']);
    }

    /**
     * Gets query for [[Posts]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Post::className(), ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[SuscripcionCategorias]].
     *
     * @return \yii\db\ActiveQuery|SuscripcionCategoriaQuery
     */
    public function getSuscripcionCategorias()
    {
        return $this->hasMany(SuscripcionCategoria::className(), ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::className(), ['id_carrera' => 'id_categoria']);
    }

    /**
     * {@inheritdoc}
     * @return CategoriaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriaQuery(get_called_class());
    }
}
