<?php

namespace app\modules\dashboard\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dashboard\models\Links;


/**
 * LinksSearch represents the model behind the search form about `app\modules\admin\models\Links`.
 */
class LinksSearch extends Links
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pid'], 'integer'],
            [['name', 'link', 'name_en', 'link_en', 'open_new_tab', 'type', 'lang'], 'safe'],
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
    public function search($params, $type)
    {
        $query = Links::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'type' => $this->type,
            'lang' => $this->lang,
            'pid' => $this->pid,
        ]);
        
        if($type != null){
            $query->andFilterWhere([
                'type' => $type,
            ]);
        }

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'name_en', $this->name_en])
            ->andFilterWhere(['like', 'link_en', $this->link_en])
            ->andFilterWhere(['like', 'open_new_tab', $this->open_new_tab]);

        return $dataProvider;
    }
}
