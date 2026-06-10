<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Record Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Purchases', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="purchase-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'supplier_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($suppliers, 'supplier_id', 'supplier_name'),
        ['prompt' => 'Select Supplier']
    ) ?>

    <?= $form->field($model, 'product_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($products, 'product_id', 'product_name'),
        ['prompt' => 'Select Product']
    ) ?>

    <?= $form->field($model, 'quantity_purchased')->textInput(['type' => 'number']) ?>

    <?= $form->field($model, 'unit_price')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'purchase_date')->textInput(['type' => 'datetime-local']) ?>

    <div class="form-group">
        <?= Html::submitButton('Record Purchase', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
