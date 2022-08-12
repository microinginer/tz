<?php

namespace app\models\author;

use app\models\book\BookAuthor;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string $created_at
 * @property string $updated_at
 * @property string $name
 * @property string $bio
 * @property string $birthday
 * @property string|null $death_day
 *
 * @property BookAuthor[] $bookAuthors
 */
class Author extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'value' => (new \DateTime())->format('Y-m-d H:i:s'),
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'bio', 'birthday'], 'required'],
            [['created_at', 'updated_at', 'birthday', 'death_day'], 'safe'],
            [['bio'], 'string'],
            [['name'], 'string', 'max' => 255],
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
            'name' => 'Name',
            'bio' => 'Bio',
            'birthday' => 'Birthday',
            'death_day' => 'Death Day',
        ];
    }

    /**
     * Gets query for [[BookAuthors]].
     *
     * @return ActiveQuery
     */
    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['author_id' => 'id']);
    }
}
