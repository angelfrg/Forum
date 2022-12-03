<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Post;

/**
 * PostsSearch represents the model behind the search form of `app\models\Post`.
 */
class PostsSearch extends Post
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_post', 'id_post_raiz', 'id_usuario', 'id_categoria', 'vistas_post'], 'integer'],
            [['titulo_post', 'cuerpo_post', 'tipo_post', 'tags_post', 'fecha_post'], 'safe'],
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
        $query = Post::find()->where(['id_post_raiz'=>null]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination'=>[
				'defaultPageSize' => 10,
				'totalCount' => $query->count(),
			],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'titulo_post', $this->titulo_post]);

		$query->orderBy(['fecha_post'=>SORT_DESC]);

        return $dataProvider;
    }
}
