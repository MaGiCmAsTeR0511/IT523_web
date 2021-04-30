<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\KursVeranstaltungen;

/**
 * KursVeranstaltungenSearch represents the model behind the search form of `app\models\KursVeranstaltungen`.
 */
class KursVeranstaltungenSearch extends KursVeranstaltungen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_kv', 'sigid_kv'], 'integer'],
            [['titel_kv', 'von_kv', 'bis_kv', 'beschreibung_kv', 'sigdate_kv'], 'safe'],
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
        $query = KursVeranstaltungen::find();

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
            'id_kv' => $this->id_kv,
            'von_kv' => $this->von_kv,
            'bis_kv' => $this->bis_kv,
            'sigdate_kv' => $this->sigdate_kv,
            'sigid_kv' => $this->sigid_kv,
        ]);

        $query->andFilterWhere(['like', 'titel_kv', $this->titel_kv])
            ->andFilterWhere(['like', 'beschreibung_kv', $this->beschreibung_kv]);

        return $dataProvider;
    }
}
