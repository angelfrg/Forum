<?php

namespace app\models;
use \yii\base\Model;

class UsuarioRegistroForm extends Model
{
	public $nombre;
	public $apellidos;
	public $email;
	public $password;

	public function rules()
	{
		return [
			['nombre','required', 'message'=>'Debes indicar tu nombre'],
			['apellidos','required', 'message'=>'Debes indicar tus apellidos'],
			['email','required', 'message'=>'Debes indicar tu email'],
			['password','required', 'message'=>'Debes indicar una contraseña'],
			['email', 'email', 'message'=>'El email no es válido'],
		];
	}
}