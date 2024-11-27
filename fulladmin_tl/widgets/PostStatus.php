<?php

namespace app\widgets;

use Yii;
use yii\base\Widget;

/**
 * PostStatus Widget for display status for post/categories in grid and other views
 * input: value and text to display
 */
class PostStatus extends Widget
{
    public $value;
    public $text;
    public $labelTypes = [
        'PUBLISH'   => 'success',
        'HIDE'  => 'warning',
        'DRAFT' => 'default'
    ];
    public $labelIcons = [
        'PUBLISH'   => 'fa fa-globe',
        'HIDE'  => 'fa fa-eye-slash',
        'DRAFT' => 'fa fa-pencil'
    ];
    
    public function init(){
        parent::init();
    }
    
    /**
     * {@inheritdoc}
     */
    public function run()
    {   
        if(array_key_exists($this->value, $this->labelTypes))
            return '<small class="label label-'.$this->labelTypes[$this->value].'"><i class="'.$this->labelIcons[$this->value].'"></i> '.$this->text.'</small>';
        else 
           return null;
    }
}
