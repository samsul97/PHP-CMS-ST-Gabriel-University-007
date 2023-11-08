<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Student */

$this->title = Yii::t('backend', 'Create Student');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Students'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
