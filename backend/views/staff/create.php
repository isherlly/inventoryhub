<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Add Staff';
$this->params['breadcrumbs'][] = ['label' => 'Staff', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="staff-create">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'staff_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'position')->textInput(['maxlength' => true, 'placeholder' => 'e.g. Sales Person, Manager']) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'salary')->textInput(['type' => 'number', 'step' => '0.01']) ?>

    <?= $form->field($model, 'hire_date')->textInput(['type' => 'date']) ?>

    <?= $form->field($model, 'status')->dropDownList([
        'active' => 'Active',
        'inactive' => 'Inactive'
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Add Staff', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
