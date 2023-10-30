<?php

namespace app\models;

use Yii;

class Subs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['book_id','user_id'], 'integer'],
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'string', 'max' => 255],
        ];
    }

    public function getBooks()
    {
        return $this->hasMany(Books::class, ['book_id' => 'id']);
    }

    public function getUsers()
    {
        return $this->hasMany(User::class, ['user_id' => 'id']);
    }

        
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'book_id' => 'Book Id',
            'user_id' => 'User Id',
            'email' => 'Электронная почта',
        ];
    }
}
