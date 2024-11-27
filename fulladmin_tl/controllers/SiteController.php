<?php
namespace app\controllers;

use Yii;
use app\modules\dashboard\models\Catelogies;
use app\modules\dashboard\models\Posts;
use app\modules\dashboard\models\PostPublic;
use app\modules\dashboard\models\TagList;
use app\modules\dashboard\models\Contact;
use app\modules\dashboard\models\Options;

class SiteController extends BaseController
{
    public $layout = 'index';
    public $enableCsrfValidation = false;
    
    /**
     * homepage
     */
    public function actionIndex()
    {
        $setting = Options::getOptions('SETTING');
        $this->view->title = $setting['site_seo_title'];
        $this->view->params['meta_description'] = $setting['site_seo_description'];
        
        return $this->render('index');
    }
    
    /**
     * posts
     */
    public function actionPosts($slug=NULL, $page=NULL)
    {
        $this->layout = 'post';
        $this->view->params['showBanner'] = true;
        //all posts
        $this->view->params['image'] = '/ntweb/images/banner/default.jpg';
        $this->view->params['title'] = 'Bài viết mới';
        $this->view->params['breadcrumb'] = [
            [
                'label'=>'Trang chủ',
                'url' => '#',
                'active'=>false
            ],
            [
                'label'=>'Bài viết',
                'url' => '',
                'active'=>true
            ]
        ];
        
        //$listPosts = Posts::getPostByType('POST',10);
        $listPosts = PostPublic::getPostsPublic('POST');
        $this->view->title = $this->view->params['title'];
        $this->view->params['meta_description'] = 'Tin tức sự kiện mới nhất';
        //for one category
        if($slug != NULL){
            $category = Catelogies::find()->where(['slug'=>$slug])->one();
            $this->view->params['image'] = ($category->cover!=null?$category->cover:'/ntweb/images/banner/default.jpg');
            $this->view->params['title'] = $category->name;
            
            $this->view->title = $category->seoTitle;
            $this->view->params['meta_description'] = $category->seoDescription;
            
            $this->view->params['breadcrumb'] = [
                [
                    'label'=>'Trang chủ',
                    'url' => '#',
                    'active'=>false
                ],
                [
                    'label'=>$category->name,
                    'url' => '',
                    'active'=>true
                ]
            ];
            
            //$listPosts = Posts::getPostByType('POST',10,$category->slug);
            $listPosts = PostPublic::getPostsPublic('POST',$category->slug);
            
        }
        $numPost = $listPosts->count();
        if($page == NULL)
            $page = 1;
        $numPerPage = 10;
        $numPage = ceil($numPost/$numPerPage);
        
        $listPosts = $listPosts->offset($page*$numPerPage-$numPerPage)->limit($numPerPage)
            ->orderBy(['date_created'=>SORT_DESC])->all();
        
        return $this->render('posts', [
            'listPosts'=>$listPosts,
            'prev' => $page>1 ? ($page-1) : null,
            'next' => $page < $numPage ? ($page+1) : null,
            'current' => $page,
            'total' => $numPage
        ]);
    }
    
    /**
     * post
     */
    public function actionPost($slug)
    {
        //$this->layout = 'post';
        $this->view->params['showBanner'] = false;
        $model = PostPublic::find()->where(['slug'=>$slug])->one();
       /*  $this->layout = $model->layoutView; */
        
        if($model != null && $model->checkPostAvailable()){
            
            $this->layout = $model->layoutView;
            
            $postOthers = PostPublic::getPostsPublic('POST')->andWhere('id <> '.$model->id)->limit(3)->orderBy(['date_created'=>SORT_DESC])->all();
            
            $this->view->title = $model->seoTitle;
            $this->view->params['meta_description'] = $model->seoDescription;
            $this->view->params['meta_image'] = $model->seoImage;
            
            return $this->render('post', [
                'post'=>$model,
                'postOthers'=>$postOthers
            ]);
        } else {
            $this->redirect('/404');
        }
    }
    
