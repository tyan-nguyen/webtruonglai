<?php

namespace app\modules\dashboard\controllers;

use Yii;
use app\modules\dashboard\models\Catelogies;
use app\modules\dashboard\models\search\CatelogiesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\controllers\BaseController;
use app\modules\dashboard\models\PostType;

/**
 * CatelogiesController implements the CRUD actions for Catelogies model.
 */
class CatelogiesController extends BaseController
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
     * Lists all Catelogies models.
     * @return mixed
     */
    public function actionIndex($post_type='POST')
    {    
        $searchModel = new CatelogiesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $post_type);
        $postType = PostType::findOne(['code'=>strtoupper($post_type)]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'labels' => $postType!=NULL ? $postType->postLabels : PostType::defaultPostLabels(),
            'postType'=>$postType
        ]);
    }
    
    /**
     * get data of list categories to reload dropdownlist by seleted lang
     */
    public function actionChangeLang($langid=NULL){
        //phien ban json
       /* Yii::$app->response->format = Response::FORMAT_JSON;
       $data = (new Catelogies())->getList($langid);
       return $data; */
        //phien ban echo html
        $this->layout = '/noLayout';
        $html = '<option value>--' . Yii::t('app', 'Select') . '--</option>';
        if($langid != null){
            $data = (new Catelogies())->getList($langid);           
            foreach ($data as $indexCat=>$cat){
                $html .= '<option value="' . $indexCat . '">' . $cat . '</option>';
            }
        }
        echo $html;
    }


    /**
     * Displays a single Catelogies model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> Yii::t('app','Catelogies'),
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];    
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Catelogies model(in popup)
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($post_type='POST', $id=NULL)
    {
        $request = Yii::$app->request;
        $model = new Catelogies();  
        $model->post_type = $post_type;
        $modalTitle = Yii::t('app','Add new') .' '. Yii::t('app','Catelogies');
        $code = '';
        if($id != NULL){
            $modelMain = Catelogies::findOne($id);
            $code = $modelMain->code;
            $model->code = $modelMain->code;
            $model->name = $modelMain->name;
            $model->slug = $modelMain->slug;
            $model->post_type = $modelMain->post_type;
        }

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> $modalTitle,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'code'=>$code
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
        
                ];         
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> $modalTitle,
                    'content'=>'<span class="text-success">'. Yii::t('app','Add data successful!') .'</span>',
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::a(Yii::t('app','Create more'),['create?post_type='.$post_type],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];         
            }else{           
                return [
                    'title'=> $modalTitle,
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                        'code'=>$code
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
                return $this->render('create', [
                    'model' => $model,
                    'code'=>$code
                ]);
            }
        }
       
    }
    
    public function actionCreateFull($post_type='POST'){
        $model = new \app\modules\dashboard\models\Catelogies();
        $model->post_type = $post_type;
        $model->name = Yii::t('app', 'New Category Title Here...');
        $model->slug = 'temp';
        if($model->save()){
            return $this->redirect(['update-full', 'id' => $model->id]);
        } else {
            
        }
    }

    /**
     * Updates an existing Catelogies model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id); 
        $oldModel = $this->findModel($id);//for check change language
        $modalTitle = Yii::t('app','Update') .' '. Yii::t('app','Catelogies');

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> $modalTitle,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                ];         
            }else if($model->load($request->post())){
                
                if($oldModel->lang != $model->lang){
                    
                    $modelCheck = Catelogies::findOne([
                        'lang' => $model->lang,
                        'code' => $model->code,
                    ]);
                    if($modelCheck != null){
                        $model->addError('lang', Yii::t('app', 'Your change language is exist in database, please check!'));
                        return [
                            'title'=> $modalTitle,
                            'content'=>$this->renderAjax('update', [
                                'model' => $model,
                            ]),
                            'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                        ];
                    }
                }
                
                if ($model->save()){
                    return [
                        'forceReload'=>'#crud-datatable-pjax',
                        'title'=> Yii::t('app','Catelogies'),
                        'content'=>$this->renderAjax('view', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                            Html::a(Yii::t('app','Edit'),['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                    ]; 
                } else {
                    return [
                        'title'=> $modalTitle,
                        'content'=>$this->renderAjax('update', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button(Yii::t('app','Close'),['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                        Html::button(Yii::t('app','Save'),['class'=>'btn btn-primary','type'=>"submit"])
                    ];
                }
            }else{
                 return [
                    'title'=> $modalTitle,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
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
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
    }
    
    public function actionUpdateFull($id){
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $oldModel = $this->findModel($id);//for check change language        
        /*
         *   Process for non-ajax request
         */
        if ($model->load($request->post())) {
            
            if($oldModel->lang != $model->lang){                
                $modelCheck = Catelogies::findOne([
                    'lang' => $model->lang,
                    'code' => $model->code,
                ]);
                if($modelCheck != null){
                    $model->addError('lang', Yii::t('app', 'Your change language is exist in database, please check!'));
                    return $this->render('_form_full', [
                        'model' => $model,
                        'showErrorMessge'=>true
                    ]);
                }
            }
            if($model->save()){
                if(isset($_POST['btnSubmit']) && $_POST['btnSubmit'] == 'saveAndExit'){
                    return $this->redirect(['index']);
                } else {
                return $this->render('_form_full', [
                    'model' => $model,
                    'showSuccessMessge'=>true
                ]);
                }
            }else {
                return $this->render('_form_full', [
                    'model' => $model,
                    'showErrorMessge'=>true
                ]);
            }
        } else {
            return $this->render('_form_full', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Delete an existing Catelogies model.
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
     * Delete multiple existing Catelogies model.
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
     * Finds the Catelogies model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Catelogies the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Catelogies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app','The requested page does not exist.'));
        }
    }
}
