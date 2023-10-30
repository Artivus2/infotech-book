<?php

use yii\db\Migration;

/**
 * Class m231027_113808_subs
 */
class m231027_113808_subs extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        $this->createTable('{{%subs}}', [
            'id' => $this->primaryKey(),
            'book_id' => $this->integer()->notNull(),
            'user_id'=> $this->integer(),
            'email'=> $this->string()->notNull(),
        ], $tableOptions);
        //$this->createIndex('idx-author', '{{%authors}}', 'id', true);
        $this->addForeignKey(
            'fk-subs-book_id',
            'subs',
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
        echo "m231027_113808_subs cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m231027_113808_subs cannot be reverted.\n";

        return false;
    }
    */
}
