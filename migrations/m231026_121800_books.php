<?php

use yii\db\Migration;

/**
 * Class m231026_121800_books
 */
class m231026_121800_books extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable('{{%books}}', [
            'id' => $this->primaryKey(),
            'created_at' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'description' => $this->string()->defaultValue('-'),
            'isbn' => $this->string(),
            'image' => $this->string(),
        ], $tableOptions);
        $this->createIndex('idx-book_id', '{{%books}}', 'id', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('books');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231026_121800_books cannot be reverted.\n";

        return false;
    }
    */
}
