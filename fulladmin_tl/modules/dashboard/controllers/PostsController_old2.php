<?php

namespace app\modules\dashboard\controllers;

use Yii;
use app\modules\dashboard\models\Posts;
use app\modules\dashboard\models\search\PostsSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\modules\dashboard\models\Catelogies;
use app\models\Custom;
use app\modules\dashboard\models\TagList;
use app\controllers\BaseController;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    'bulk-delete' => ['post'],
                ],
            ],
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
        ];
    }
    
    /**
     * get data of list categories to reload dropdownlist by seleted lang
     */
    public function actionChangeLang($postid=NULL, $langid){
        $this->layout = '/noLayout';
        if($postid!=null){
            $model = $this->findModel($postid);
        }
        $catalogLists = Catelogies::find()->where("pid IS NULL OR pid = 0 AND lang='" . $langid . "'")->all();
        echo $this->render('_catalog-tree', [
            'model'=>$postid==null?NULL:$model,
            'catalogLists'=>$catalogLists
        ]);
        
       
    }
    
    /**
     * dell folder not used
     * @return mixed
     */
    public static function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new \InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
    public function actionDelFolderNotUsed()
    {
        $picFolder = Yii::getAlias('@webroot/images/posts/');
        $whatsInsideDir = scandir($picFolder);
        foreach ($whatsInsideDir as $fileOrDir) {
            if (is_dir($picFolder.$fileOrDir) && $fileOrDir != '.' && $fileOrDir != '..') {
                $new = Posts::find()->where(['code'=>$fileOrDir])->one();
                if($new == null){
                    $this->deleteDir($picFolder.$fileOrDir);
                    echo $picFolder.$fileOrDir;
                }
            }
        }
        echo 'da scan xong!';
    }
    
    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex($lang='vi', $static=false)
    {
        if($lang != 'vi' && $lang != 'en'){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $lang, $static);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'lang'=>$lang
        ]);
    }
    
    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionPage($lang, $static = false)
    {
        if($lang != 'vi' && $lang != 'en'){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $lang, $static);
        
        return $this->render('index-page', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'lang'=>$lang
        ]);
    }
    
    
    /**
     * Displays a single Posts model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "Posts #".$id,
                'content'=>$this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }
    
    /**
     * action create
     * create default -> redirect to update page
     */
    public function actionCreate(){
        $model = new Posts();
        $model->title = Yii::t('app', 'New Post Title here...');
        
        if($model->save()){
            return $this->redirect(['update?id=' . $model->id]);
        }else{
            //process
        }
    }
    
    /**
     * Creates a new Catelogies model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateByLang($id=NULL)
    {
        $request = Yii::$app->request;
        $model = new Posts();
        $modalTitle = Yii::t('app','Add new') .' '. Yii::t('app','Post');
        
        if($model->lang == null){
            $catalogLists = [];
        } else {
            $catalogLists = Catelogies::find()->where("pid IS NULL OR pid = 0 AND lang = '" . $model->lang . "'")->all();
        }
        
        $code = '';
        if($id != NULL){
            $modelMain = Posts::findOne($id);
            $code = $modelMain->code;
            $model->code = $modelMain->code;
            $model->title = $modelMain->title;
            $model->slug = $modelMain->slug;
        }
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> $modalTitle,
                    'content'=>$this->renderAjax('create-lang', [
                        'model' => $model,
                        'code'=>$code,
                        'catalogLists' => $catalogLists,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }else if($model->load($request->post())){
                
                //categories
                if($model->catalog != null){
                    $arr = array();
                    foreach ($model->catalog as $indexCat=>$valCat){
                        $arr[] = $indexCat;
                    }
                    $model->categories = implode(';', $arr);
                    
                } else {
                    $model->addError('catalog', Yii::t('app', 'A post must belong to a category!'));
                    return $this->render('update', [
                        'model' => $model,
                        'catalogLists' => $catalogLists,
                        'showErrorMessge'=>true
                    ]);
                }
                //tags
                if($model->taglist != null){
                    $arr = array();
                    foreach ($model->taglist as $indexTag=>$valTag){
                        $checkTag = TagList::find()->where(['name'=>$valTag])->one();
                        if($checkTag == null){
                            $newTag = new TagList();
                            $newTag->name = $valTag;
                            if($newTag->save())
                                $arr[] = $newTag->slug;
                        }else{
                            $arr[] = $checkTag->slug;
                        }
                    }
                    $model->tags = implode(';', $arr);
                }
                else {
                    $model->tags = '';
                }
                
                $checkModelExist = Posts::findOne(['lang'=>$model->lang, 'code'=>$model->code]);
                if($checkModelExist != null){
                    $model->addError('lang', Yii::t('app', 'Your change language is exist in database, please check!'));
                    return $this->render('update', [
                        'model' => $model,
                        'catalogLists' => $catalogLists,
                        'showErrorMessge'=>true
                    ]);
                }
                
                if($model->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> $modalTitle,
                        'content'=>'<span class="text-success">'. Yii::t('app','Add data successful!') .'</span>',
                        'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"])
                    ];
                }else{
                    return [
                        'title'=> $modalTitle,
                        'content'=>$this->renderAjax('create-lang', [
                            'model' => $model,
                            'code'=>$code,
                            'catalogLists' => $catalogLists,
                        ]),
                        'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                        
                    ];
                }
            }else{
                return [
                    'title'=> $modalTitle,
                    'content'=>$this->renderAjax('create-lang', [
                        'model' => $model,
                        'code'=>$code,
                        'catalogLists' => $catalogLists,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }
        }else{
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create-lang', [
                    'model' => $model,
                    'code'=>$code,
                    'catalogLists' => $catalogLists,
                ]);
            }
        }
        
    }
    
    /**
     * Creates a new Posts model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate___Old($lang, $static = false)
    {
        if($lang != 'vi' && $lang != 'en'){
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        
        $request = Yii::$app->request;
        $model = new Posts();
        
        $catalogLists = Catelogies::find()->where('pid IS NULL OR pid = 0')->all();
        
        if($model->code == null && !Yii::$app->request->post()){
            $model->code = (new Custom())->generateRandomString();
            $dir = Yii::getAlias('@webroot'). '/images/posts/' . $model->code;
            if (!file_exists($dir)  && !is_dir($dir)) {
                mkdir($dir, 0777, true);
            }
        }
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Create new Post",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Create new Posts",
                    'content'=>'<span class="text-success">Create Posts success</span>',
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::a('Create More',['create'],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    
                ];
            }else{
                return [
                    'title'=> "Create new Posts",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }
        }else{
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post())) {
                //categories
                if($model->catalog != null){
                    $arr = array();
                    foreach ($model->catalog as $indexCat=>$valCat){
                        $arr[] = $indexCat;
                    }
                    $model->categories = implode(';', $arr);
                }
                //tags
                if($model->taglist != null){
                    $arr = array();
                    foreach ($model->taglist as $indexTag=>$valTag){
                        $checkTag = TagList::find()->where(['name'=>$valTag])->one();
                        if($checkTag == null){
                            $newTag = new TagList();
                            $newTag->name = $valTag;
                            if($newTag->save())
                                $arr[] = $newTag->slug;
                        }else{
                            $arr[] = $checkTag->slug;
                        }
                    }
                    $model->tags = implode(';', $arr);
                } else {
                    $model->tags = '';
                }
                
                //set static page
                if($static == 'true'){
                    $model->is_static = 1;
                }
                
                
                if($model->save()){
                    if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == 'saveAndExit'){
                        if($static == 'true'){
                            return $this->redirect(['page?lang=' . $model->lang . '&static=true']);
                        } else {
                            return $this->redirect(['index?lang=' . $model->lang]);
                        }
                    } else{
                        return $this->redirect(['update', 'id' => $model->id, 'fromcreate'=>true]);
                    }
                } else {
                    return $this->render('create', [
                        'model' => $model,
                        'catalogLists' => $catalogLists,
                        'lang'=>$lang,
                        'static'=>$static
                    ]);
                }
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'catalogLists' => $catalogLists,
                    'lang'=>$lang,
                    'static'=>$static
                ]);
            }
        }
        
    }
    
    /**
     * Updates an existing Posts model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id, $fromcreate=false)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldModel = $this->findModel($id);
        $this->view->title = 'Post #' . $id;
        
        $catalogLists = Catelogies::find()->where("pid IS NULL OR pid = 0 AND lang = '" . $model->lang . "'")->all();
        
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Update Posts #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post())){
               
                if($oldModel->lang != $model->lang){
                    $model->addError('lang', Yii::t('app', 'Your change language is exist in database, please check!'));
                    return [
                        'title'=> "Update Posts #".$id,
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                    ];
                }
                
                if($model->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> "Posts #".$id,
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::a('Edit',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ];
                } else {
                    return [
                        'title'=> "Update Posts #".$id,
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                    ];
                }
            }else{
                return [
                    'title'=> "Update Posts #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button('Save',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post())) {
                //reload theo lang moi
                $catalogLists = Catelogies::find()->where("pid IS NULL OR pid = 0 AND lang = '" . $model->lang . "'")->all();
                
                //categories
                if($model->catalog != null){
                    $arr = array();
                    foreach ($model->catalog as $indexCat=>$valCat){
                        $arr[] = $indexCat;
                    }
                    $model->categories = implode(';', $arr);
                    
                } else {
                    $model->addError('catalog', Yii::t('app', 'A post must belong to a category!'));
                    return $this->render('update', [
                        'model' => $model,
                        'catalogLists' => $catalogLists,
                        'showErrorMessge'=>true
                    ]);
                }
                //tags
                if($model->taglist != null){
                    $arr = array();
                    foreach ($model->taglist as $indexTag=>$valTag){
                        $checkTag = TagList::find()->where(['name'=>$valTag])->one();
                        if($checkTag == null){
                            $newTag = new TagList();
                            $newTag->name = $valTag;
                            if($newTag->save())
                                $arr[] = $newTag->slug;
                        }else{
                            $arr[] = $checkTag->slug;
                        }
                    }
                    $model->tags = implode(';', $arr);
                }
                else {
                    $model->tags = '';
                }
                
                
                if($oldModel->lang != $model->lang){
                    $model->addError('lang', Yii::t('app', 'Your change language is exist in database, please check!'));
                    return $this->render('update', [
                        'model' => $model,
                        'catalogLists' => $catalogLists,
                        'showErrorMessge'=>true
                    ]);
                }
                
                
                if($model->save()){
                    if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == 'saveAndExit'){
                            //return $this->redirect(['index?lang=' . $model->lang . '&static=true']);
                            return $this->redirect(['index']);
                    } else{
                        
                        return $this->render('update', [
                            'model' => $model,
                            'catalogLists' => $catalogLists,
                            'showSuccessMessge'=>true
                        ]);
                    }
                } else {
                    return $this->render('update', [
                        'model' => $model,
                        'catalogLists' => $catalogLists,
                        'showErrorMessge'=>true
                    ]);
                }
            } else {
                return $this->render('update', [
                    'model' => $model,
                    'catalogLists' => $catalogLists,
                    'fromcreate'=>$fromcreate,
                ]);
            }
        }
    }
    
    /**
     * Delete an existing Posts model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $this->findModel($id)->delete();
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
        
        
    }
    
    /**
     * Delete multiple existing Posts model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {
        $request = Yii::$app->request;
        $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
        
    }
    
    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
