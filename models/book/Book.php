<?php

namespace app\models\book;

use DateTime;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\helpers\Html;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $title
 * @property string $description
 * @property string|null $image
 * @property int|null $is_favorite
 *
 * @property BookAttr[] $bookAttrs
 * @property BookAuthor[] $bookAuthors
 */
class Book extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => (new DateTime())->format('Y-m-d H:i:s'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['description'], 'string'],
            [['is_favorite'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'title' => 'Title',
            'description' => 'Description',
            'image' => 'Image',
            'is_favorite' => 'Is Favorite',
        ];
    }

    /**
     * Gets query for [[BookAttrs]].
     *
     * @return ActiveQuery
     */
    public function getBookAttrs()
    {
        return $this->hasMany(BookAttr::className(), ['book_id' => 'id']);
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }

    public function getDisplayAuthors()
    {
        $html = "";

        foreach ($this->bookAuthors as $author) {
            $html .= Html::a($author->author->name, ['/authors/view', 'id' => $author->author_id]) . ' ';
        }
        return $html;
    }
}
