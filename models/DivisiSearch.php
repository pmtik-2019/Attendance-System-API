<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Divisi;

/**
 * DivisiSearch represents the model behind the search form of `app\models\Divisi`.
 */
class DivisiSearch extends Divisi
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_divisi', 'nama_divisi'], 'safe'],
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
        $query = Divisi::find();

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
        $query->andFilterWhere(['like', 'kode_divisi', $this->kode_divisi])
            ->andFilterWhere(['like', 'nama_divisi', $this->nama_divisi]);

        return $dataProvider;
    }
}
