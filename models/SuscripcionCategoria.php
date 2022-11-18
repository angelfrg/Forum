<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "suscripcion_categoria".
 *
 * @property int $id_suscripcion
 * @property int $id_usuario
 * @property int $id_categoria
 *
 * @property Categoria $categoria
 * @property Usuario $usuario
 */
class SuscripcionCategoria extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suscripcion_categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_categoria'], 'required'],
            [['id_suscripcion', 'id_usuario', 'id_categoria'], 'integer'],
            [['id_suscripcion'], 'unique'],
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
            'id_suscripcion' => 'Id Suscripcion',
            'id_usuario' => 'Id Usuario',
            'id_categoria' => 'Id Categoria',
        ];
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery|CategoriaQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::className(), ['id_categoria' => 'id_categoria'])->inverseOf('suscripcionCategorias');
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_usuario'])->inverseOf('suscripcionCategorias');
    }

    /**
     * {@inheritdoc}
     * @return SuscripcionCategoriaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SuscripcionCategoriaQuery(get_called_class());
    }

}
