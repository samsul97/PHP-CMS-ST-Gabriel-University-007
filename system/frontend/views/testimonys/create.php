<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Testimonys */

$this->title = Yii::t('frontend', 'Create Testimonys');
$this->params['breadcrumbs'][] = ['label' => Yii::t('frontend', 'Testimonys'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="testimonys-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
