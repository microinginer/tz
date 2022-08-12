<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\book\Book */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-4">
            <?= Html::img($model->image, ['class' => 'img-responsive']) ?>
        </div>
        <div class="col-8">
            <ul class="list-unstyled">
                <li><b>Authors:</b> <?= $model->getDisplayAuthors() ?></li>
                <?php foreach ($model->bookAttrs as $attr): ?>
                    <li><b><?= $attr->getDisplayAttr() ?>:</b> <?= $attr->value ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="col-12">
            <h2>Description</h2>
            <p><?= $model->description ?></p>
        </div>
    </div>
</div>
