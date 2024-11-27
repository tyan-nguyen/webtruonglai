<?php

namespace app\modules\dashboard\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use app\modules\dashboard\models\PostDocuments;
use app\modules\dashboard\models\Posts;
use app\widgets\DocumentGridWidget;

/**
 * TaiLieuController implements the CRUD actions for TaiLieu model.
 */
class DocumentsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors() {
        return [
            'ghost-access'=> [
                'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-outer' => ['POST'],
                ],
            ],
        ];
    }    
    
    /**
     * Displays a single TaiLieu model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                'title'=> "TaiLieu",
                'content'=>$this->renderAjax('view', [
                    'model' => $this->findModel($id),
                ]),
                'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                Html::a('Sửa',['update','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
            ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }
    
    /**
     * Creates a new TaiLieu model from other modules.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateOuter($pid)
    {
        $request = Yii::$app->request;
        $model = new PostDocuments();
        $post = Posts::findOne($pid);
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới Tài liệu",
                    'content'=>$this->renderAjax('create-outer', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }else if($model->load($request->post())){
                $file = UploadedFile::getInstance($model, 'file');
                $model->pid = $pid;
                if (!empty($file)){
                    $model->file_name = $file->name;
                    $model->file_extension = $file->extension;
                    $model->file_size = $file->size;
                    $model->url = md5(Yii::$app->user->id . date('Y-m-d H:i:s')) . '.' . $model->file_extension;
                }
                if($model->save()){
                    if (!empty($file))
                        $file->saveAs( $post->getFolderRoot() .  $model->url);
                        return [
                            //'forceReload'=>'#crud-datatable-pjax',
                            'forceClose'=>true,
                            /* 'title'=> "Thêm mới TaiLieu",
                             'content'=>'<span class="text-success">Thêm mới thành công</span>',
                             'tcontent'=>'Thêm mới thành công!',*/
                            'dungChungType'=>'taiLieu',
                            'dungChungContent'=>DocumentGridWidget::widget([
                                'id_tham_chieu' => $pid
                            ]),
                            'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                            Html::a('Tiếp tục thêm',['create'],['class'=>'btn btn-primary','role'=>'modal-remote-2'])
                            
                        ];
                }else{
                    return [
                        'title'=> "Thêm mới Tài liệu",
                        'content'=>$this->renderAjax('create-outer', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                        
                    ];
                }
            }else{
                return [
                    'title'=> "Thêm mới Tài liệu",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                    
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
                ]);
            }
        }
        
    }
    
    /**
     * Updates an existing TaiLieu model form other modules.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateOuter($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật Tài liệu",
                    'content'=>$this->renderAjax('update-outer', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    //'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Tài liệu",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'tcontent'=>'Cập nhật thành công!',
                    'dungChungType'=>'taiLieu',
                    //'dungChungContent'=>$this->renderAjax('_imagesByID', []),
                    'dungChungContent'=>DocumentGridWidget::widget([
                        'id_tham_chieu' => $model->pid
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::a('Sửa',['update-outer','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                return [
                    'title'=> "Cập nhật Tài liệu",
                    'content'=>$this->renderAjax('update-outer', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Close',['class'=>'btn btn-default pull-left','data-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }
        }else{
            /*
             *   Process for non-ajax request
             */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update-outer', [
                    'model' => $model,
                ]);
            }
        }
    }
    
    /**
     * Delete an existing TaiLieu model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDeleteOuter($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        $thamchieu = $model->pid;
        $model->delete();
        
        if($request->isAjax){
            /*
             *   Process for ajax request
             */
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['forceClose'=>true,/* 'forceReload'=>'#crud-datatable-pjax',  */
                'dungChungType'=>'taiLieu',
                'dungChungContent'=>DocumentGridWidget::widget([
                    'id_tham_chieu' => $thamchieu
                ]),
            ];
        }else{
            /*
             *   Process for non-ajax request
             */
            return $this->redirect(['index']);
        }
        
        
    }
    
    /**
     * Finds the TaiLieu model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaiLieu the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostDocuments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
