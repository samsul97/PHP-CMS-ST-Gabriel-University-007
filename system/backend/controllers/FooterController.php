<?php

namespace backend\controllers;

use Yii;
use backend\models\Footer;
use backend\models\FooterSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * FooterController implements the CRUD actions for Footer model.
 */
class FooterController extends Controller
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
     * Lists all Footer models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FooterSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Footer model.
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
     * Creates a new Footer model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Footer();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'footer/' . $image->baseName . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                
                $this->resizeImage($path);
                
                $model->image = $file;
                
                
            }

            $model->save(false);

            Yii::$app->getSession()->setFlash('footer_create', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['index']);
        } else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('footer_failed', [
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
     * Updates an existing Footer model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'footer/' . $image->baseName . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                
                $this->resizeImage($path);
                
                $model->image = $file;
                
                
            }

            $model->save(false);

            Yii::$app->getSession()->setFlash('footer_create', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['index']);
        } else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('footer_failed', [
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
        ]);
    }

    /**
     * Deletes an existing Footer model.
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
     * Finds the Footer model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Footer the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Footer::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    private function resizeImage($path) {
        
        // image resized function
        $image = Image::getImagine()->open($path);
        $image->resize(new \Imagine\Image\Box(1000, 512))->save($path);

        return $image;
    }
}
