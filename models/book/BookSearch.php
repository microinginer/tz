<?php

namespace app\models\book;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\book\Book;

/**
 * BookSearch represents the model behind the search form of `app\models\book\Book`.
 */
class BookSearch extends Book
{
    public $authorId;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_favorite','authorId'], 'integer'],
            [['created_at', 'updated_at', 'title', 'description', 'image'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Book::find()
            ->alias('B')
            ->distinct()
        ;
        $query
            ->joinWith('bookAuthors BA')
            ->joinWith('bookAuthors.author A');

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 8,
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'B.id' => $this->id,
            'B.created_at' => $this->created_at,
            'B.updated_at' => $this->updated_at,
            'B.is_favorite' => $this->is_favorite,
            'BA.author_id' => $this->authorId,
        ]);

        $query->andFilterWhere(['like', 'B.title', $this->title])
            ->andFilterWhere(['like', 'B.description', $this->description])
            ->andFilterWhere(['like', 'B.image', $this->image]);

        $queryCount = clone $query;

        $dataProvider->setTotalCount($queryCount->count());


        return $dataProvider;
    }
}
