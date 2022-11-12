<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "facultad".
 *
 * @property int $id_facultad
 * @property string $nombre_facultad
 * @property string $abreviatura
 * @property string $calle_facultad
 * @property string $ciudad_facultad
 *
 * @property Categoria[] $categorias
 */
class Facultad extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'facultad';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_facultad', 'abreviatura', 'calle_facultad', 'ciudad_facultad'], 'required'],
            [['nombre_facultad', 'calle_facultad'], 'string', 'max' => 70],
            [['abreviatura'], 'string', 'max' => 45],
            [['ciudad_facultad'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_facultad' => 'Id Facultad',
            'nombre_facultad' => 'Nombre Facultad',
            'abreviatura' => 'Abreviatura',
            'calle_facultad' => 'Calle Facultad',
            'ciudad_facultad' => 'Ciudad Facultad',
        ];
    }

    /**
     * Gets query for [[Categorias]].
     *
     * @return \yii\db\ActiveQuery|CategoriaQuery
     */
    public function getCategorias()
    {
        return $this->hasMany(Categoria::className(), ['id_facultad' => 'id_facultad']);
    }

    /**
     * {@inheritdoc}
     * @return FacultadQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FacultadQuery(get_called_class());
    }
}
