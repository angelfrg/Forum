<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Categoria;

/**
 * CategoriasSearch represents the model behind the search form of `app\models\Categoria`.
 */
class CategoriasSearch extends Categoria
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_categoria', 'id_facultad'], 'integer'],
            [['nombre_categoria', 'abreviatura', 'color_categoria'], 'safe'],
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
        $query = Categoria::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			/*'pagination'=>[
				'defaultPageSize' => 6,
				'totalCount' => $query->count(),
			],*/
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'nombre_categoria', $this->nombre_categoria])
            ->andFilterWhere(['like', 'abreviatura', $this->abreviatura])
            ->andFilterWhere(['like', 'color_categoria', $this->color_categoria]);

		$query->orderBy(['id_categoria'=>SORT_ASC]);

        return $dataProvider;
    }
}