    /**
     * dự án
     */
    public function actionProjects($slug=NULL, $page=NULL)
    {
        $this->layout = 'post';
        $this->view->params['showBanner'] = true;
        //all posts
        $this->view->params['image'] = '/ntweb/images/banner/default.jpg';
        $this->view->params['title'] = 'Tất cả dự án';
        $this->view->params['breadcrumb'] = [
            [
                'label'=>'Trang chủ',
                'url' => '#',
                'active'=>false
            ],
            [
                'label'=>'Dự án',
                'url' => '',
                'active'=>true
            ]
        ];
        
        //$listPosts = Posts::getPostByType('POST',10);
        $listPosts = PostPublic::getPostsPublic('PROJECT');
        $this->view->title = $this->view->params['title'];
        $this->view->params['meta_description'] = 'Tất cả dự án';
        //for one category
        if($slug != NULL){
            $category = Catelogies::find()->where(['slug'=>$slug])->one();
            $this->view->params['image'] = ($category->cover!=null?$category->cover:'/ntweb/images/banner/default.jpg');
            $this->view->params['title'] = $category->name;
            
            $this->view->title = $category->seoTitle;
            $this->view->params['meta_description'] = $category->seoDescription;
            
            $this->view->params['breadcrumb'] = [
                [
                    'label'=>'Trang chủ',
                    'url' => '#',
                    'active'=>false
                ],
                [
                    'label'=>$category->name,
                    'url' => '',
                    'active'=>true
                ]
            ];
            
            //$listPosts = Posts::getPostByType('POST',10,$category->slug);
            $listPosts = PostPublic::getPostsPublic('PROJECT',$category->slug);
            
        }
        $numPost = $listPosts->count();
        if($page == NULL)
            $page = 1;
            $numPerPage = 10;
            $numPage = ceil($numPost/$numPerPage);
            
            $listPosts = $listPosts->offset($page*$numPerPage-$numPerPage)->limit($numPerPage)
            ->orderBy(['date_created'=>SORT_DESC])->all();
            
            return $this->render('posts', [
                'listPosts'=>$listPosts,
                'prev' => $page>1 ? ($page-1) : null,
                'next' => $page < $numPage ? ($page+1) : null,
                'current' => $page,
                'total' => $numPage
            ]);
    }
    
    /**
     * post
     */
    public function actionProject($slug)
    {
        //$this->layout = 'post';
        $this->view->params['showBanner'] = false;
        $model = PostPublic::find()->where(['slug'=>$slug])->one();
        /*  $this->layout = $model->layoutView; */
        
        if($model != null && $model->checkPostAvailable()){
            
            $this->layout = $model->layoutView;
            
            $postOthers = PostPublic::getPostsPublic('PROJECT')->andWhere('id <> '.$model->id)->limit(3)->orderBy(['date_created'=>SORT_DESC])->all();
            
            $this->view->title = $model->seoTitle;
            $this->view->params['meta_description'] = $model->seoDescription;
            
            return $this->render('post', [
                'post'=>$model,
                'postOthers'=>$postOthers
            ]);
        } else {
            $this->redirect('/404');
        }
    }
    
    /**
     * tags
     */
    public function actionTag($slug, $page=NULL)
    {
        $this->layout = 'post';
        $this->view->params['showBanner'] = true;
        
        $tag = TagList::findOne(['slug'=>$slug]);
        
        $this->view->params['image'] = '/ntweb/images/banner/default.jpg';
        $this->view->params['title'] = $tag->name;
        $this->view->params['breadcrumb'] = [
            [
                'label'=>'Trang chủ',
                'url' => '#',
                'active'=>false
            ],
            [
                'label'=>$tag->name,
                'url' => '',
                'active'=>true
            ]
        ];
        
        $listPosts = PostPublic::getPostsPublicByTag('POST', $slug);
        
        $numPost = $listPosts->count();
        if($page == NULL)
            $page = 1;
            $numPerPage = 10;
            $numPage = ceil($numPost/$numPerPage);
            
            $listPosts = $listPosts->offset($page*$numPerPage-$numPerPage)->limit($numPerPage)
            ->orderBy(['date_created'=>SORT_DESC])->all();
            
            $this->view->title = 'Thẻ: '. $tag->name;
            $this->view->params['meta_description'] = 'Bài viết được gắn thẻ: '. $tag->name;
            
            return $this->render('posts', [
                'listPosts'=>$listPosts,
                'prev' => $page>1 ? ($page-1) : null,
                'next' => $page < $numPage ? ($page+1) : null,
                'current' => $page,
                'total' => $numPage
            ]);
    }
    /**
     * search
     */
    public function actionSearch($page=NULL){
        $this->layout = 'post';
        $this->view->params['showBanner'] = true;
        $this->view->params['image'] = '/ntweb/images/banner/default.jpg';
        $this->view->params['title'] = 'Tìm kiếm';
        $this->view->params['breadcrumb'] = [
            [
                'label'=>'Trang chủ',
                'url' => '#',
                'active'=>false
            ],
            [
                'label'=>'Từ khóa: "' . (isset($_GET['search'])?$_GET['search']:'') . '"',
                'url' => '',
                'active'=>true
            ]
        ];
        $listPosts = PostPublic::getPostsPublic('POST');
        $listPosts = $listPosts->andFilterWhere(['like', 'title', $_GET['search'] ]);
        $numPost = $listPosts->count();
        if($page == NULL)
            $page = 1;
        $numPerPage = 10;
        $numPage = ceil($numPost/$numPerPage);
        
        $listPosts = $listPosts->offset($page*$numPerPage-$numPerPage)->limit($numPerPage)
        ->orderBy(['date_created'=>SORT_DESC])->all();
        
        $this->view->title = 'Từ khóa: '. $_GET['search'];
        $this->view->params['meta_description'] = 'Kết quả tìm kiếm cho từ khóa: '. $_GET['search'];
        
        return $this->render('posts', [
            'listPosts'=>$listPosts,
            'prev' => $page>1 ? ($page-1) : null,
            'next' => $page < $numPage ? ($page+1) : null,
            'current' => $page,
            'total' => $numPage,
            'route' => '/search?search=' . $_GET['search']
        ]);
    }
    
