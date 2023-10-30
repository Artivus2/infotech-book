<?php

namespace app\models;

use Yii;
use yii\helpers\Url;
use yii\base\Model;
use app\models\User;
use app\models\Subs;

/**
 * Subs form
 */
class SubsForm extends Model
{
    public $user_id;
    public $email;
    public $book_id;


    /**
     * {@inheritdoc}
     */
    
    public function attributeLabels() {
    return [
    'user_id' => 'user_id',
    'book_id' => 'book_id',
    'email' => 'email'
    ];
    }
    
    
    public function rules()
    {
        return [
            ['user_id', 'integer'],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['book_id', 'required'],
        ];
    }

    /**
     * Subs user to book.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function subscribe($id)
    {
        $user_id = \Yii::$app->user->getId();
        $email = User::find()->where(['id' => $user_id])->one();
        if (!$email) {
            $this->email = 'example@gmail.com';
        } else {
        $this->email = $email->email;
        }
        if (!$user_id) {
            $user_id = 0;
            return true;
        }

        $subscription = new Subs();
        $subscription->user_id = $user_id;
        $subscription->book_id = $id;
        $subscription->email = $this->email;

        if (!$subscription->save()) {
            return false;
        }

        return true;
    }

}
