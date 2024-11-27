<?php

namespace app\modules\dashboard\controllers;


use Yii;
use yii\filters\VerbFilter;
use yii\helpers\Html;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;
use app\modules\dashboard\models\PostImages;
use app\modules\dashboard\models\Posts;
use app\widgets\ImageGridWidget;

/**
 * HinhAnhController implements the CRUD actions for HinhAnh model.
 */
class ImagesController extends Controller
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
     * Displays a single HinhAnh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {   
        $request = Yii::$app->request;
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "HinhAnh",
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
     * Creates a new HinhAnh model from other modules.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreateOuter($pid)
    {
        $request = Yii::$app->request;
        $model = new PostImages();
        $post = Posts::findOne($pid);
        
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới Hình ảnh",
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
                    $model->name = $file->name;
                    $model->img_extension = $file->extension;
                    $model->img_size = $file->size;
                    $model->url = md5(Yii::$app->user->id . date('Y-m-d H:i:s')) . '.' . $model->img_extension;
                }
                if($model->save()){
                    if (!empty($file))
                        $file->saveAs( $post->getFolderRoot() .  $model->url);
                    return [
                        #'forceReload'=>'#hinh-anh-pjax',
                        'forceClose'=>true,
                       /*  'title'=> "Thêm mới Hình ảnh",
                        'content'=>'<span class="text-success">Thêm mới thành công</span>',
                        'tcontent'=>'Thêm mới thành công!', */
                        'dungChungType'=>'hinhAnh',
                        'dungChungContent'=>ImageGridWidget::widget([
                            'id_tham_chieu' => $pid
                        ]),
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::a('Tiếp tục thêm',['create'],['class'=>'btn btn-primary','role'=>'modal-remote-2'])
                        
                    ];
                } else {
                    return [
                        'title'=> "Thêm mới Hình ảnh",
                        'content'=>$this->renderAjax('create', [
                            'model' => $model,
                        ]),
                        'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                        Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                        
                    ];
                }
            }else{
                return [
                    'title'=> "Thêm mới Hình ảnh",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                    
                ];
            }
        }
        
    }

    /**
     * Updates an existing HinhAnh model from other modules.
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
                    'title'=> "Cập nhật HinhAnh",
                    'content'=>$this->renderAjax('update-outer', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::button('Lưu lại',['class'=>'btn btn-primary','type'=>"submit"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    #'forceClose'=>true,
                    #'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Hình ảnh",
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'tcontent'=>'Cập nhật thành công!',
                    'dungChungType'=>'hinhAnh',
                    //'dungChungContent'=>$this->renderAjax('_imagesByID', []),
                    'dungChungContent'=>ImageGridWidget::widget([
                        'id_tham_chieu' => $model->pid
                    ]),
                    'footer'=> Html::button('Đóng lại',['class'=>'btn btn-default pull-left','data-bs-dismiss'=>"modal"]).
                    Html::a('Sửa',['update-outer','id'=>$id],['class'=>'btn btn-primary','role'=>'modal-remote'])
                ];
            }else{
                return [
                    'title'=> "Cập nhật HinhAnh",
                    'content'=>$this->renderAjax('update-outer', [
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
                return $this->render('update-outer', [
                    'model' => $model,
                ]);
            }
        }
    }
    
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
                'dungChungType'=>'hinhAnh',
                'dungChungContent'=>ImageGridWidget::widget([
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
     * Finds the HinhAnh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HinhAnh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PostImages::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
