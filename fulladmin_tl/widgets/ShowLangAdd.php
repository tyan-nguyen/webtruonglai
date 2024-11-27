<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;
use yii\helpers\Html;
use app\modules\dashboard\models\PostType;

/**
 * PostStatus Widget for display status for post/categories in grid and other views
 * input: value and text to display
 */
class ShowLangAdd extends Widget
{    
    public $post_type;
    /**
     * {@inheritdoc}
     */
    public function run()
    {
        $html = '<div class="btn-group">
          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           <i class="glyphicon glyphicon-plus"></i> ' . Yii::t('app', 'Add new') . ' <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
            ';
        
        foreach (Yii::$app->params['langs'] as $key=>$val){
            $html .= '<li>' . Html::a(
                    Html::img(Yii::getAlias("@web/images/").$key.'.png', ['width'=>'20px']) .'&nbsp;'. $val, 
                PostType::getPostLinkByPostType($this->post_type) .'&lang='.$key, ['data-pjax'=>0]) . '</li>';
        }
           /*  <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li role="separator" class="divider"></li>
            <li><a href="#">Separated link</a></li> */
       $html .= '
          </ul>
        </div>';
        return $html;
    }
}