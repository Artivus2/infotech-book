<?php

use yii\db\Migration;

/**
 * Class m231026_121855_authors
 */
class m231026_121855_authors extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable('{{%authors}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'last_name'=> $this->string()->notNull(),
            'first_name'=> $this->string()->notNull(),
        ], $tableOptions);
        $this->createIndex('idx-author', '{{%authors}}', 'id', true);
        $this->addForeignKey(
            'fk-authors-book_id',
            'authors',
            'book_id',
            'books',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('authors');

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231026_121855_authors cannot be reverted.\n";

        return false;
    }
    */
}
