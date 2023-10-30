<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
\yii\web\YiiAsset::register($this);

$this->title = 'Подписаться на книгу';

?>

<h1><?= $this->title ?></h1>

<?php $form = ActiveForm::begin() ?>

    <div class="form-group">
        <?= $form->field($model->title, 'email')->textInput(['maxlength' => true]) ?>
        <p>
        
        <?= Html::a('Подписаться', ['books/subscribe', 'id' => $model->id], [
            'class' => 'btn btn-success',

        ]) ?>
    </p>
    </div>
    

<?php ActiveForm::end() ?>


