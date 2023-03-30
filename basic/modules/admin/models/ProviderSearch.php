<?php
namespace app\modules\admin\models;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\admin\models\Provider;
/**
 * ProviderSearch represents the model behind the search form of `app\modules\admin\models\Provider`.
 */
class ProviderSearch extends Provider
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name_provider', 'phone_number', 'email', 'comment'], 'safe'],
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
        $query = Provider::find();
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
            'id' => $this->id,
        ]);
        $query->andFilterWhere(['like', 'name_provider', $this->name_provider])
            ->andFilterWhere(['like', 'phone_number', $this->phone_number])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'comment', $this->comment]);
        return $dataProvider;
    }
}
