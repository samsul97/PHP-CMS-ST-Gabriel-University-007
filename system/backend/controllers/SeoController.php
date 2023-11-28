<?php

namespace backend\controllers;

use Yii;
use backend\models\Seo;
use backend\models\SeoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * SeoController implements the CRUD actions for Seo model.
 */
class SeoController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'ruleConfig' => [
                'class' => \common\components\AccessRule::className()],
                'rules' => \common\components\AccessRule::getRules(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
    {
        /* Application Log */
        Yii::$app->application->log($action->id);
        if (!parent::beforeAction($action)) {
            return false;
        }
        // Another code here
        return true;
    }

    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        // Code here
        return $result;
    }

    public function actionIndex()
    {
        $searchModel = new SeoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionCreateUpdate()
    {
        $model = new Seo();

        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            Seo::updateOrCreate($model->attributes);

            Yii::$app->getSession()->setFlash('seo_success_created_or_update', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'Seo saved successfully',
                    'message'  => 'SEO data has been updated!',
                ]
            );

            return $this->redirect(['index']);
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
                Yii::$app->getSession()->setFlash('seo_failed_created', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('create_update', [
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Seo::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    public function actionCheckExistence()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        $controller = Yii::$app->request->post('controller');
        $view = Yii::$app->request->post('view');

        $data = Seo::findByControllerAndView($controller, $view);

        return [
            'exists' => $data !== null,
            'data' => $data ? $data->attributes : null,
        ];
    }

    public function actionDetail($id)
    {
        $model = $this->findModel($id);

        return $this->renderAjax('_detail', [
            'model' => $model,
        ]);
    }
}
