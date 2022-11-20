<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "accion".
 *
 * @property int $id_accion
 * @property int $id_usuario
 * @property int $id_post
 * @property int $like
 * @property int $dislike
 * @property string|null $otro
 *
 * @property Post $post
 * @property Usuario $usuario
 */
class Accion extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'accion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'id_post', 'like', 'dislike'], 'required'],
            [['id_usuario', 'id_post', 'like', 'dislike'], 'integer'],
            [['otro'], 'string', 'max' => 45],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => Post::className(), 'targetAttribute' => ['id_post' => 'id_post']],
            [['id_usuario'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::className(), 'targetAttribute' => ['id_usuario' => 'id_usuario']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_accion' => 'Id Accion',
            'id_usuario' => 'Id Usuario',
            'id_post' => 'Id Post',
            'like' => 'Like',
            'dislike' => 'Dislike',
            'otro' => 'Otro',
        ];
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery|PostQuery
     */
    public function getPost()
    {
        return $this->hasOne(Post::className(), ['id_post' => 'id_post']);
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
     * @return AccionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AccionQuery(get_called_class());
    }

	public function updateLike(){
		$this->like=1;
		$this->dislike=0;
		$this->save();
	}

	public function updatedisLike(){
		$this->like=0;
		$this->dislike=1;
		$this->save();
	}
}
