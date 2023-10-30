<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\books */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Книги', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="books-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <?= Html::a('Подписаться', ['books/subscribe', 'id' => $model->id], [
            'class' => 'btn btn-success',

        ]) ?>
    </p>

    <?php
    $images = $model->getImages();
    $img_html = '';
    foreach ($images as $image) {
        $img_html .= '<img src="' . $image->getUrl("x50") . '"/> ';
    }
    ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            // [
            //     'attribute'=> 'active',
            //     'value' =>  $model->active ? '<i class="fas fa-check"></i>' : '<i class="fas fa-ban"></i>',
            //     'format' => 'html'
            // ],
            [
                'attribute' => 'Фото обложки',
                'value' => isset($images) ? $img_html  : "Не указано",
                'format' => 'html',
            ],
            'title',
            'description',
            'created_at',
        ],
    ]) ?>

</div>
