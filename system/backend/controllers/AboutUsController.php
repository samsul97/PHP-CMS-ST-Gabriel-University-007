<?php

namespace backend\controllers;

use Yii;
use backend\models\AboutUs;
use backend\models\AboutUsCategory;
use backend\models\AboutUsSearch;
use backend\models\Contacts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * AboutUsController implements the CRUD actions for AboutUs model.
 */
class AboutUsController extends Controller
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
     * Lists all AboutUs models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AboutUsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AboutUs model.
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
     * Creates a new AboutUs model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AboutUs();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing AboutUs model.
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
     * Deletes an existing AboutUs model.
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
     * Finds the AboutUs model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return AboutUs the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AboutUs::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function actionProfile(Type $var = null)
    {
        
        $model = AboutUs::findOne(['id' => 1, 'about_category_id' => AboutUsCategory::PROFILE]); // profile

        $model->about_category_id = AboutUsCategory::PROFILE;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('about_us_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated!',
                ]
            );
            return $this->redirect(['profile']);
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('about_us_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('profile', [
            'model' => $model
        ]);
    }

    public function actionManagement(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 2, 'about_category_id' => AboutUsCategory::MANAGEMENT]); // management

        $model->about_category_id = AboutUsCategory::MANAGEMENT;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('management_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated !',
                ]
            );
            return $this->redirect(['management']);
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('management_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('management', [
            'model' => $model
        ]);
    }

    public function actionLecturer(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 3, 'about_category_id' => AboutUsCategory::LECTURER]); // profile

        $model->about_category_id = AboutUsCategory::LECTURER;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('lecturer_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated !',
                ]
            );
            return $this->redirect(['lecturer']);
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('lecturer_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('lecturer', [
            'model' => $model
        ]);
    }
    
    public function actionCeomessage(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 4, 'about_category_id' => AboutUsCategory::CEO_MESSAGES]); // profile

        $model->about_category_id = AboutUsCategory::CEO_MESSAGES;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('ceo_message_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated !',
                ]
            );
            return $this->redirect(['ceomessage']);
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('ceo_message_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('ceo_messages', [
            'model' => $model
        ]);
    }

    public function actionPrograms(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 5, 'about_category_id' => AboutUsCategory::PROGRAMS]); // programs

        $model->about_category_id = AboutUsCategory::PROGRAMS;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'programs/' . $image->baseName . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);

                $this->resizeImage($path);
                
                $model->image = $file;
            }

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('program_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated !',
                ]
            );
            return $this->redirect(['programs']);
        }
        else
        {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('program_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('programs', [
            'model' => $model
        ]);
    }

    public function actionContact(Type $var = null)
    {
        $model = Contacts::find()->where(['code' => 'STGABRIELPREUNIVERSITY'])->one();

        $existingLogo = $model->logo;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            
            $image = UploadedFile::getInstance($model, 'logo');
                
            if ($image) {

                $file = Yii::$app->params['upload'] . 'contact/' . $image->baseName . '.' . $image->extension;

                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);
                
                $image = Image::getImagine()->open($path);
                $image->resize(new \Imagine\Image\Box(430, 336))->save($path);
                
                $model->logo = $file;
                
            } else {
                $model->logo = $existingLogo;
            }

            $model->save();
            
            Yii::$app->getSession()->setFlash('user_update_save', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['contact']);
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

        return $this->render('contact', [
            'model' => $model,
            'existingLogo' => $existingLogo,
        ]);
    }

    private function resizeImage($path) {

        // image resized function
        $image = Image::getImagine()->open($path);
        $image->resize(new \Imagine\Image\Box(1800, 1000))->save($path);

        return $image;
    }
}
