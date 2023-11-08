<?php

namespace frontend\controllers;

use backend\models\AboutUsCategory;
use backend\models\Contacts;
use backend\models\Footer;
use Yii;
use frontend\models\AboutUs;
use frontend\models\AboutUsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AboutUsController implements the CRUD actions for AboutUs model.
 */
class AboutUsController extends Controller
{
    // public $layout = 'main';
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

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public function actionProfile(Type $var = null)
    {
        
        $model = AboutUs::findOne(['id' => 1, 'about_category_id' => AboutUsCategory::PROFILE]); // profile

        return $this->render('profile', [
            'model' => $model
        ]);
    }

    public function actionManagement(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 2, 'about_category_id' => AboutUsCategory::MANAGEMENT]); // management

        return $this->render('management', [
            'model' => $model
        ]);
    }

    public function actionLecturer(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 3, 'about_category_id' => AboutUsCategory::LECTURER]); // profile

        return $this->render('lecturer', [
            'model' => $model
        ]);
    }
    
    public function actionCeomessage(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 4, 'about_category_id' => AboutUsCategory::CEO_MESSAGES]); // profile

        return $this->render('ceo_messages', [
            'model' => $model
        ]);
    }

    public function actionPrograms(Type $var = null)
    {
        $model = AboutUs::findOne(['id' => 5, 'about_category_id' => AboutUsCategory::PROGRAMS]); // programs

        return $this->render('programs', [
            'model' => $model
        ]);
    }

    public function actionContact(Type $var = null)
    {
        $model = Contacts::findOne(['code' => 'STGABRIELPREUNIVERSITY']);

        return $this->render('contact', [
            'model' => $model
        ]);
    }

    public function actionSendEnquiry()
    {
        $name = Yii::$app->request->post('name');
        $subject = Yii::$app->request->post('subject');
        $email = Yii::$app->request->post('email');
        $message = Yii::$app->request->post('message');

        $mailer = Yii::$app->mailer->compose()
            ->setTo('forwarder@stgabrielpreuniversity.com')
            ->setFrom($email)
            ->setSubject($subject)
            ->setTextBody($message)
            ->setHtmlBody($message);

        if ($mailer->send()) {
            Yii::$app->session->setFlash('success', 'Message Sent!');
        } else {
            Yii::$app->session->setFlash('error', 'Failed to send message!');
        }

        return $this->redirect(['contact']); // Replace 'contactus' with the appropriate URL after sending the email
    }
}
