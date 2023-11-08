<?php

namespace backend\controllers;

use Yii;
use backend\models\Gallery;
use backend\models\GalleryCategory;
use backend\models\GalleryCategorySearch;
use backend\models\GallerySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * GalleryController implements the CRUD actions for Gallery model.
 */
class GalleryController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                    'delete-gallery-category' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Gallery models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gallery model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Gallery model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gallery();

        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->image = UploadedFile::getInstances($model, 'image');
            
            if ($model->image)
            {
                foreach ($model->image as $key => $image) {

                    $gallery = new Gallery();
                    $gallery->gallery_category_id = $model->gallery_category_id;
                    $gallery->name = $model->name;
                    $gallery->created_by = $model->created_by;
                    $gallery->updated_by = $model->created_by;
                    $gallery->date = date('Y-m-d');
                    
                    $file = Yii::$app->params['upload'] . 'gallery/' . $image->baseName . '.' . $image->extension;
                    $path = Yii::getAlias('@webroot') . $file;
                    $image->saveAs($path);

                    // image resized function
                    $this->resizeImage($path);

                    $gallery->image = $file;
                    $gallery->save(false);
                }
            }
            
            Yii::$app->getSession()->setFlash('gallery_failed_create', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['index']);
        } 
        
        else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('gallery_success_create', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gallery model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $existingGallery = $model->image;

        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'gallery/' . $image->baseName . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                
                $this->resizeImage($path);
                
                $model->image = $file;
                
            } else {
                $model->image = $existingGallery;
            }

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('gallery_success_update', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated !',
                ]
            );

            return $this->redirect(['index']);
        } 
        
        else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('gallery_failed_update', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('update', [
            'model' => $model,
            'existingGallery' => $existingGallery,
        ]);
    }

    /**
     * Deletes an existing Gallery model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Gallery model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gallery the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gallery::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function actionIndexGalleryCategory(Type $var = null)
    {
        $searchModel = new GalleryCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/gallery/gallery-category/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionViewGalleryCategory($id)
    {
        $model = GalleryCategory::findOne($id);

        return $this->render('/gallery/gallery-category/view', [
            'model' => $model,
        ]);
    }

    public function actionCreateGalleryCategory(Type $var = null)
    {
        $model = new GalleryCategory();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $cover = UploadedFile::getInstance($model, 'cover');

            if ($cover)
            {
                $file = Yii::$app->params['upload'] . 'gallery-category/' . $cover->baseName . '.' . $cover->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $cover->saveAs($path);
                
                $this->resizeImage($path);

                // var_dump($path);
                // die;
                
                $model->cover = $file;
                
                
            }

            $model->save(false);

            Yii::$app->getSession()->setFlash('user_update_save', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['index-gallery-category']);
        } else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('user_create', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('/gallery/gallery-category/create', [
            'model' => $model,
        ]);
    }

    public function actionUpdateGalleryCategory($id)
    {
        $model = GalleryCategory::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('/gallery/gallery-category/update', [
            'model' => $model,
        ]);
    }

    public function actionDeleteGalleryCategory($id)
    {
        $galleryCategory = GalleryCategory::findOne($id);

        foreach ($galleryCategory->gallery as $key => $data) {
            $data->delete();
        }

        $galleryCategory->delete();

        return $this->redirect(['index-gallery-category']);
    }

    private function resizeImage($path) {

        
        // image resized function
        $image = Image::getImagine()->open($path);
        $image->resize(new \Imagine\Image\Box(1000, 600))->save($path);
        // var_dump($image);
        //         die;

        return $image;
    }
}