<?php

namespace frontend\controllers;

use Yii;
use backend\models\Gallery;
use backend\models\GalleryCategory;
use backend\models\GallerySearch;
use backend\models\Slider;
use common\components\YoutubeClient;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use Google_Client;
use Google_Service_YouTube;

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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
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

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public function actionGalleryCategories()
    {
        $model = new ActiveDataProvider([
            'query' => GalleryCategory::find(),
            'pagination' => [
                'pageSize' => 9
            ],
            // 'sort' => [
            //     'defaultOrder' => [
            //         'timestamp' => SORT_DESC,
            //         'name' => SORT_ASC, 
            //     ]
            // ],
        ]);

        $youtubeClient = new YoutubeClient();
        $youtubeVideo = $youtubeClient->getVideos();

        // echo "<pre>";
        // var_dump($youtubeVideo);
        // die;

        return $this->render('gallery_categories', [
            'model' => $model,
            'youtubeVideo' => $youtubeVideo,
        ]);
    }

    public function actionGallery($id)
    {
        
        
        $galleryCategory = GalleryCategory::findOne($id);

        $gallery = Gallery::find()
                    ->where(['gallery_category_id' => $galleryCategory->id])
                    ->all();

        return $this->render('gallery', [
            'gallery' => $gallery,
            'galleryCategory' => $galleryCategory
        ]);
    }

    public function actionGalleryDetail($id)
    {

        $galleryCategory = GalleryCategory::findOne($id);

        $gallery = Gallery::find()
                    ->where(['gallery_category_id' => $galleryCategory->id])
                    ->all();

        return $this->renderAjax('gallery_detail', [
            'gallery' => $gallery,
            'galleryCategory' => $galleryCategory,
        ]);
    }

}
