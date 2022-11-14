<?php

namespace app\models;
use \yii\base\Model;

class PostForm extends Model
{
	public $titulo;
	public $cuerpo;
	public $categoria;
	public $tags;

	public function rules()
	{
		return [
			['titulo','required', 'message'=>'Debes indicar un título'],
			['cuerpo','required', 'message'=>'Debes describir tu tema'],
			['categoria','required', 'message'=>'Debes indicar una categoría'],
		];
	}
}