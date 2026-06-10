<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Expense';
$this->params['breadcrumbs'][] = ['label' => 'Expenses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="expense-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'expense_type')->dropDownList([
        'Rent' => 'Rent',
        'Utilities' => 'Utilities (Water, Electricity)',
        'Transportation' => 'Transportation',
        'Maintenance' => 'Maintenance',
        'Salary' => 'Salary',
        'Marketing' => 'Marketing',
        'Other' => 'Other'
    ]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 3]) ?>

    <?= $form->field($model, 'amount')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'expense_date')->textInput(['type' => 'datetime-local']) ?>

    <div class="form-group">
        <?= Html::submitButton('Record Expense', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
