<?php

namespace app\modules\admin\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Ingredientshasprovider;

/**
 * IngredientshasproviderSearch represents the model behind the search form of `app\modules\admin\models\Ingredientshasprovider`.
 */
class IngredientshasproviderSearch extends Ingredientshasprovider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ingredients_id', 'provider_id'], 'integer'],
            [['cost'], 'number'],
            [['comment'], 'safe'],
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
        $query = Ingredientshasprovider::find();

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
            'ingredients_id' => $this->ingredients_id,
            'provider_id' => $this->provider_id,
            'cost' => $this->cost,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
}
