<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Sale $model */

$this->title = 'Sale #' . $model->sale_id;
$this->params['breadcrumbs'][] = ['label' => 'Sales', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sale-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['delete', 'sale_id' => $model->sale_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Sale ID</th>
                <td><?= $model->sale_id ?></td>
            </tr>
            <tr>
                <th>Product</th>
                <td><?= $model->product->product_name ?? 'N/A' ?></td>
            </tr>
            <tr>
                <th>Customer Name</th>
                <td><?= $model->customer_name ?></td>
            </tr>
            <tr>
                <th>Quantity Sold</th>
                <td><?= $model->quantity_sold ?></td>
            </tr>
            <tr>
                <th>Cost Price</th>
                <td><?= number_format($model->cost_price, 2) ?></td>
            </tr>
            <tr>
                <th>Selling Price</th>
                <td><?= number_format($model->selling_price, 2) ?></td>
            </tr>
            <tr>
                <th>Total Sale Price</th>
                <td><?= number_format($model->total_sale_price, 2) ?></td>
            </tr>
            <tr>
                <th>Profit</th>
                <td><?= number_format($model->profit, 2) ?></td>
            </tr>
            <tr>
                <th>Sale Date</th>
                <td><?= date('Y-m-d H:i:s', strtotime($model->sale_date)) ?></td>
            </tr>
        </table>
    </div>

</div>
