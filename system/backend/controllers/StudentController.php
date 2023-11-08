<?php

namespace backend\controllers;

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

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function actionWhy()
    {
        $model = Student::findOne(['id' => 1, 'student_category_id' => StudentCategory::WHY]);

        $model->student_category_id = StudentCategory::WHY;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('why_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated!',
                ]
            );
            return $this->redirect(['why']);
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
                Yii::$app->getSession()->setFlash('why_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('why', [
            'model' => $model
        ]);
    }

    public function actionStudentCareService()
    {
        $model = Student::findOne(['id' => 2, 'student_category_id' => StudentCategory::SCS]);

        $model->student_category_id = StudentCategory::SCS;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('scs_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated!',
                ]
            );
            return $this->redirect(['student-care-service']);
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
                Yii::$app->getSession()->setFlash('scs_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('scs', [
            'model' => $model
        ]);
    }

    public function actionAlumni()
    {
        $model = Student::findOne(['id' => 3, 'student_category_id' => StudentCategory::ALUMNI]);

        $model->student_category_id = StudentCategory::ALUMNI;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('alumni_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated!',
                ]
            );
            return $this->redirect(['alumni']);
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
                Yii::$app->getSession()->setFlash('alumni_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('alumni', [
            'model' => $model
        ]);
    }

    public function actionPastoralCounselling()
    {
        $model = Student::findOne(['id' => 4, 'student_category_id' => StudentCategory::PASTORAL]);

        $model->student_category_id = StudentCategory::PASTORAL;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('pastoral_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated!',
                ]
            );
            return $this->redirect(['pastoral-counselling']);
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
                Yii::$app->getSession()->setFlash('pastoral_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('pastoral', [
            'model' => $model
        ]);
    }

    public function actionHandbook()
    {
        $model = Student::findOne(['id' => 5, 'student_category_id' => StudentCategory::HANDBOOK]);

        $model->student_category_id = StudentCategory::HANDBOOK;
        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;
        
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save(false);
            
            Yii::$app->getSession()->setFlash('handbook_created', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Updated!',
                ]
            );
            return $this->redirect(['handbook']);
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
                Yii::$app->getSession()->setFlash('handbook_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('handbook', [
            'model' => $model
        ]);
    }
}
