<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Product $model */

$this->title = 'Product: ' . $model->product_name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'product_id' => $model->product_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'product_id' => $model->product_id], [
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
                <th>Product ID</th>
                <td><?= $model->product_id ?></td>
            </tr>
            <tr>
                <th>Product Name</th>
                <td><?= $model->product_name ?></td>
            </tr>
            <tr>
                <th>Category</th>
                <td><?= $model->category ?></td>
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
                <th>Profit Margin</th>
                <td><?= number_format($model->getProfitMargin(), 2) ?>%</td>
            </tr>
            <tr>
                <th>Stock Quantity</th>
                <td><?= $model->stock_quantity ?></td>
            </tr>
            <tr>
                <th>Minimum Stock Level</th>
                <td><?= $model->min_stock_level ?></td>
            </tr>
            <tr>
                <th>Status</th>
                <td>
                    <?php if ($model->isLowStock()): ?>
                        <span class="badge badge-warning">Low Stock</span>
                    <?php else: ?>
                        <span class="badge badge-success">Sufficient</span>
                    <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?= $model->description ?></td>
            </tr>
        </table>
    </div>

</div>
