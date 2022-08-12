<?php

namespace app\controllers;

use app\models\book\Book;
use app\models\book\BookSearch;
use yii\filters\ContentNegotiator;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

class BooksController extends Controller
{
    public function behaviors()
    {
        return [
          'content' => [
              'class' => ContentNegotiator::class,
              'only' => ['is-favorite'],
              'formats' => [
                  'application/json' => Response::FORMAT_JSON,
              ],
          ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }


    /**
     * Lists all Book models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new BookSearch(['authorId' => 1]);
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Book model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView(int $id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    public function actionIsFavorite($id)
    {
        $model = $this->findModel($id);
        $model->is_favorite = !$model->is_favorite;
        $model->save(false);

        return [
            'success' => true,
            'isFavorite' => (bool)$model->is_favorite,
        ];
    }

    /**
     * Finds the Book model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Book the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Book::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
