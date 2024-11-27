<?php

namespace app\modules\dashboard\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dashboard\models\Catelogies;

/**
 * CatelogiesSearch represents the model behind the search form about `app\modules\dashboard\models\Catelogies`.
 */
class CatelogiesSearch extends Catelogies
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id','pid', 'priority', 'level', 'user_created'], 'integer'],
            [['name', 'slug', 'lang', 'code', 'date_created', 'seo_title', 'seo_description', 'description', 'content', 'status', 'post_type'], 'safe'],
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
    public function search($params, $post_type)
    {
        $query = Catelogies::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['date_created' => SORT_DESC]],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'pid' => $this->pid,
            'priority' => $this->priority,
            'level' => $this->level,
            'lang' => $this->lang,
            'user_created' => $this->user_created,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'date_created', $this->date_created])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_description', $this->seo_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'content', $this->content]);
        
        if($post_type != NULL){
            $query->andFilterWhere([
                'post_type' => $post_type,
            ]);
        }
            
        return $dataProvider;
    }
}
