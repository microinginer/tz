<?php

namespace app\models\book;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "book_attr".
 *
 * @property int $id
 * @property int $book_id
 * @property string $key
 * @property string $value
 *
 * @property Book $book
 */
class BookAttr extends \yii\db\ActiveRecord
{
    const KEY_YEAR = 'year';
    const KEY_CATEGORY = 'cat';
    const KEY_LANGUAGE = 'lang';
    const KEY_PAGES = 'pages';

    public static function getAttrList()
    {
        return [
            self::KEY_YEAR => 'Year',
            self::KEY_CATEGORY => 'Category',
            self::KEY_LANGUAGE => 'Language',
            self::KEY_PAGES => 'Pages',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'book_attr';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id', 'key', 'value'], 'required'],
            [['book_id'], 'integer'],
            [['key', 'value'], 'string', 'max' => 255],
            [['book_id'], 'exist', 'skipOnError' => true, 'targetClass' => Book::className(), 'targetAttribute' => ['book_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book ID',
            'key' => 'Key',
            'value' => 'Value',
        ];
    }

    /**
     * Gets query for [[Book]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBook()
    {
        return $this->hasOne(Book::className(), ['id' => 'book_id']);
    }

    public function getDisplayAttr()
    {
        return ArrayHelper::getValue(self::getAttrList(), $this->key);
    }
}
