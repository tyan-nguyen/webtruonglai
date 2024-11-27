<?php

namespace app\modules\dashboard\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dashboard\models\Posts;

/**
 * NewsSearch represents the model behind the search form about `app\modules\admin\models\News`.
 */
class PostsSearch extends Posts
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'categories', 'title', 'slug', 'summary', 'content', 'date_created',                 
               'post_status', 'lang', 'post_type'], 'safe'],
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
        $query = Posts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder'=>[
                    'date_updated' => SORT_DESC, 
                    'date_created' => SORT_DESC,                     
                    'id' => SORT_DESC
                ]
            ]
        ]);

        $this->load($params);
        
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'date_created' => $this->date_created,
            'post_status' => $this->post_status,
            'lang' => $this->lang,
        ]);

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'categories', $this->categories])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'summary', $this->summary])
            ->andFilterWhere(['like', 'content', $this->content]);
        
        if($post_type != NULL){
            $query->andFilterWhere([
                'post_type' => $post_type,
            ]);
        }
        return $dataProvider;
    }
}
