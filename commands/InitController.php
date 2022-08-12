<?php

namespace app\commands;

use app\models\author\Author;
use app\models\book\Book;
use app\models\book\BookAttr;
use app\models\book\BookAuthor;
use yii\console\Controller;
use yii\helpers\ArrayHelper;
use yii\helpers\Console;

class InitController extends Controller
{
    public static $author = [
        'name' => 'John Doe',
        'bio' => 'Books author',
        'birthday' => '1986-06-06',
        'death_day' => '2022-06-06',
    ];

    public static $book = [
        'title' => 'Book title',
        'description' => 'Book description, book description',
        'image' => 'https://via.placeholder.com/200x100',
    ];

    public static $attrs = [
        [
            'key' => BookAttr::KEY_CATEGORY,
            'value' => 'Fantastic',
        ],
        [
            'key' => BookAttr::KEY_YEAR,
            'value' => '2009',
        ],
        [
            'key' => BookAttr::KEY_LANGUAGE,
            'value' => 'English',
        ],
        [
            'key' => BookAttr::KEY_PAGES,
            'value' => '153',
        ],
    ];

    public function actionDummyData()
    {
        for ($i = 0; $i < 2; $i++) {
            $authorModel = new Author();
            $authorModel->setAttributes(self::$author);
            $authorModel->save();

            $this->stdout('----- Author Created -----' . PHP_EOL, Console::FG_GREEN);
        }

        $authorList = Author::find()
            ->select('id')
            ->indexBy('id')
            ->limit(2)
            ->column();


        for ($i = 0; $i < 20; $i++) {
            $book = new Book();
            $book->setAttributes(self::$book);
            $book->save();
            $this->stdout('----- Book Created -----' . PHP_EOL, Console::FG_GREEN);

            foreach ($authorList as $authorId) {
                (new BookAuthor([
                    'book_id' => $book->id,
                    'author_id' => $authorId,
                ]))->save();

                $this->stdout('----- Author Set -----' . PHP_EOL, Console::FG_GREEN);
            }

            foreach (self::$attrs as $attr) {
                (new BookAttr(array_merge($attr, [
                    'book_id' => $book->id,
                ])))->save();

                $this->stdout('----- Attribute Set -----' . PHP_EOL, Console::FG_GREEN);
            }
        }
    }
}