    /**
     * contact
     */
    public function actionContact()
    {
        $this->layout = 'page';
        $this->view->params['showBanner'] = true;
        $this->view->params['image'] = '/ntweb/images/banner/default.jpg';
        $this->view->params['title'] = 'Liên hệ';
        $this->view->params['breadcrumb'] = [
            [
                'label'=>'Trang chủ',
                'url' => '#',
                'active'=>false
            ],
            [
                'label'=>'Liên hệ',
                'url' => '',
                'active'=>true
            ]
        ];
        //seo
        $this->view->title = 'Thông tin liên hệ';
        $this->view->params['meta_description'] = 'Thông tin liên hệ';
        return $this->render('contact');
    }
    
    /**
     * get contact info from contact page
     * @return string
     */
    public function actionInfoContact(){
        $request = Yii::$app->request;
        if(isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['message'])){
            $contact = new Contact();
            $contact->name = $_POST['name'];
            $contact->email = isset($_POST['email'])?$_POST['email']:'';
            $contact->phone = $_POST['phone'];
            $contact->subject = isset($_POST['subject'])?$_POST['subject']:'';
            $contact->message = $_POST['message'];
            if($contact->save()){
                $this->layout = 'page';
                $this->view->params['showBanner'] = true;
                $this->view->params['image'] = '/ntweb/images/banner/default.jpg';
                $this->view->params['title'] = 'Liên hệ';
                $this->view->params['breadcrumb'] = [
                    [
                        'label'=>'Trang chủ',
                        'url' => '#',
                        'active'=>false
                    ],
                    [
                        'label'=>'Liên hệ',
                        'url' => '',
                        'active'=>true
                    ]
                ];
                //seo
                $this->view->title = 'Thông tin liên hệ';
                $this->view->params['meta_description'] = 'Thông tin liên hệ';
                return $this->render('contact_success');
            }
        }
        return $this->redirect('/contact');
    }
    
    /**
     * get contact info from contact page
     * @return string
     */
    public function actionSubcribeContact(){
        $request = Yii::$app->request;
        if(isset($_POST['phone'])){
            $contact = new Contact();
            $contact->name = 'Gọi lại cho tôi';
            $contact->email = 'Không có';
            $contact->phone = $_POST['phone'];
            $contact->subject = 'Từ khung Subcribe';
            $contact->message = 'Gọi lại cho tôi';
            if($contact->save()){
                $this->layout = 'page';
                $this->view->params['showBanner'] = true;
                $this->view->params['image'] = '/ntweb/images/banner/default.jpg';
                $this->view->params['title'] = 'Liên hệ';
                $this->view->params['breadcrumb'] = [
                    [
                        'label'=>'Trang chủ',
                        'url' => '#',
                        'active'=>false
                    ],
                    [
                        'label'=>'Liên hệ',
                        'url' => '',
                        'active'=>true
                    ]
                ];
                //seo
                $this->view->title = 'Thông tin liên hệ';
                $this->view->params['meta_description'] = 'Thông tin liên hệ';
                return $this->render('contact_success');
            }
        }
        return $this->redirect('/contact');
    }
    
    /**
     * 404 not found
     */
    public function action404()
    {
        $this->layout = 'page';
        $this->view->params['showBanner'] = true;
        $this->view->params['image'] = '/ntweb/images/bg_fact.png';
        $this->view->params['title'] = '404';
        $this->view->params['breadcrumb'] = [
            [
                'label'=>'Trang chủ',
                'url' => '#',
                'active'=>false
            ],
            [
                'label'=>'Trang 404',
                'url' => '',
                'active'=>true
            ]
        ];
        //seo
        $this->view->title = 'Trang 404';
        $this->view->params['meta_description'] = 'Trang bạn yêu cầu không tìm thấy';
        return $this->render('404');
    }
    
}