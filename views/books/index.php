<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\book\BookSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_search', ['model' => $searchModel]); ?>

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
            return $this->render('_book_item', [
                'model' => $book,
            ]);
        }
    ]); ?>

</div>
