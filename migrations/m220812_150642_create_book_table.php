<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%book}}`.
 */
class m220812_150642_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%book}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'image' => $this->string()->null(),
            'is_favorite' => $this->boolean()->defaultValue(false),
        ]);

        $this->createTable('{{%author}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
            'name' => $this->string()->notNull(),
            'bio' => $this->text()->notNull(),
            'birthday' => $this->date()->notNull(),
            'death_day' => $this->date()->null(),
        ]);

        $this->createTable('{{%book_author}}', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'book_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('FK_book_author_author', '{{%book_author}}', 'author_id', 'author', 'id', 'CASCADE');
        $this->addForeignKey('FK_book_author_book', '{{%book_author}}', 'book_id', 'book', 'id', 'CASCADE');

        $this->createTable('{{%book_attr}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'key' => $this->string()->notNull(),
            'value' => $this->string()->notNull(),
        ]);

        $this->addForeignKey('FK_book_attrs_book', '{{%book_attr}}', 'book_id', 'book', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('FK_book_attrs_book', '{{%book_attr}}');
        $this->dropForeignKey('FK_book_author_author', '{{%book_author}}');
        $this->dropForeignKey('FK_book_author_book', '{{%book_author}}');

        $this->dropTable('{{%book_attr}}');
        $this->dropTable('{{%book_author}}');
        $this->dropTable('{{%author}}');
        $this->dropTable('{{%book}}');
    }
}
