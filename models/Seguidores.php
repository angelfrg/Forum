<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "seguidores".
 *
 * @property int $id_seguidor
 * @property int $id_seguido
 * @property string $fecha_seguimiento
 *
 * @property Usuario $seguido
 * @property Usuario $seguidor
 */
class Seguidores extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'seguidores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_seguidor', 'id_seguido', 'fecha_seguimiento'], 'required'],
            [['id_seguidor', 'id_seguido'], 'integer'],
            [['fecha_seguimiento'], 'safe'],
            [['id_seguido'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_seguido' => 'id_usuario']],
            [['id_seguidor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_seguidor' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_seguidor' => 'Id Seguidor',
            'id_seguido' => 'Id Seguido',
            'fecha_seguimiento' => 'Fecha Seguimiento',
        ];
    }

    /**
     * Gets query for [[Seguido]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getSeguido()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_seguido'])->inverseOf('seguidores');
    }

    /**
     * Gets query for [[Seguidor]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getSeguidor()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_seguidor'])->inverseOf('seguidores0');
    }

    /**
     * {@inheritdoc}
     * @return SeguidoresQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SeguidoresQuery(get_called_class());
    }
}
