<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Sale $model */
/** @var array $products */

$this->title = 'Update Sale: ' . $model->sale_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->sale_id, 'url' => ['view', 'sale_id' => $model->sale_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sale-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'products' => $products,
    ]) ?>

</div>
