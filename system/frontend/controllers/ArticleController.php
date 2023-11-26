<?php

namespace frontend\controllers;

use Yii;
use backend\models\Article;
use backend\models\ArticleSearch;
use backend\models\Seo;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArticleController implements the CRUD actions for Article model.
 */
class ArticleController extends Controller
{
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

    protected function findModel($id)
    {
        if (($model = Article::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public function actionArticles()
    {
        $model = new ActiveDataProvider([
            'query' => Article::find(),
            'pagination' => [
                'pageSize' => 5
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);

        $searchModel = new ArticleSearch();
        $searchModel->load(Yii::$app->request->get()); // Load search parameters from GET request
        
        $dataProvider = $searchModel->search();

        $seoData = Seo::findByControllerAndView('article', 'articles');

        $schemaProperties = isset($seoData->schema_properties) ? json_decode($seoData->schema_properties) : null;

        $name = isset($schemaProperties) && isset($schemaProperties->name) ? $schemaProperties->name : null;
        $description = isset($schemaProperties) && isset($schemaProperties->description) ? $schemaProperties->description : null;
        $url = isset($schemaProperties) && isset($schemaProperties->url) ? $schemaProperties->url : null;
        $image = isset($schemaProperties) && isset($schemaProperties->image) ? $schemaProperties->image : null;
        $datePublished = isset($schemaProperties) && isset($schemaProperties->datePublished) ? $schemaProperties->datePublished : null;
        $dateModified = isset($schemaProperties) && isset($schemaProperties->dateModified) ? $schemaProperties->dateModified : null;
        $authorName = isset($schemaProperties) && isset($schemaProperties->author->name) ? $schemaProperties->author->name : null;
        $publisherName = isset($schemaProperties) && isset($schemaProperties->publisher->name) ? $schemaProperties->publisher->name : null;
        $publisherLogo = isset($schemaProperties) && isset($schemaProperties->publisher->logo->url) ? $schemaProperties->publisher->logo->url : null;
        $keywords = isset($schemaProperties) && isset($schemaProperties->keywords) ? $schemaProperties->keywords : null;
        $mainEntityOfPage = isset($schemaProperties) && isset($schemaProperties->mainEntityOfPage) ? $schemaProperties->mainEntityOfPage : null;

        return $this->render('articles', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'seoData' => $seoData,
            'name' => $name,
            'description' => $description,
            'url' => $url,
            'image' => $image,
            'datePublished' => $datePublished,
            'dateModified' => $dateModified,
            'authorName' => $authorName,
            'publisherName' => $publisherName,
            'publisherLogo' => $publisherLogo,
            'keywords' => $keywords,
            'mainEntityOfPage' => $mainEntityOfPage,
        ]);
    }

    public function actionArticleOne($id)
    {
        $model = Article::findAll($id);

        $seoData = Seo::findByControllerAndView('article', 'article-one');

        $schemaProperties = isset($seoData->schema_properties) ? json_decode($seoData->schema_properties) : null;

        $name = isset($schemaProperties) && isset($schemaProperties->name) ? $schemaProperties->name : null;
        $description = isset($schemaProperties) && isset($schemaProperties->description) ? $schemaProperties->description : null;
        $url = isset($schemaProperties) && isset($schemaProperties->url) ? $schemaProperties->url : null;
        $image = isset($schemaProperties) && isset($schemaProperties->image) ? $schemaProperties->image : null;
        $datePublished = isset($schemaProperties) && isset($schemaProperties->datePublished) ? $schemaProperties->datePublished : null;
        $dateModified = isset($schemaProperties) && isset($schemaProperties->dateModified) ? $schemaProperties->dateModified : null;
        $authorName = isset($schemaProperties) && isset($schemaProperties->author->name) ? $schemaProperties->author->name : null;
        $publisherName = isset($schemaProperties) && isset($schemaProperties->publisher->name) ? $schemaProperties->publisher->name : null;
        $publisherLogo = isset($schemaProperties) && isset($schemaProperties->publisher->logo->url) ? $schemaProperties->publisher->logo->url : null;
        $keywords = isset($schemaProperties) && isset($schemaProperties->keywords) ? $schemaProperties->keywords : null;
        $mainEntityOfPage = isset($schemaProperties) && isset($schemaProperties->mainEntityOfPage) ? $schemaProperties->mainEntityOfPage : null;

        return $this->render('article_one', [
            'model' => $model,
            'seoData' => $seoData,
            'name' => $name,
            'description' => $description,
            'url' => $url,
            'image' => $image,
            'datePublished' => $datePublished,
            'dateModified' => $dateModified,
            'authorName' => $authorName,
            'publisherName' => $publisherName,
            'publisherLogo' => $publisherLogo,
            'keywords' => $keywords,
            'mainEntityOfPage' => $mainEntityOfPage,
        ]);
    }
}
