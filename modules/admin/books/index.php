<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\assets\AppAsset;
use app\model\Subs;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать книгу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            'id',
            // [
            //     'attribute'=> 'active',
            //     'content'=>function($data) {
            //         return $data->active ? '<i class="fas fa-check"></i>' : '<i class="fas fa-ban"></i>';
            //     }
            // ],
            'title',
            'description',
            'created_at',
            'image',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {like} {dislike}',
                'buttons'=> [
                    'like' => function ($id) {     
                      
                        return Html::a(Html::img('@web/assets/like.png', ['class' => 'like']), ['create-sub','id' => $id]);
                    },
                    'dislike' => function ($id) {     
                        return  Html::a(Html::img('@web/assets/dislike.png', ['class' => 'like']), ['remove-sub','id' => $id]);
                      }
                  ],

            ],
        ],
    ]); ?>


</div>
