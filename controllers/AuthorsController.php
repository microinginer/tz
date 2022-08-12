<?php

namespace app\controllers;

use app\models\author\Author;
use app\models\book\Book;
use app\models\book\BookSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class AuthorsController extends Controller
{
    /**
     * Displays a single Book model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView(int $id)
    {
        $model = $this->findModel($id);
        $searchModel = new BookSearch(['authorId' =>  $model->id]);
        $dataProvider = $searchModel->search([]);

        return $this->render('view', [
            'model' => $model,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Author the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Author::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
