<?php

namespace backend\controllers;

use Yii;
use backend\models\Article;
use backend\models\ArticleCategory;
use backend\models\ArticleCategorySearch;
use backend\models\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
                    'article-delete-category' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
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

    /**
     * {@inheritdoc}
     */
    public function afterAction($action, $result)
    {
        $result = parent::afterAction($action, $result);
        // Code here
        return $result;
    }

    /**
     * Lists all Article models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ArticleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Article model.
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
     * Creates a new Article model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Article();

        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'articles/' . $image->baseName . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);

                $this->resizeImage($path);
                
                $model->image = $file;
            }

            $model->save(false);

            Yii::$app->getSession()->setFlash('article_save', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('article_error', [
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
     * Updates an existing Article model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $model->created_by = Yii::$app->user->identity->id;
        $model->updated_by = Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $image = UploadedFile::getInstance($model, 'image');

            if ($image)
            {
                $file = Yii::$app->params['upload'] . 'articles/' . $image->baseName . '.' . $image->extension;
                $path = Yii::getAlias('@webroot') . $file;
                $image->saveAs($path);

                $this->resizeImage($path);
                
                $model->image = $file;
            }

            $model->save(false);

            Yii::$app->getSession()->setFlash('article_save', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('article_error', [
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
     * Deletes an existing Article model.
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
     * Finds the Article model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('backend', 'The requested page does not exist.'));
    }

    public function actionArticleIndexCategory(Type $var = null)
    {
        $searchModel = new ArticleCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('/article/article-category/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionArticleCreateCategory(Type $var = null)
    {
        $model = new ArticleCategory();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();
            
            Yii::$app->getSession()->setFlash('user_update_save', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['article-index-category']);
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

        return $this->render('/article/article-category/create', [
            'model' => $model,
        ]);
    }

    public function actionArticleUpdateCategory($id)
    {
        $model = ArticleCategory::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->save();
            
            Yii::$app->getSession()->setFlash('article_category_save', [
                    'type'     => 'success',
                    'duration' => 5000,
                    'title'    => 'System Information',
                    'message'  => 'Data Created !',
                ]
            );

            return $this->redirect(['article-index-category']);
        } else {
            if ($model->errors)
            {
                $message = "";
                foreach ($model->errors as $key => $value) {
                    foreach ($value as $key1 => $value2) {
                        $message .= $value2 . "<br>";
                    }
                }
                Yii::$app->getSession()->setFlash('article_category_error', [
                        'type'     => 'error',
                        'duration' => 5000,
                        'title'  => 'Error',
                        'message'  => $message,
                    ]
                );
            }
        }

        return $this->render('/article/article-category/update', [
            'model' => $model,
        ]);
    }

    public function actionArticleViewCategory($id)
    {
        return $this->render('/article/article-category/view', [
            'model' => ArticleCategory::findOne($id),
        ]);
    }

    public function actionArticleDeleteCategory($id)
    {
        ArticleCategory::findOne($id)->delete();

        return $this->redirect(['article-index-category']);
    }

    private function resizeImage($path) {

        // image resized function
        $image = Image::getImagine()->open($path);
        $image->resize(new \Imagine\Image\Box(200, 150))->save($path);

        return $image;
    }
}
