<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\KategoriBarang1 */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="kategori-barang1-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'namaKategoriBarang')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
