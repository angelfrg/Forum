<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Usuario;

/**
 * UsuarioAdminSearch represents the model behind the search form of `app\models\Usuario`.
 */
class UsuarioAdminSearch extends Usuario
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_usuario', 'puntos', 'id_carrera', 'id_tipo'], 'integer'],
            [['nombre_usuario', 'apellidos_usuario', 'email_usuario', 'password', 'ult_conexion'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Usuario::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_usuario' => $this->id_usuario,
            'puntos' => $this->puntos,
            'id_carrera' => $this->id_carrera,
            'id_tipo' => $this->id_tipo,
            'ult_conexion' => $this->ult_conexion,
        ]);

        $query->andFilterWhere(['like', 'nombre_usuario', $this->nombre_usuario])
            ->andFilterWhere(['like', 'apellidos_usuario', $this->apellidos_usuario])
            ->andFilterWhere(['like', 'email_usuario', $this->email_usuario])
            ->andFilterWhere(['like', 'password', $this->password]);

        return $dataProvider;
    }
}
