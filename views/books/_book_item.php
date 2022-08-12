<?php
/**
 * @var $this \yii\web\View
 * @var $model \app\models\book\Book
 */
?>
<div class="card" style="width: 18rem;">
    <img class="card-img-top" src="<?= $model->image ?>" alt="Card image cap">
    <i class="<?= $model->is_favorite ? 'fas' : 'far' ?> fa-bookmark favoriteButton" data-id="<?= $model->id?>"></i>
    <div class="card-body">
        <h5 class="card-title"><?= $model->title ?></h5>
        <p class="card-text">
            <?= $model->getDisplayAuthors() ?>
            <br>
            <?= $model->description ?>
        </p>
        <a href="<?= \yii\helpers\Url::to(['view', 'id' => $model->id]) ?>" class="btn btn-primary">Detail</a>
    </div>
</div>
