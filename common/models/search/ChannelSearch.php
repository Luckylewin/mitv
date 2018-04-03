<?php

namespace common\models\search;

use common\models\AppToChannel;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Channel;
use yii\helpers\ArrayHelper;

/**
 * ChannelSearch represents the model behind the search form about `common\models\Channel`.
 */
class ChannelSearch extends Channel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sort', 'pid', 'area_id'], 'integer'],
            [['name', 'app_id'], 'safe'],
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
    public function search($params, $condition = null)
    {
        $query = Channel::find();
        if ($condition) {
            $query->where($condition);
        }
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
            'sort' => $this->sort,
            'pid' => $this->pid,
            'area_id' => $this->area_id,
        ]);

        $data = AppToChannel::find()->where(['app_id' => $this->app_id])->select('channel_id')->all();
        if (!empty($data)) {
            $data = ArrayHelper::getColumn($data, 'channel_id');
            $query->andFilterWhere(['in','id', $data]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'image', $this->image]);

        return $dataProvider;
    }
}
