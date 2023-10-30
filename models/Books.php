<?php

namespace app\models;

use Yii;

class Books extends \yii\db\ActiveRecord
{

    public $image;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','created_at'], 'required'],
            [['image'], 'file', 'extensions' => 'png, jpg, jpeg'],
            [['description', 'isbn'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'id',
            'created_at' => 'created_at',
            'title' => 'title',
            'description' => 'description',
            'isbn' => 'isbn',
            'image' => 'image',
        ];
    }

    public function upload(){
        $path = 'yii2images/' . $this->image->baseName . '.' . $this->image->extension;
        $this->image->saveAs($path);
        $this->attachImage($path);
        @unlink($path);
    }

//     public function getSubscribedBooks()
// {
//     return $this->hasMany(Book::class, ['id' => 'book_id'])
//         ->viaTable('subs', ['user_id' => 'id']);
// }
    public function getSubs()
    {
        return $this->hasMany(Subs::class, ['book_id' => 'id']);
    }

}
