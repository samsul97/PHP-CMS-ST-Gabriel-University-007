<?php

use backend\models\Article;
use backend\models\ArticleCategory;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\LinkPager;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\helpers\Html;

$this->title = isset($seoData->title) ? $seoData->title : 'List Article';
$this->params['breadcrumbs'][] = ['label' => 'Article', 'url' => ['/article/articles']];
$this->params['breadcrumbs'][] = $this->title;

// seo page keywords
$this->registerMetaTag(['name' => 'keywords', 'content' => isset($seoData->keywords) ?? ''], 'keywords');

// seo page description
$this->registerMetaTag(['name' => 'description', 'content' => isset($seoData->description) ?? ''], 'description');

// seo page canonical
$this->registerLinkTag(['rel' => 'canonical', 'href' => isset($seoData->canonical) ?? '']);

// seo page robots
$this->registerMetaTag(['name' => 'robots', 'content' => isset($seoData->robots) ?? ''], 'robots');

$select_type = ArrayHelper::map(ArticleCategory::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);
?>
<div class="container">
    <?php $form = ActiveForm::begin([
        'id' => 'search-form',
        'method' => 'get',
        'action' => ['articles'], // Replace 'search' with your search action
    ]); ?>
    
    <div class="col-md-3">
        <?= $form->field($searchModel, 'searchQuery')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-md-3">
        <?= $form->field($searchModel, 'article_category_id')->widget(Select2::classname(),[
                'data' => $select_type,
                'options' => [
                    'placeholder' => 'Select Category',
                    'value' => $searchModel->article_category_id,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);
        ?>
    </div>
    <div class="col-md-3">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<div class="container">
        <div class="section-title text-center">
            <h3>Blog and Article</h3>
        </div>
        <div class="container">
            <?php if ($searchModel->searchQuery || $searchModel->article_category_id): ?>
                <h5>Search Results:</h5>
                
                <?php $search = Article::find()
                    ->where(['like', 'title', $searchModel->searchQuery])
                    ->orWhere(['like', 'content', $searchModel->searchQuery])
                    ->andWhere(['like', 'article_category_id', $searchModel->article_category_id])
                    ->all();
                ?>
                
                <?php if (!$search): ?>
                    <h6>No results found!</h6>
                <?php else : ?>
                    <?php foreach ($search as $key => $value) { ?>
                    <?php
                        $image = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : '';

                        $string = strip_tags($value->content);
                        if (strlen($string) > 500) {

                            // truncate string
                            $stringCut = substr($string, 0, 500);
                            $endPoint = strrpos($stringCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...' . Html::a('Read More', ['/article/article-one', 'id' => $value->id]);
                        }
                    ?>
                    <div class="ts-item">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <?php $image = Url::base(). '/backend' . $image ?>
                                <?php $logoimg = Html::img($image, ['alt'=>'Article Image ST Gasbriel Pre Univeristy', 'class' => 'rounded-0', 'style' => 'width:90%']); ?>
                                <?= Html::a($logoimg, ['/article/article-one', 'id' => $value->id], ['target'=>'_blank']) ?>
                                <br>
                                <br>
                                <h6>Article Category : <?= $value->articleType->name ?></h6>
                                <h6>Post By : <?= $value->user->name ?></h6>
                                <h6>Created At : <?= $value->created_at ?></span>
                                <br>
                            <br>
                            <br>
                            <br>
                            </div>
                            
                            <div class="col-md-8 col-sm-8 col-xs-8 ts-text">
                                <h5><?= Html::a($value->title, ['/article/article-one', 'id' => $value->id], ['style' => 'color:black', 'target'=>'_blank']) ?></h5>
                                <br>
                                <p style="text-align:justify;padding-right:2%;color:black"><?= $string ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>              
            <?php endif ?>
            <?php else : ?>
                <?php foreach ($model->getModels() as $key => $value) { ?>
                    <?php
                        $image = $value->image && is_file(Yii::getAlias('@webroot') . '/backend' . $value->image) ? $value->image : '';

                        $string = strip_tags($value->content);
                        if (strlen($string) > 500) {

                            // truncate string
                            $stringCut = substr($string, 0, 500);
                            $endPoint = strrpos($stringCut, ' ');

                            //if the string doesn't contain any space then it will cut without word basis.
                            $string = $endPoint ? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
                            $string .= '...' . Html::a('Read More', ['/article/article-one', 'id' => $value->id]);
                        }
                    ?>
                    <div class="ts-item">
                        <div class="row">
                            <div class="col-md-4 col-sm-4 col-xs-4">
                                <?php $image = Url::base(). '/backend' . $image ?>
                                <?php $logoimg = Html::img($image, ['alt'=>'Article Image ST Gasbriel Pre Univeristy', 'class' => 'rounded-0', 'style' => 'width:90%']); ?>
                                <?= Html::a($logoimg, ['/article/article-one', 'id' => $value->id], ['target'=>'_blank']) ?>
                                <br>
                                <br>
                                <h6>Article Category : <?= $value->articleType->name ?></h6>
                                <h6>Post By : <?= $value->user->name ?></h6>
                                <h6>Created At : <?= $value->created_at ?></span>
                                <br>
                            <br>
                            <br>
                            <br>
                            </div>
                            
                            <div class="col-md-8 col-sm-8 col-xs-8 ts-text">
                                <h5><?= Html::a($value->title, ['/article/article-one', 'id' => $value->id], ['style' => 'color:black', 'target'=>'_blank']) ?></h5>
                                <br>
                                <p style="text-align:justify;padding-right:2%;color:black"><?= $string ?></p>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php endif; ?>
        </div>
    <div class="row">
        <center>
            <?= LinkPager::widget([
                'pagination' => $model->pagination,
            ]);
            ?>
        </center>
    </div>
</div>

<?php
$js = <<< JS
function setSchemaProperties() {
    return {
        "@context": "https://schema.org",
        "@type": "WebPage",
        "name": "<?= $name ?>",
        "description": "<?= $description ?>",
        "url": "<?= $url ?>",
        "image": "<?= $image ?>",
        "datePublished": "<?= $datePublished ?>",
        "dateModified": "<?= $dateModified ?>",
        "author": {
            "@type": "Person",
            "name": "<?= $authorName ?>"
        },
        "publisher": {
            "@type": "Organization",
            "name": "<?= $publisherName ?>",
            "logo": {
                "@type": "ImageObject",
                "url": "<?= $publisherLogo ?>"
            }
        },
        "keywords": "<?= $keywords ?>",
        "mainEntityOfPage": "<?= $mainEntityOfPage ?>"
    };
}

// Set schema properties
var schemaProperties = setSchemaProperties();

var scriptTag = document.createElement("script");
scriptTag.type = "application/ld+json";
scriptTag.innerHTML = JSON.stringify(schemaProperties);
document.head.appendChild(scriptTag);
JS;

$this->registerJs($js);