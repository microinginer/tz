<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model \app\models\author\Author */
/* @var $dataProvider \yii\data\ActiveDataProvider */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-4">
            <?= Html::img('https://via.placeholder.com/200x100', ['class' => 'img-responsive']) ?>
        </div>
        <div class="col-8">
            <ul class="list-unstyled">
                <li><b>Birthday:</b> <?= $model->birthday ?></li>
                <li><b>Death Date:</b> <?= $model->death_day ?></li>

            </ul>
        </div>
        <div class="col-12">
            <hr>

            <h2>Biography</h2>
            <p><?= $model->bio ?></p>
        </div>
    </div>
    <hr>
    <h3>Book list</h3>
    <?= ListView::widget([
        'dataProvider' => $dataProvider,
        'pager' => [
            'class' => \yii\bootstrap4\LinkPager::class,
        ],
        'summary' => false,
        'layout' => '<div class="row">{items}</div><div class="footer">{pager}</div>',
        'itemOptions' => [
            'class' => 'col-3 card-item',
        ],
        'itemView' => function (\app\models\book\Book $book) {
            return $this->render('../books/_book_item', [
                'model' => $book,
            ]);
        }
    ]); ?>
</div>
