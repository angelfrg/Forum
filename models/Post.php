<?php

use yii\db\ActiveRecord;

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
 */
class Post extends ActiveRecord{

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
			[['titulo_post'], 'string', 'max' => 50],
			[['cuerpo_post'], 'string', 'max' => 300],
			[['tipo_post'], 'string', 'max' => 20],
			[['tags_post'], 'string', 'max' => 50],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id_post' => 'ID Post',
			'id_post_raiz' => 'ID Post raiz',
			'id_usuario' => 'ID Usuario',
			'id_categoria' => 'ID Categoria',
			'titulo_post' => 'Titulo Post',
			'cuerpo_post' => 'Cuerpo Post',
			'tipo_post' => 'Tipo Post',
			'tags_post' => 'Tags Post',
			'vistas_post' => 'Visitas',
			'fecha_post' => 'Fecha Post',
		];
	}

}