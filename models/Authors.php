<?php

namespace app\models;

use Yii;

class Authors extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id','book_id'], 'integer'],
            [['last_name', 'first_name'], 'string', 'max' => 255],
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Books::class, ['book_id' => 'id']);
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book Id',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
        ];
    }
}
