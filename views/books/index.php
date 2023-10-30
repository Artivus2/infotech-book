<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use app\assets\AppAsset;
use app\model\Subs;
use app\model\Books;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Книги';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Список книг
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
            // [
            //     'class' => ActionColumn::className(),
            //     'template' => '{view} {like} {dislike}',
            //     'buttons'=> [
            //         'like' => function ($id) {     
                      
            //             return Html::a(Html::img('@web/assets/like.png', ['class' => 'like']), ['/books/sub']);
            //         },
            //         'dislike' => function ($id) {     
            //             return  Html::a(Html::img('@web/assets/dislike.png', ['class' => 'like']), ['remove-sub','id' => $id]);
            //           }
            //     ],
            //     'urlCreator' => function ($action, $model, $key, $index, $column) {
            //         return Url::toRoute([$action, 'id' => $model->id]);
            //      },
                
            // ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete} {subscribe}',
                // 'urlCreator' => function ($action, $model, $key, $index, $column) {
                //     return Url::toRoute([$action, 'id' => $model->id]);
                //  },
                'buttons'=> [
                    'subscribe'   => function ($url, $model) {
                        $url = Url::to(['books/subscribe', 'id' => $model->id]);
                        return Html::a(Html::img('@web/assets/like.png',['class' => 'like']), $url);
                    },
                            // 'urlCreator' => function ($action, $model, $key, $index, $column) {     
                            //        return Url::toRoute([$action, 'id' => $model->id]);
                            // },
                            // 'subscribe' => function ($model) {
                            //     return Url::toRoute(['subscribe','id'=> $model]);
                            // }
                                   // return Html::a(Html::img('@web/assets/like.png',
                                //     ['class' => 'like']), 
                                //     ['subscribe', 'id' => $id]
                                // );
                            
                        ],
                'visibleButtons' => [
                    // 'view' => !\Yii::$app->user->isGuest,
                    // 'subscribe' => !\Yii::$app->user->isGuest,
                    'delete' => !\Yii::$app->user->isGuest,
                    //'update' => !\Yii::$app->user->isGuest,
                ],
            ],
                
        ],
    ]); ?>
    
    


</div>
