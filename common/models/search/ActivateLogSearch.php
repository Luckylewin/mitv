<?php

namespace common\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ActivateLog;

/**
 * ActivateLogSearch represents the model behind the search form about `common\models\ActivateLog`.
 */
class ActivateLogSearch extends ActivateLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'uid','expire_time', 'duration', 'oid'], 'integer'],
            [['appname', 'is_charge'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
    public function search($params,$condition = null)
    {
        $query = ActivateLog::find();

        if ($condition) {
            $query->where($condition);
        }
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'created_time' => 'desc',
                    'is_deal' => 'desc'
                ]
            ]
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
            'uid' => $this->uid,
            'created_time' => $this->created_time,
            'expire_time' => $this->expire_time,
            'duration' => $this->duration,
            'oid' => $this->oid,
        ]);

        $query->andFilterWhere(['like', 'appname', $this->appname])
            ->andFilterWhere(['like', 'is_charge', $this->is_charge]);

        return $dataProvider;
    }
}
