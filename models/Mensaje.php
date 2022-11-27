<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mensaje".
 *
 * @property int $id_emisor
 * @property int $id_receptor
 * @property string $cuerpo_mensaje
 * @property int $estado_mensaje
 * @property string $fecha_mensaje
 *
 * @property Usuario $emisor
 * @property Usuario $receptor
 */
class Mensaje extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensaje';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_emisor', 'id_receptor', 'cuerpo_mensaje', 'estado_mensaje'], 'required'],
            [['id_emisor', 'id_receptor', 'estado_mensaje'], 'integer'],
            [['fecha_mensaje'], 'safe'],
            [['cuerpo_mensaje'], 'string', 'max' => 100],
            [['id_emisor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_emisor' => 'id_usuario']],
            [['id_receptor'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_receptor' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_emisor' => 'Id Emisor',
            'id_receptor' => 'Id Receptor',
            'cuerpo_mensaje' => 'Cuerpo Mensaje',
            'estado_mensaje' => 'Estado Mensaje',
            'fecha_mensaje' => 'Fecha Mensaje',
        ];
    }

    /**
     * Gets query for [[Emisor]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getEmisor()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_emisor'])->inverseOf('mensajes');
    }

    /**
     * Gets query for [[Receptor]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getReceptor()
    {
        return $this->hasOne(Usuario::className(), ['id_usuario' => 'id_receptor'])->inverseOf('mensajes0');
    }

    /**
     * {@inheritdoc}
     * @return MensajeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MensajeQuery(get_called_class());
    }

	public function count_unseen_message($id){
		$mensajes=Mensaje::find()
							->where(['id_emisor'=>$id, 'id_receptor'=>Yii::$app->user->id, 'estado_mensaje'=>1])
							->count();
		return $mensajes;
	}

	public function updateEstado(){
		$this->estado_mensaje=0;
		$this->save();
	}

	public function obtenerUltimoMensaje($id=null){
		$ultimoMensaje=Mensaje::find()
			->orderBy(['mensaje.fecha_mensaje'=>SORT_DESC])
			->where(['id_emisor'=>Yii::$app->user->id, 'id_receptor'=>$id])
			->orWhere(['id_emisor'=>$id, 'id_receptor'=>Yii::$app->user->id])
			->one();
		return $ultimoMensaje;
	}
}
