<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Sale $model */
/** @var yii\widgets\ActiveForm $form */
/** @var array $products */

$productList = [];
foreach ($products as $product) {
    $productList[$product->product_id] = $product->product_name . ' (' . number_format($product->selling_price, 2) . ')';
}
?>

<div class="sale-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'product_id')->dropDownList($productList, ['prompt' => 'Select Product']) ?>

    <?= $form->field($model, 'customer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'quantity_sold')->textInput() ?>

    <?= $form->field($model, 'cost_price')->textInput(['step' => 0.01]) ?>

    <?= $form->field($model, 'selling_price')->textInput(['step' => 0.01]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save Sale', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
