<?php

namespace frontend\controllers;

use Yii;
use backend\models\Student;
use backend\models\StudentCategory;
use backend\models\StudentSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StudentController implements the CRUD actions for Student model.
 */
class StudentController extends Controller
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
     * Lists all Student models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new StudentSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Student model.
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
     * Creates a new Student model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Student();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Student model.
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
     * Deletes an existing Student model.
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
     * Finds the Student model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Student the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Student::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public function actionWhyStgabriel()
    {
        $model = Student::findOne(['id' => 1, 'student_category_id' => StudentCategory::WHY]);

        return $this->render('why', [
            'model' => $model
        ]);
    }

    public function actionScs()
    {
        $model = Student::findOne(['id' => 2, 'student_category_id' => StudentCategory::SCS]);

        return $this->render('scs', [
            'model' => $model
        ]);
    }
    
    public function actionAlumni()
    {
        $model = Student::findOne(['id' => 3, 'student_category_id' => StudentCategory::ALUMNI]);

        return $this->render('alumni', [
            'model' => $model
        ]);
    }
    
    public function actionPastoralConseling()
    {
        $model = Student::findOne(['id' => 4, 'student_category_id' => StudentCategory::PASTORAL]);

        return $this->render('pastoral', [
            'model' => $model
        ]);
    }

    public function actionHandbook()
    {
        $model = Student::findOne(['id' => 5, 'student_category_id' => StudentCategory::HANDBOOK]);
        return $this->render('handbook', [
            'model' => $model
        ]);
    }
}
