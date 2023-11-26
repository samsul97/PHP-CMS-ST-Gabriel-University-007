<?php

namespace frontend\controllers;

use Yii;
use backend\models\Partners;
use backend\models\Seo;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PartnersController implements the CRUD actions for Partners model.
 */
class PartnersController extends Controller
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
        if (($model = Partners::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('frontend', 'The requested page does not exist.'));
    }

    public function actionPartners()
    {
        $model = Partners::find()->all();

        $seoData = Seo::findByControllerAndView('partners', 'partners');

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

        return $this->render('partners', [
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
