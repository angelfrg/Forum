<?php
namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "categoria".
 *
 * @property int $id_categoria
 * @property int $id_facultad
 * @property string $nombre_categoria
 * @property string $abreviatura
 * @property string $color_categoria
 */
class Categoria extends ActiveRecord{

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
			[['nombre_categoria'], 'string'],
			[['abreviatura'], 'string', 'max' => 15],
			[['nombre'], 'string', 'max' => 7],
		];
	}

	/**
	 * {@inheritdoc}
	 */
	public function attributeLabels()
	{
		return [
			'id_categoria' => 'ID Categoria',
			'id_facultad' => 'ID Facultad',
			'nombre_categoria' => 'Nombre Categoria',
			'abreviatura' => 'Abreviatura',
			'color_categoria' => 'Codigo color',
		];
	}
}